<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class LoginController extends Controller
{
    // Show login page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // STEP 1: Check email + password and SEND OTP to email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid email or password');
        }

        // Generate OTP
        $code = rand(100000, 999999);

        // Save OTP in database
        Otp::create([
            'user_id'    => $user->id,
            'code'       => $code,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Store user id in session
        session(['otp_user_id' => $user->id]);

        // ✅ SEND OTP TO USER EMAIL
        Mail::to($user->email)->send(new OtpMail($code));

        return view('auth.otp_verify')
            ->with('success', 'OTP sent to your email. Please check your inbox.');
    }

    // STEP 2: Verify OTP and LOGIN
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'OTP session expired');
        }

        $otp = Otp::where('user_id', $userId)
            ->where('code', $request->code)
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        if (!$otp) {
            return back()->with('error', 'Invalid or expired OTP');
        }

        // Login user
        Auth::loginUsingId($userId);

        // Clear OTP session
        session()->forget('otp_user_id');

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
