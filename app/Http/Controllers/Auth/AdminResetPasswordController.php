<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminResetPasswordController extends Controller
{
    public function showResetForm(Request $request, string $token): View
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    public function reset(AdminResetPasswordRequest $request): RedirectResponse
    {
        $status = Password::broker('admins')->reset(
            $request->validated(),
            function ($admin, string $password): void {
                $admin->forceFill([
                    'password' => Hash::make($password),
                ]);

                $admin->setRememberToken(Str::random(60));
                $admin->save();

                event(new PasswordReset($admin));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()
                ->route('admin.login')
                ->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
