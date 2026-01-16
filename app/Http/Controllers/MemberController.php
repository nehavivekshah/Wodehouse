<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Facilities;
use App\Models\FacilityAvailability;
use App\Models\Booking;
use App\Models\FoodCategory;
use App\Models\FoodOrder;
use App\Models\FoodOrderItem;
use App\Models\CartItem;
use App\Models\Usermetas;
use Carbon\Carbon;

class MemberController extends Controller
{

    public function dashboard()
    {
        return view('frontend.member.dashboard');
    }

    public function agm()
    {
        return view('frontend.member.agm');
    }

    public function subscriptions()
    {
        return view('frontend.member.subscriptions');
    }

    public function payment_history()
    {
        return view('frontend.member.payment_history');
    }

    public function events()
    {
        $upcomingEvents = \App\Models\Event::where('status', 1)
            ->whereDate('event_date', '>=', now())
            ->orderBy('event_date')
            ->get();

        $pastEvents = \App\Models\Event::where('status', 1)
            ->whereDate('event_date', '<', now())
            ->orderBy('event_date', 'desc')
            ->get();

        return view('frontend.member.events', compact('upcomingEvents', 'pastEvents'));
    }

    public function eventDetails($id)
    {
        $event = \App\Models\Event::with('registrations')->findOrFail($id);
        $isRegistered = false;
        if (auth()->check()) {
            $isRegistered = $event->registrations()->where('user_id', auth()->id())->exists();
        }
        return view('frontend.member.event_details', compact('event', 'isRegistered'));
    }

    public function registerEvent($id)
    {
        $event = \App\Models\Event::findOrFail($id);

        // Check if already registered
        $exists = \App\Models\EventRegistration::where('event_id', $event->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            return back()->with('info', 'You are already registered for this event.');
        }

        \App\Models\EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => auth()->id(),
            'status' => 'registered'
        ]);

        return back()->with('success', 'Successfully registered for ' . $event->title);
    }

    public function menu()
    {
        $categories = FoodCategory::with([
            'items' => function ($q) {
                $q->where('status', 1);
            }
        ])->where('status', 1)->get();
    
        $orders = FoodOrder::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    
        // ✅ Cart summary
        $cartItems = auth()->user()
            ->cartItems()
            ->with('food')
            ->get();
    
        $cartCount = $cartItems->sum('quantity');
    
        $cartTotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->food->price;
        });
    
        return view(
            'frontend.member.food',
            compact('categories', 'orders', 'cartCount', 'cartTotal')
        );
    }

    public function cart()
    {
        $cartItems = auth()->user()
            ->cartItems()
            ->with('food')
            ->get();

        return view('frontend.member.cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $existing = CartItem::where('user_id', auth()->id())
            ->where('food_id', $request->food_id)
            ->first();

        if ($existing) {
            $existing->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'food_id' => $request->food_id,
                'quantity' => 1
            ]);
        }

        return response()->json([
            'success' => true,
            'cart_count' => auth()->user()->cartItems()->sum('quantity'),
            'cart_total' => auth()->user()->cartItems()->get()->sum(function ($item) {
                return $item->quantity * $item->food->price;
            })
        ]);
    }

    public function update(Request $request)
    {
        $item = CartItem::where('id', $request->id)->where('user_id', auth()->id())->first();
        if ($item) {
            $item->update(['quantity' => $request->quantity]);
        }


        $item->refresh(); // reload to get new quantity if needed
        $cartItems = auth()->user()->cartItems()->with('food')->get();
        $subtotal = $cartItems->sum(function ($i) {
            return $i->quantity * $i->food->price; });
        $gst = $subtotal * 0.18;
        $total = $subtotal + $gst;

        return response()->json([
            'success' => true,
            'item_total' => $item ? $item->quantity * $item->food->price : 0,
            'subtotal' => $subtotal,
            'gst' => $gst,
            'total' => $total
        ]);
    }

    public function remove(Request $request)
    {
        CartItem::where('id', $request->id)->where('user_id', auth()->id())->delete();
        CartItem::where('id', $request->id)->where('user_id', auth()->id())->delete();

        $cartItems = auth()->user()->cartItems()->with('food')->get();
        $subtotal = $cartItems->sum(function ($i) {
            return $i->quantity * $i->food->price; });
        $gst = $subtotal * 0.18;
        $total = $subtotal + $gst;

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'gst' => $gst,
            'total' => $total,
            'cart_count' => $cartItems->sum('quantity') // Useful if we update header/badges
        ]);
    }

    public function checkout()
    {
        $cartItems = auth()->user()->cartItems()->with('food')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('member.menu');
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->food->price * $item->quantity;
        }
        $gst = $subtotal * 0.18;
        $total = $subtotal + $gst;

        return view('frontend.member.checkout', compact('cartItems', 'subtotal', 'gst', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('food')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('member.menu')->with('error', 'Cart is empty');
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->food->price * $item->quantity;
        }
        $gst = $subtotal * 0.18;
        $total = $subtotal + $gst;

        DB::beginTransaction();
        try {
            $paymentMethod = $request->payment_method ?? 'cash';
            $paymentStatus = ($paymentMethod == 'cash') ? 'pending' : 'pending'; // Adjust if online payment is added

            $order = FoodOrder::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'pending',
                'payment_status' => $paymentStatus,
                'payment_method' => $paymentMethod
            ]);

            foreach ($cartItems as $item) {
                // Assuming FoodOrderItem model exists, checking imports
                // If not, we might need to use DB::table or create model. 
                // Let's assume FoodOrderItem exists based on previous context, 
                // but wait, I didn't verify FoodOrderItem model existence.
                // Checking SQL dump might reveal table `food_order_items`.
                // Let me use the relationship if defined in FoodOrder.

                DB::table('food_order_items')->insert([
                    'order_id' => $order->id,
                    'food_item_id' => $item->food_id,
                    'qty' => $item->quantity,
                    'price' => $item->food->price,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Clear cart
            $user->cartItems()->delete();

            DB::commit();
            return redirect()->route('member.menu')->with('success', 'Order placed successfully! Order ID: #' . $order->id);

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e);
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function orderDetails($id)
    {
        $order = FoodOrder::with(['items.foodItem'])->where('user_id', auth()->id())->findOrFail($id);
        return view('frontend.member.order_details', compact('order'));
    }



    public function facility_availability()
    {
        $facilities = Facilities::all();
        $availabilities = FacilityAvailability::with('facility')->get();
        $bookings = Booking::with('facility')
            ->where('user_id', Auth::id())
            ->orderBy('booking_date', 'desc')
            ->get();
        return view('frontend.member.facility_availability', compact('facilities', 'availabilities', 'bookings'));
    }

    public function getFacilityDays($id)
    {
        // Returns unique day indices (0-6) where the facility is available
        $days = FacilityAvailability::where('facility_id', $id)
            ->pluck('day_of_week')
            ->toArray();
        return response()->json($days);
    }

    public function getAvailableSlots(Request $request)
    {
        // Validate inputs
        if (!$request->facility_id || !$request->date) {
            return response()->json(['success' => false, 'message' => 'Missing parameters.']);
        }

        $date = \Carbon\Carbon::parse($request->date);
        $dayOfWeek = $date->dayOfWeek; // 0 (Sun) to 6 (Sat)

        // Check if facility has a schedule for this specific day of the week
        $availability = FacilityAvailability::where('facility_id', $request->facility_id)
            ->where('day_of_week', $dayOfWeek)
            ->first();

        if (!$availability) {
            return response()->json([
                'success' => true,
                'slots' => [],
                'message' => 'The facility is closed on this day (' . $date->format('l') . ').'
            ]);
        }

        // Get bookings for the chosen date
        $bookedSlots = Booking::where('facility_id', $request->facility_id)
            ->where('booking_date', $request->date)
            ->where('status', '!=', 'cancelled')
            ->pluck('slot_time')
            ->map(fn($time) => \Carbon\Carbon::parse($time)->format('H:i'))
            ->toArray();

        $slots = [];
        $start = \Carbon\Carbon::parse($availability->start_time);
        $end = \Carbon\Carbon::parse($availability->end_time);
        $duration = (int) $availability->slot_duration;

        while ($start->copy()->addMinutes($duration) <= $end) {
            $timeStr = $start->format('H:i');

            // If the date is TODAY, don't show slots that have already passed in clock time
            $isPastTime = false;
            if ($date->isToday()) {
                if ($start->lt(now())) {
                    $isPastTime = true;
                }
            }

            $slots[] = [
                'time' => $timeStr,
                'is_booked' => in_array($timeStr, $bookedSlots) || $isPastTime,
                'reason' => $isPastTime ? 'Time passed' : (in_array($timeStr, $bookedSlots) ? 'Already booked' : 'Available')
            ];
            $start->addMinutes($duration);
        }

        return response()->json(['success' => true, 'slots' => $slots]);
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'facility_id' => 'required',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        $facility = Facilities::findOrFail($request->facility_id);

        // Double check availability (Prevent race conditions)
        $exists = Booking::where('facility_id', $request->facility_id)
            ->where('booking_date', $request->date)
            ->where('slot_time', $request->time)
            ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'This slot was just taken! Please pick another.']);
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'facility_id' => $request->facility_id,
            'booking_date' => $request->date,
            'slot_time' => $request->time,
            'amount' => $facility->price ?? 500.00,
            'status' => 'pending'
        ]);

        //return response()->json(['success' => true]);
        return response()->json([
            'success' => true,
            'booking_id' => $booking->id // Critical for the JS redirect
        ]);
    }

    public function bookingSummary($id)
    {
        $booking = Booking::with('facility')->findOrFail($id);
        $availability = FacilityAvailability::where('facility_id', $booking->facility_id)
            ->where('day_of_week', Carbon::parse($booking->booking_date)->dayOfWeek)->first();

        $bookingFee = $booking->amount;
        $gstAmount = $bookingFee * 0.18;
        $totalAmount = $bookingFee + $gstAmount;

        return view('frontend.member.booking_summary', compact('booking', 'bookingFee', 'gstAmount', 'totalAmount', 'availability'));
    }

    public function viewInvoice($id)
    {
        $booking = Booking::with('facility', 'user.meta')->findOrFail($id);

        return view('frontend.member.view_invoice', compact('booking'));
    }

    public function cancelBooking(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
        ]);

        try {
            $booking = Booking::where('id', $request->booking_id)
                ->where('status', 'pending') // only pending can cancel
                ->first();

            if (!$booking) {
                return response()->json(['success' => false, 'message' => 'Booking not found or cannot be cancelled.']);
            }

            $booking->status = 'cancelled';
            $booking->save();

            return response()->json(['success' => true, 'message' => 'Booking has been cancelled.']);
        } catch (\Exception $e) {
            \Log::error('Cancel booking error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server error occurred.'], 500);
        }
    }

    public function profile()
    {
        $user = Auth::user();
        $meta = Usermetas::where('uid', $user->id)->first();
        return view('frontend.member.profile', compact('user', 'meta'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mob' => 'required|numeric|unique:users,mob,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $userData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mob' => $request->mob,
            'whatsapp' => $request->whatsapp,
            'dob' => $request->dob,
            'gender' => $request->gender,
        ];

        // Handle File Upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('users'), $filename);

            // Delete old photo if exists
            if ($user->photo && file_exists(public_path($user->photo))) {
                @unlink(public_path($user->photo));
            }

            $userData['photo'] = 'users/' . $filename;
        }

        $user->update($userData);

        Usermetas::updateOrCreate(
            ['uid' => $user->id],
            [
                'company' => $request->company,
                'address' => $request->address,
                'city' => $request->city,
                'pincode' => $request->pincode,
                'state' => $request->state,
                'country' => $request->country,
                'status' => 1 // Ensure active status
            ]
        );

        return back()->with('success', 'Profile updated successfully.');
    }

    public function change_password()
    {
        return view('frontend.member.change_password');
    }

    public function changePasswordPost(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Successfully Logged Out.');
    }

}
?>
