<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
{
    $this->middleware('auth'); // bắt buộc đăng nhập
    $this->middleware('can:manage-users'); // nếu bạn có Gate/Policy cho phân quyền
}

   public function index(Request $request)
{
    $currentUser = Auth::user(); // user đang đăng nhập
    $currentUserId = Auth::id(); // id user đang đăng nhập

    // Ví dụ: chỉ cho admin xem toàn bộ, doctor/staff chỉ xem chính mình
    $query = User::query();

    if ($currentUser->role !== 'admin') {
        $query->where('id', $currentUserId);
    }

    if ($request->search) {
        $query->where(function($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->search . '%')
              ->orWhere('email', 'LIKE', '%' . $request->search . '%');
        });
    }

    if ($request->role) {
        $query->where('role', $request->role);
    }

    $users = $query->orderBy('created_at', 'desc')->paginate(15);

    return view('admin.users.index', compact('users'));
}


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,doctor,staff',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được tạo thành công');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,doctor,staff',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được cập nhật thành công');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Không thể xóa tài khoản của chính mình');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Người dùng đã được xóa thành công');
    }

    public function toggleStatus(User $user)
    {
        return response()->json(['success' => false, 'message' => 'Chức năng chưa được triển khai']);
    }
}
