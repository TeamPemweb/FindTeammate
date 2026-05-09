<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\SendOTPMail;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showSignup() { return view('auth.signup'); }

    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $otpCode = rand(100000, 999999);
    
    $hashedOtp = Hash::make($otpCode . env('OTP_SECRET_SALT'));

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'otp' => $hashedOtp,
        'otp_expires_at' => Carbon::now()->addMinutes(10),
    ]);

    Mail::to($user->email)->send(new SendOTPMail($otpCode, $user->name));

    session(['otp_email' => $user->email]);

    return redirect()->route('otp')->with('success', 'Kode OTP telah dikirim ke email kamu.');
}

public function verifyOtp(Request $request)
{
    $request->validate(['otp' => 'required|numeric']);
    
    $email = session('otp_email');
    $user = User::where('email', $email)->first();

    if (!$user || !$user->otp_expires_at || Carbon::now()->isAfter($user->otp_expires_at)) {
    return back()->withErrors(['otp' => 'Kode OTP kadaluwarsa atau tidak valid.']);
    }

    if (Hash::check($request->otp . env('OTP_SECRET_SALT'), $user->otp)) {
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
            'is_verified' => true
        ]);

        Auth::login($user);
        session()->forget('otp_email');
        return redirect()->route('dashboard.dikelola');
    }

        return back()->withErrors(['otp' => 'Kode OTP salah.']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            
            if (!Auth::user()->is_verified) {
            $userEmail = Auth::user()->email;
            Auth::logout();
            
            session(['otp_email' => $userEmail]);
            return redirect()->route('otp')->with('error', 'Akun kamu belum diverifikasi. Silakan masukkan OTP.');
            }
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil masuk sebagai admin!');
            }

            return redirect()->route('dashboard.dikelola')->with('success', 'Berhasil masuk!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil keluar.');
    }
}