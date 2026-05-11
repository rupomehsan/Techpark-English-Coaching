<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpResetMail;
use App\Modules\Management\UserManagement\User\Models\Model as User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) return redirect('/');
        return view('frontend.pages.auth.login');
    }

    public function login_submit()
    {
        $this->validate(request(), [
            "email"    => ["required"],
            "password" => ["required"],
        ]);

        $user = User::where('email', request()->email)->first();

        if (!$user) {
            throw ValidationException::withMessages(['email' => ['Invalid email or mobile number.']]);
        }

        if (!Hash::check(request()->password, $user->password)) {
            throw ValidationException::withMessages(['password' => ['Invalid password.']]);
        }

        $studentRoleSerial = config('roleManagement.student');
        if (!$user->where('role_id', $studentRoleSerial)->exists()) {
            return redirect()->back()->with('error', 'You are not authorized to access this platform.');
        }

        Auth::login($user, request()->boolean('remember'));

        $urls = Session::get('url');
        if (isset($urls['intended'])) {
            return redirect($urls['intended']);
        }

        return redirect()->route('myCourse');
    }

    public function logout_submit()
    {
        if (auth()->check()) {
            $this->remove_access_token();
            auth()->logout();
        }
        return redirect('/')->withCookie(cookie("AXRF-TOKEN", ''));
    }

    public function remove_access_token()
    {
        DB::table('oauth_access_tokens')->where('user_id', auth()->user()->id)->update(['revoked' => 1]);
    }

    public function register()
    {
        if (auth()->check()) return redirect('/');
        return view('frontend.pages.auth.register');
    }

    public function register_sumbit()
    {
        $this->validate(request(), [
            "first_name"   => ["required"],
            "last_name"    => ["required"],
            "phone_number" => ["required", "unique:user_addresses,phone_number"],
            "email"        => ["required", "unique:users,email"],
            "password"     => ["required"],
        ]);

        $user = User::create([
            'role_id'    => config('roleManagement.student'),
            "first_name" => request()->first_name,
            "last_name"  => request()->last_name,
            "email"      => request()->email,
            "password"   => Hash::make(request()->password),
        ]);

        DB::table('user_addresses')->insert([
            'user_id'      => $user->id,
            'phone_number' => json_encode(request()->phone_number),
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ]);

        Auth::login($user, true);

        $urls = Session::get('url');
        if (isset($urls['intended'])) {
            return redirect($urls['intended']);
        }

        return redirect()->route('myCourse');
    }

    // ─── Forgot Password (OTP Flow) ──────────────────────────────────────────

    public function forgotPassword()
    {
        if (auth()->check()) return redirect('/');
        return view('frontend.pages.auth.forgot_password');
    }

    public function forgotPasswordSubmit(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found with this email address.']);
        }

        // Generate 6-digit OTP
        $otp = (string) random_int(100000, 999999);

        // Store hashed OTP in password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($otp), 'created_at' => Carbon::now()]
        );

        // Store email in session for next step
        session(['otp_email' => $request->email]);

        // Send OTP email
        try {
            Mail::to($request->email)->send(new OtpResetMail($otp, $user->first_name ?? 'User'));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('OTP mail failed: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to send email: ' . $e->getMessage()]);
        }

        return redirect()->route('verify.otp')->with('status', 'A 6-digit verification code has been sent to your email.');
    }

    public function verifyOtp()
    {
        if (!session('otp_email')) return redirect()->route('forgot.password');
        return view('frontend.pages.auth.verify_otp', ['email' => session('otp_email')]);
    }

    public function verifyOtpSubmit(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $email = session('otp_email');
        if (!$email) return redirect()->route('forgot.password');

        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record) {
            return back()->withErrors(['otp' => 'No reset request found. Please request a new code.']);
        }

        // Check expiry (15 minutes)
        if (Carbon::parse($record->created_at)->addMinutes(15)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            session()->forget('otp_email');
            return redirect()->route('forgot.password')->with('error', 'Verification code has expired. Please request a new one.');
        }

        if (!Hash::check($request->otp, $record->token)) {
            return back()->withErrors(['otp' => 'Invalid verification code. Please try again.']);
        }

        // OTP verified — store flag in session
        session(['otp_verified_email' => $email]);
        session()->forget('otp_email');
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('reset.password.form');
    }

    public function resetPasswordForm()
    {
        if (!session('otp_verified_email')) {
            return redirect()->route('forgot.password')->with('error', 'Please verify your email first.');
        }
        return view('frontend.pages.auth.reset_password', ['email' => session('otp_verified_email')]);
    }

    public function resetPasswordSubmit(Request $request)
    {
        $email = session('otp_verified_email');
        if (!$email) {
            return redirect()->route('forgot.password')->with('error', 'Session expired. Please start again.');
        }

        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        User::where('email', $email)->update(['password' => Hash::make($request->password)]);

        session()->forget('otp_verified_email');

        return redirect()->route('login')->with('status', 'Password reset successfully. Please sign in with your new password.');
    }
}
