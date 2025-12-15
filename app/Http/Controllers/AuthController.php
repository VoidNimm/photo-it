<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    public function showForgotPasswordForm(): View
    {
        return view('auth.forgot-password');
    }

    public function sendPasswordResetLink(ForgotPasswordRequest $request): RedirectResponse
    {
        // Cek apakah user adalah user biasa (bukan admin)
        $user = User::where('email', $request->email)->first();

        if ($user && !$user->isAdmin() && !$user->isSuperAdmin()) {
            // Generate token
            $token = Str::random(64);

            // Simpan token ke database
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'token' => hash('sha256', $token),
                    'created_at' => Carbon::now(),
                ]
            );

            // Kirim email
            $user->sendPasswordResetNotification($token);

            return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
        }

        // Jika admin, jangan beri tahu bahwa email tidak ditemukan (security)
        return back()->with('status', 'Jika email terdaftar, link reset password telah dikirim.');
    }

    public function showResetPasswordForm(string $token): View
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        // Cek token valid
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', hash('sha256', $request->token))
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Token tidak valid atau sudah kadaluarsa.']);
        }

        // Cek apakah user adalah user biasa
        $user = User::where('email', $request->email)->first();

        if (!$user || $user->isAdmin() || $user->isSuperAdmin()) {
            return back()->withErrors(['email' => 'Reset password tidak diizinkan untuk akun ini.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus token
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('login')->with('status', 'Password berhasil direset. Silakan login dengan password baru.');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (
            Auth::attempt(
                ['email' => $credentials['email'], 'password' => $credentials['password']],
                $remember
            )
        ) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => \App\Enums\UserRole::User, // user biasa
        ]);

        Auth::login($user);

        return redirect()->route('index')->with('success', 'Registrasi berhasil! Selamat datang.');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('index');
    }


}