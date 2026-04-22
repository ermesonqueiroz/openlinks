<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->latest()->paginate(10);
        return view('app.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('app.users.create');
    }

    public function store(RegisterRequest $request, CreateUser $createUser): RedirectResponse
    {
        $createUser->execute($request->validated());
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
