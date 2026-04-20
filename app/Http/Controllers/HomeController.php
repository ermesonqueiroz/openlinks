<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();
        $totalClicks = DB::table('visits')
            ->join('links', 'links.id', '=', 'visits.link_id')
            ->join('users', 'users.id', '=', 'links.user_id')
            ->where('users.id', '=', $user->id)
            ->count();

        return view('app.home', [
            'totalLinks' => $user->links()->count(),
            'totalClicks' => $totalClicks,
            'recentLinks' => $user->links()->orderByDesc('created_at')->limit(3)->get()
        ]);
    }
}
