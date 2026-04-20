<?php

namespace App\Http\Controllers;

use App\Actions\CreateUser;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request, CreateUser $createUser): RedirectResponse
    {
        $user = $createUser->execute($request->validated());

        Auth::login($user);

        return redirect()->route('home');
    }
}
