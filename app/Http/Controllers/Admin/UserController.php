<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('username', 'like', '%' . $request->search . '%')
                    ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(10)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|required_if:role,student|string|max:255',
            'username' => 'nullable|required_if:role,admin|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,student',
            'nis' => 'nullable|required_if:role,student|unique:users,nis',
            'class_name' => 'nullable|required_if:role,student|string|max:50',
        ]);

        // Auto-fill missing fields based on role
        $name = $request->name ?? $request->username;
        $username = $request->username ?? $request->nis;

        User::create([
            'name' => $name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'nis' => $request->nis,
            'class_name' => $request->class_name,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'nullable|required_if:role,student|string|max:255',
            'username' => ['nullable', 'required_if:role,admin', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,student',
            'nis' => ['nullable', 'required_if:role,student', Rule::unique('users')->ignore($user->id)],
            'class_name' => 'nullable|required_if:role,student|string|max:50',
        ]);

        // Auto-fill missing fields based on role
        $name = $request->name ?? $request->username ?? $user->name;
        $username = $request->username ?? $request->nis ?? $user->username;

        $data = [
            'name' => $name,
            'username' => $username,
            'email' => $request->email,
            'role' => $request->role,
            'nis' => $request->nis,
            'class_name' => $request->class_name,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if ($user->aspirations()->count() > 0) {
            // Option: Prevent delete or Soft Delete. For now, prevent.
            return back()->with('error', 'User tidak dapat dihapus karena memiliki data aspirasi. Silakan hapus aspirasi terlebih dahulu.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
