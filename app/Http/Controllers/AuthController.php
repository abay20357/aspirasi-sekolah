<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani proses login
    public function login(Request $request)
    {
        // Validasi input: identity (NIS/Username), password, dan role harus ada
        $request->validate([
            'identity' => ['required', 'string'],
            'password' => ['required', 'string'],
            'role' => ['required', 'in:student,admin'],
        ]);

        $identity = $request->identity;
        $password = $request->password;
        $role = $request->role;

        // Gunakan role untuk menentukan field apa yang dipakai login
        // Jika siswa pakai 'nis', jika admin pakai 'username'
        $field = ($role === 'student') ? 'nis' : 'username';

        // Coba login dengan kredensial yang diberikan
        if (Auth::attempt([$field => $identity, 'password' => $password], $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Arahkan ke dashboard sesuai role
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('student.dashboard'));
        }

        // Jika login gagal, kembalikan dengan pesan error
        throw ValidationException::withMessages([
            'identity' => __('NIS/Username atau kata sandi salah.'),
        ]);
    }

    // Menangani proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }

    // API untuk mengecek apakah NIS terdaftar (dipakai di form login)
    public function checkNis(Request $request)
    {
        $request->validate(['nis' => 'required|string']);

        $student = \App\Models\User::where('role', 'student')
            ->where('nis', $request->nis)
            ->first();

        if ($student) {
            return response()->json([
                'status' => 'found',
                'name' => $student->name,
                'class_name' => $student->class_name ?? '-'
            ]);
        }

        return response()->json(['status' => 'not_found']);
    }
}
