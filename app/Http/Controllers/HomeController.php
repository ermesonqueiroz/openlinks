<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(Request $request): View
    {
        $totalClicks = DB::table('visits')
            ->join('links', 'links.id', '=', 'visits.link_id')
            ->join('users', 'users.id', '=', 'links.user_id')
            ->count();

        return view('app.home', [
            'totalLinks' => Link::query()->get()->count(),
            'totalClicks' => $totalClicks,
            'recentLinks' => Link::query()->latest()->limit(5)->get()
        ]);
    }
}
