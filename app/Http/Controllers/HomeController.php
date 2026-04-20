<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('app.home', [
            'totalLinks' => $request->user()->links()->count(),
            'totalClicks' => 0,
            'recentLinks' => $request->user()->links()->orderByDesc('created_at')->limit(3)->get()
        ]);
    }
}
