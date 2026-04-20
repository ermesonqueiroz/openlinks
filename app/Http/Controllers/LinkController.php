<?php

namespace App\Http\Controllers;

use App\Actions\CreateLink;
use App\Http\Requests\CreateLinkRequest;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LinkController extends Controller
{
    public function index(Request $request): View
    {
        $links = $request->user()->links()->latest()->get();
        return view('app.links.index', compact('links'));
    }

    public function create(): View
    {
        return view('app.links.create');
    }

    public function store(CreateLinkRequest $request, CreateLink $createLink): RedirectResponse
    {
        $createLink->execute($request->user(), $request->validated());
        return back()->with('success', 'Link created successfully!');
    }

    public function destroy(Link $link): RedirectResponse
    {
        $link->delete();
        return back()->with('success', 'Link deleted successfully!');
    }
}
