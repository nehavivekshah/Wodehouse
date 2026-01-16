<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Facilities;
use App\Models\FacilityAvailability;
use App\Models\FoodCategory;
use App\Models\FoodItem;
use App\Models\FoodOrder;

class AdminController extends Controller
{

    public function dashboard()
    {
        $totalMembers = DB::table('users')->where('role', '2')->count();
        $totalOrders = \App\Models\FoodOrder::count();
        $pendingOrders = \App\Models\FoodOrder::whereIn('status', ['pending', 'preparing'])->count();
        $totalEvents = \App\Models\Event::count();
        $totalBookings = DB::table('bookings')->count();

        return view('backend.dashboard', compact('totalMembers', 'totalOrders', 'pendingOrders', 'totalEvents', 'totalBookings'));
    }

    // POSTS LIST
    public function posts()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'desc')->get();
        return view('backend.posts', compact('posts'));
    }

    // MANAGE POST FORM
    public function managePost($id = null)
    {
        $post = null;
        if ($id) {
            $post = DB::table('posts')->where('id', $id)->first();
        }

        $categories = DB::table('post_categories')->where('status', 1)->get();
        return view('backend.managePost', compact('post', 'categories'));
    }

    // SUBMIT POST
    public function submitManagePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'imgs' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'branch' => $request->branch ?? 1,
            'title' => $request->title,
            'slog' => $request->slog ?? Str::slug($request->title),
            'category' => $request->category,
            'content' => $request->content,
            'shortContent' => $request->shortContent ?? substr(strip_tags($request->content), 0, 150),
            'tags' => $request->tags ?? '',
            'author' => $request->author ?? auth()->user()->name ?? 'Admin',
            'status' => $request->status ?? 0,
            'updated_at' => now(),
        ];

        // IMAGE UPLOAD
        if ($request->hasFile('imgs')) {
            $file = $request->file('imgs');

            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            // public/posts folder me move karega
            $file->move(public_path('posts'), $filename);

            $data['imgs'] = 'posts/' . $filename;
        }

        if ($request->id) {
            DB::table('posts')->where('id', $request->id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('posts')->insert($data);
        }

        return redirect()->route('admin.posts')->with('success', 'Post saved successfully');
    }

    // DELETE POST
    public function deletePost($id)
    {
        DB::table('posts')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    // TOGGLE STATUS
    public function togglePostStatus(Request $request, $id)
    {
        $status = $request->status;
        DB::table('posts')->where('id', $id)->update(['status' => $status, 'updated_at' => now()]);
        return response()->json(['success' => true]);
    }


    // LIST CATEGORIES
    public function postCategory()
    {
        $categories = DB::table('post_categories')->orderBy('created_at', 'desc')->get();
        return view('backend.postCategory', compact('categories'));
    }

    // MANAGE ADD/EDIT FORM
    public function managePostCategory($id = null)
    {
        $category = null;
        if ($id) {
            $category = DB::table('post_categories')->where('id', $id)->first();
        }
        return view('backend.managePostCategory', compact('category'));
    }

    // SUBMIT ADD/EDIT
    public function submitManagePostCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $data = [
            'branch' => $request->branch ?? 1,
            'title' => $request->title,
            'slog' => $request->slog ?? Str::slug($request->title),
            'status' => $request->status ?? 1,
            'updated_at' => now()
        ];

        if ($request->id) {
            DB::table('post_categories')->where('id', $request->id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('post_categories')->insert($data);
        }

        return redirect()->route('admin.postCategory')->with('success', 'Category saved successfully');
    }

    // DELETE CATEGORY
    public function deleteCategory($id)
    {
        DB::table('post_categories')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    // TOGGLE STATUS
    public function toggleCategoryStatus(Request $request, $id)
    {
        DB::table('post_categories')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);
        return response()->json(['success' => true]);
    }


    // EVENTS LIST
    public function events()
    {
        $events = DB::table('events')->orderBy('created_at', 'desc')->get();
        return view('backend.events', compact('events'));
    }

    // ADD / EDIT EVENT FORM
    public function manageEvent($id = null)
    {
        $event = null;
        if ($id) {
            $event = DB::table('events')->where('id', $id)->first();
        }

        $categories = DB::table('event_categories')->where('status', 1)->get();
        return view('backend.manageEvent', compact('event', 'categories'));
    }

    // SUBMIT EVENT
    public function submitManageEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'content' => 'required|string',
            'event_date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string|max:255',
            'duration' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'slog' => $request->slug ?? Str::slug($request->title),
            'category' => $request->category,
            'event_date' => $request->event_date,
            'time' => $request->time,
            'venue' => $request->venue,
            'duration' => $request->duration,
            'content' => $request->content,
            'status' => $request->status ?? 1,
            'updated_at' => now(),
        ];

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('events'), $filename);
            $data['image'] = 'events/' . $filename;
        }

        if ($request->id) {
            DB::table('events')->where('id', $request->id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('events')->insert($data);
        }

        return redirect()->route('admin.events')->with('success', 'Event saved successfully');
    }

    // ================= EVENT CATEGORY =================

    public function eventCategory()
    {
        $categories = DB::table('event_categories')->orderBy('created_at', 'desc')->get();
        return view('backend.eventCategory', compact('categories'));
    }

    public function manageEventCategory($id = null)
    {
        $category = null;
        if ($id) {
            $category = DB::table('event_categories')->where('id', $id)->first();
        }
        return view('backend.manageEventCategory', compact('category'));
    }

    public function submitManageEventCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $data = [
            'title' => $request->title,
            'slog' => $request->slug ?? Str::slug($request->title),
            'status' => $request->status ?? 1,
            'updated_at' => now(),
        ];

        if ($request->id) {
            DB::table('event_categories')->where('id', $request->id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('event_categories')->insert($data);
        }

        return redirect()->route('admin.eventCategory')->with('success', 'Category saved successfully');
    }

    // DELETE EVENT
    public function deleteEvent($id)
    {
        $event = DB::table('events')->where('id', $id)->first();

        // delete image if exists
        if ($event && $event->image && file_exists(public_path($event->image))) {
            unlink(public_path($event->image));
        }

        DB::table('events')->where('id', $id)->delete();

        return response()->json(['success' => true]);
    }

    // TOGGLE EVENT STATUS
    public function toggleEventStatus(Request $request, $id)
    {
        DB::table('events')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);

        return response()->json(['success' => true]);
    }


    // Facilities List
    public function facilities()
    {
        $facilities = DB::table('facilities')->orderBy('created_at', 'desc')->get();
        return view('backend.facilities', compact('facilities'));
    }

    // Manage Add/Edit Facility
    public function manageFacility($id = null)
    {
        $facility = null;
        if ($id) {
            $facility = DB::table('facilities')->where('id', $id)->first();
        }

        $categories = DB::table('facility_categories')->where('status', 1)->get();
        return view('backend.manageFacility', compact('facility', 'categories'));
    }

    // Submit Facility Add/Edit
    public function submitManageFacility(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'slog' => $request->slog ?? Str::slug($request->title),
            'category' => $request->category,
            'description' => $request->description ?? '',
            'status' => $request->status ?? 1,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('facilities'), $filename);
            $data['image'] = 'facilities/' . $filename;
        }

        if ($request->id) {
            DB::table('facilities')->where('id', $request->id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('facilities')->insert($data);
        }

        return redirect()->route('admin.facilities')->with('success', 'Facility saved successfully');
    }

    // Delete Facility
    public function deleteFacility($id)
    {
        DB::table('facilities')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    // Toggle Facility Status
    public function toggleFacilityStatus(Request $request, $id)
    {
        DB::table('facilities')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);
        return response()->json(['success' => true]);
    }

    // Facility Categories List
    public function facilityCategory()
    {
        $categories = \App\Models\Facility_categories::with('parent')->orderBy('created_at', 'desc')->get();
        return view('backend.facilityCategory', compact('categories'));
    }

    // Manage Add/Edit Facility Category
    // Manage Add/Edit Facility Category
    public function manageFacilityCategory($id = null)
    {
        $category = null;
        if ($id) {
            $category = DB::table('facility_categories')->where('id', $id)->first();
        }

        $parents = DB::table('facility_categories')
            ->where('status', 1)
            ->whereNull('parent_id') // Limit to root categories as parents for now to avoid complexity, or remove if infinite nesting allowed
            ->when($id, function ($q) use ($id) {
                return $q->where('id', '!=', $id);
            })
            ->get();

        return view('backend.manageFacilityCategory', compact('category', 'parents'));
    }

    // Submit Facility Category Add/Edit
    public function submitManageFacilityCategory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $data = [
            'title' => $request->title,
            'slog' => $request->slog ?? Str::slug($request->title),
            'parent_id' => $request->parent_id,
            'status' => $request->status ?? 1,
            'updated_at' => now(),
        ];

        if ($request->id) {
            DB::table('facility_categories')->where('id', $request->id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('facility_categories')->insert($data);
        }

        return redirect()->route('admin.facilityCategory')->with('success', 'Facility category saved successfully');
    }

    // Delete Facility Category
    public function deleteFacilityCategory($id)
    {
        DB::table('facility_categories')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    // Toggle Facility Category Status
    public function toggleFacilityCategoryStatus(Request $request, $id)
    {
        DB::table('facility_categories')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);
        return response()->json(['success' => true]);
    }

    public function availabilityIndex(Request $request)
    {
        $facilities = Facilities::all();
        // Use the corrected relationship name 'facility'
        $availabilities = FacilityAvailability::with('facility')->where('facility_id', $request->facility_id)->get();
        return view('backend.facility_availability', compact('facilities', 'availabilities'));
    }

    public function saveAvailability(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'day_of_week' => 'required|integer|min:0|max:6',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time', // Validation: end must be after start
            'slot_duration' => 'required|numeric|min:1'
        ]);

        FacilityAvailability::create($request->all());

        return response()->json(['success' => true]);
    }

    public function deleteAvailability($id)
    {
        $deleted = FacilityAvailability::destroy($id);
        if ($deleted) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    /* =======================
            FOOD ORDERS
       ======================== */
    public function foodOrders()
    {
        $orders = \App\Models\FoodOrder::with(['user', 'items.foodItem'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('backend.food_orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = \App\Models\FoodOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return response()->json(['success' => true]);
    }

    /* =======================
            EVENT REGISTRATIONS
       ======================== */
    public function eventRegistrations()
    {
        $registrations = \App\Models\EventRegistration::with(['event', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('backend.event_registrations', compact('registrations'));
    }

    /* =======================
            FACILITY BOOKINGS
       ======================== */
    public function facilityBookings()
    {
        // Assuming 'bookings' table exists as per MemberController storeBooking
        $bookings = DB::table('bookings')
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('facilities', 'bookings.facility_id', '=', 'facilities.id')
            ->select('bookings.*', 'users.first_name', 'users.last_name', 'users.email', 'facilities.title as facility_name')
            ->orderBy('bookings.created_at', 'desc')
            ->get();

        return view('backend.facility_bookings', compact('bookings'));
    }

    /* =======================
            ALL USERS
        ======================== */
    public function users()
    {
        $users = DB::table('users')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.users.index', compact('users'));
    }

    public function members()
    {
        $users = DB::table('users')
            ->where('role', '2')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.users.members', compact('users'));
    }

    public function staff()
    {
        $users = DB::table('users')
            ->where('role', '3')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.users.staff', compact('users'));
    }

    public function manageUser($id = null)
    {
        $user = null;

        if ($id) {
            $user = DB::table('users')->where('id', $id)->first();
        }

        return view('backend.users.manage', compact('user'));
    }

    public function submitManageUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'email' => 'required|email',
            'mob' => 'nullable|string|max:15',
            'role' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'branch' => $request->branch ?? '1',
            'mob' => $request->mob,
            'whatsapp' => $request->whatsapp,
            'email' => $request->email,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'role' => $request->role,
            'status' => $request->status ?? 1,
            'updated_at' => now(),
        ];

        /* PASSWORD (only if provided) */
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        /* PHOTO UPLOAD */
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('users'), $filename);
            $data['photo'] = 'users/' . $filename;
        }

        if ($request->id) {
            DB::table('users')->where('id', $request->id)->update($data);
        } else {
            $data['created_at'] = now();
            DB::table('users')->insert($data);
        }

        return redirect()->back()->with('success', 'User saved successfully');
    }

    public function deleteUser($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function toggleUserStatus(Request $request, $id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now()
            ]);

        return response()->json(['success' => true]);
    }

    // 1. Display Category List
    public function foodCategory()
    {
        // Fetching categories to pass to the @foreach($categories as $category)
        $categories = FoodCategory::orderBy('created_at', 'desc')->get();
        return view('backend.foodCategory', compact('categories'));
    }

    // 2. Show Create/Edit Form
    public function manageFoodCategory($id = null)
    {
        $category = null;
        if ($id) {
            $category = FoodCategory::findOrFail($id);
        }
        return view('backend.manageFoodCategory', compact('category'));
    }

    // 3. Store or Update Category
    public function submitManageFoodCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        $id = $request->input('id');

        // Use updateOrCreate logic
        $category = $id ? FoodCategory::find($id) : new FoodCategory();

        $category->name = $request->name;
        // Generate slug if empty or if name changed
        $category->slug = $request->slug ?: Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.foodCategory')
            ->with('success', 'Category saved successfully!');
    }

    // 4. Delete Category (AJAX)
    public function deleteFoodCategory($id)
    {
        $category = FoodCategory::findOrFail($id);
        $category->delete();

        return response()->json(['success' => true]);
    }

    // 5. Toggle Status (AJAX)
    public function toggleFoodCategoryStatus(Request $request, $id)
    {
        $category = FoodCategory::findOrFail($id);
        $category->status = $request->status;
        $category->save();

        return response()->json(['success' => true]);
    }

    public function foodItem()
    {
        $items = FoodItem::with('category')->orderBy('id', 'desc')->get();
        return view('backend.foodItem', compact('items'));
    }

    public function manageFoodItem($id = null)
    {
        $item = $id ? FoodItem::findOrFail($id) : null;
        $categories = FoodCategory::where('status', 1)->get();
        return view('backend.manageFoodItem', compact('item', 'categories'));
    }

    public function submitFoodItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:food_categories,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $item = $request->id ? FoodItem::find($request->id) : new FoodItem();
        $item->name = $request->name;
        $item->category_id = $request->category_id;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->status = $request->status;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($item->image && File::exists(public_path($item->image))) {
                File::delete(public_path($item->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('food'), $imageName);
            $item->image = 'food/' . $imageName;
        }

        $item->save();
        return redirect()->route('admin.foodItem')->with('success', 'Item saved successfully');
    }

    /*public function facilities()
    {
        return view('backend.facilities');
    }

    public function facilityCategory()
    {
        return view('backend.facilityCategory');
    }

    public function events()
    {
        return view('backend.events');
    }

    public function eventCategory()
    {
        return view('backend.eventCategory');
    }*/

    public function agm()
    {
        return view('backend.agm');
    }

    public function subscriptions()
    {
        return view('backend.subscriptions');
    }

    public function payment_history()
    {
        return view('backend.payment_history');
    }

    /*public function events()
    {
        return view('backend.events');
    }*/

    public function menu()
    {
        return view('backend.menu');
    }

    public function facility_availability()
    {
        return view('backend.facility_availability');
    }

    public function profile()
    {
        return view('backend.profile');
    }

    public function change_password()
    {
        return view('backend.change_password');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('success', 'Successfully Logged Out.');
    }

}
?>