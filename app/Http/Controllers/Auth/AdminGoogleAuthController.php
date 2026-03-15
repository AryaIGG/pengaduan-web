<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Throwable;

class AdminGoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (InvalidStateException $exception) {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (Throwable $exception) {
            Log::error('Google login failed.', [
                'message' => $exception->getMessage(),
                'class' => $exception::class,
            ]);

            return redirect()
                ->route('admin.login')
                ->withErrors(['username' => 'Login Google gagal. Silakan coba lagi.']);
        }

        $email = $googleUser->getEmail();

        if (! $email) {
            return redirect()
                ->route('admin.login')
                ->withErrors(['username' => 'Email Google tidak ditemukan.']);
        }

        $admin = Admin::query()->where('email', $email)->first();

        if (! $admin) {
            return redirect()
                ->route('admin.login')
                ->withErrors(['username' => 'Email tersebut belum terdaftar sebagai admin.']);
        }

        $admin->forceFill([
            'avatar_url' => $googleUser->getAvatar(),
            'username' => $admin->username ?: Str::before($email, '@'),
        ])->save();

        Auth::guard('admin')->login($admin, true);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
}
