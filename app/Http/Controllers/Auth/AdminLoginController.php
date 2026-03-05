<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // Proses login (Support Username & Email)
    public function login(Request $request)
    {
        // 1. Validasi input sederhana
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Cek apakah input adalah email atau username
        // Jika formatnya email, kita cari di kolom 'email', jika bukan maka kolom 'username'
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Susun kredensial berdasarkan hasil deteksi di atas
        $credentials = [
            $fieldType => $request->username,
            'password' => $request->password,
        ];

        // 4. Eksekusi login dengan Guard Admin dan fitur Remember Me
        // $request->boolean('remember') akan mengambil nilai true jika checkbox dicentang
        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        // 5. Jika gagal, kembalikan dengan pesan error
        return back()
            ->withInput($request->only('username', 'remember'))
            ->withErrors([
                'username' => 'Kredensial yang diberikan tidak cocok dengan data kami.',
            ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}