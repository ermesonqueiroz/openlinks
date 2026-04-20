<?php

namespace App\Http\Controllers;

use App\Actions\CreateLink;
use App\Actions\UpdateLink;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\UpdateLinkRequest;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LinkController extends Controller
{
    public function index(Request $request): View
    {
        $links = $request->user()->links()->latest()->paginate(10);
        return view('app.links.index', compact('links'));
    }

    public function show(Link $link): View
    {
        return view('app.links.show', compact('link'));
    }

    public function create(): View
    {
        return view('app.links.create');
    }

    public function store(CreateLinkRequest $request, CreateLink $createLink): RedirectResponse
    {
        $createLink->execute($request->user(), $request->validated());
        return redirect()->route('links.index')->with('success', 'Link created successfully!');
    }

    public function edit(Link $link): View
    {
        return view('app.links.edit', compact('link'));
    }

    public function update(UpdateLinkRequest $request, Link $link, UpdateLink $updateLink): RedirectResponse
    {
        $updateLink->execute($link, $request->validated());
        return redirect()->route('links.show', $link)->with('success', 'Link updated successfully!');
    }

    public function destroy(Link $link): RedirectResponse
    {
        $link->delete();
        return redirect()->route('links.index')->with('success', 'Link deleted successfully!');
    }
}
