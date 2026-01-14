<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Branches;
use App\Models\User;
use App\Models\Usermetas;
use App\Models\Sliders;
use App\Models\Pages;
use App\Models\Contacts;
use App\Models\Enquiries;
use App\Models\Posts;
use App\Models\Post_categories;

use Carbon\Carbon;

class FrontendController extends Controller
{

    public function index()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about-us');
    }

    public function contact()
    {
        return view('frontend.contact-us');
    }

    public function tennis()
    {
        return view('frontend.tennis');
    }

    public function billiards()
    {
        return view('frontend.billiards');
    }

    public function functionalTraining()
    {
        return view('frontend.functional-training');
    }

    public function tableTennis()
    {
        return view('frontend.table-tennis');
    }

    public function cardRoom()
    {
        return view('frontend.card-room');
    }

    public function childrensPlayArea()
    {
        return view('frontend.childrens-playArea');
    }

    public function wodehouseChambers()
    {
        return view('frontend.wodehouse-chambers');
    }

    public function wodehouseLounge()
    {
        return view('frontend.wodehouse-lounge');
    }

    public function wodehouseCourtyard()
    {
        return view('frontend.wodehouse-courtyard');
    }

    public function diningBar()
    {
        return view('frontend.dining-bar');
    }


    public function gymkhanaAffiliation()
    {
        return view('frontend.gymkhana-affiliation');
    }

    //Website Login
    public function login()
    {
        return view('frontend.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = [
            'email' => $request->memberId,
            'password' => $request->password,
        ];

        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();

        if (Auth::guard('member')->attempt($credentials)) {
            $user = Auth::guard('member')->user();

            if ($user->status != '1') {
                Auth::guard('member')->logout();
                return back()->with('error', 'Your account is inactive. Please contact the support team for assistance.');
            }

            if ($user->role == '5') {
                session(['users' => $user]);
                return redirect('/member/dashboard')->with('success', 'Welcome Back, ' . $user->first_name . '!');
            }

            Auth::guard('member')->logout();
            return back()->with('error', 'You are not authorized as a buyer.');
        }

        return back()->with('error', 'Invalid login credentials.');
    }

    public function loginOtp()
    {
        return view('frontend.login-otp');
    }

    public function loginOtpPost(Request $request)
    {
        $request->validate([
            'mobile' => 'required|exists:users,mob',
        ]);

        // Logic to generate and send OTP would go here.
        // For now, we simulate OTP sent.

        // Session::put('otp_mobile', $request->mobile);
        // Session::put('otp_code', '1234'); // Hardcoded for testing

        return redirect('/otp')->with('success', 'OTP sent to your mobile number. (Use 1234 for testing)');
    }

    public function signup()
    {
        return view('frontend.signup');
    }

    public function signupPost(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mob' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'mob' => $validatedData['mob'],
            'password' => Hash::make($validatedData['password']),
            'role' => 5, // Member role
            'status' => 1, // Active by default
            'branch' => 1, // Default branch
        ]);

        // Create empty metadata entry
        Usermetas::create([
            'uid' => $user->id,
            'status' => 1
        ]);

        // Auto-login or redirect to login
        // Auth::guard('member')->login($user);
        // return redirect()->route('member.dashboard')->with('success', 'Registration successful!');

        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }

    public function otp()
    {
        return view('frontend.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp1' => 'required',
            'otp2' => 'required',
            'otp3' => 'required',
            'otp4' => 'required',
        ]);

        $otp = $request->otp1 . $request->otp2 . $request->otp3 . $request->otp4;

        // Mock verification
        if ($otp == '1234') {
            // Logic to log user in via mobile number from session
            // $user = User::where('mob', Session::get('otp_mobile'))->first();
            // Auth::guard('member')->login($user);

            return redirect('/member/dashboard')->with('success', 'Logged in successfully.');
        }

        return back()->with('error', 'Invalid OTP.');
    }

    public function forgotPassword()
    {
        return view('frontend.forgot-password'); // Ensure view name matches file
    }

    public function forgotPasswordPost(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Logic to send password reset link
        // We can generate a token and send an email using Mail::to()...

        return back()->with('success', 'We have e-mailed your password reset link!');
    }

    public function createNewPassword()
    {
        return view('frontend.create-new-password');
    }

    public function createNewPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        // Logic to reset password would go here

        return redirect('/login')->with('success', 'Password has been reset!');
    }

    public function myAccount()
    {
        return view('frontend.my-account');
    }

    public function myProfile()
    {
        return view('frontend.my-profile');
    }

    public function facilities($type = null)
    {
        $facilities = DB::table('facilities')
            ->when($type, function ($query, $type) {
                return $query->where('category', 'LIKE', $type);
            })
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $facility_categories = DB::table('facility_categories')->where('slog', 'LIKE', $type)->first();
        $type = $facility_categories->title;

        return view('frontend.facilities', compact('facilities', 'type'));
    }

    public function facilityDetails($slog)
    {
        $facility = DB::table('facilities')
            ->where('slog', $slog)
            ->where('status', 1)
            ->first();

        if (!$facility) {
            abort(404);
        }

        return view('frontend.facility-details', compact('facility'));
    }

    public function events()
    {
        $events = DB::table('events')
            ->where('status', 1)
            ->orderBy('event_date', 'asc')
            ->paginate(6);

        return view('frontend.events', compact('events'));
    }

    public function eventDetails($slog)
    {
        $event = DB::table('events')
            ->where('slog', $slog)
            ->where('status', 1)
            ->first();

        if (!$event) {
            abort(404);
        }

        return view('frontend.event-details', compact('event'));
    }

    public function blogs()
    {
        $blogs = DB::table('posts')
            ->where('status', 1) // only published
            ->orderBy('created_at', 'desc')
            ->paginate(6); // SEO + performance

        return view('frontend.blogs', compact('blogs'));
    }

    public function postArticle($slog)
    {
        $post = DB::table('posts')
            ->where('slog', $slog)
            ->where('status', 1)
            ->first();

        if (!$post) {
            abort(404);
        }

        // Related posts (same category)
        $relatedPosts = DB::table('posts')
            ->where('status', 1)
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->limit(4)
            ->get();

        return view('frontend.blog-details', compact('post', 'relatedPosts'));
    }

}
?>