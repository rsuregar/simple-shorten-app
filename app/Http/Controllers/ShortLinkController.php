<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortLink;

class ShortLinkController extends Controller
{
    public function create($slug=null)
    {
        $links = ShortLink::whereUserId(auth()->id())->latest()->get();

        $link = null;
        if (!is_null($slug)) {
            $link = ShortLink::firstWhere('short_link', $slug);
        }

        return view('shortlink', compact('links', 'link'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'origin_link' => 'required|active_url|url'
        ]);

        //createShortLink
        $link = ShortLink::firstOrCreate([
            'origin_link' => $request->origin_link,
            'user_id' => auth()->id(),
        ],[
            'short_link' => strtolower(\Str::random(5))
        ]);

        // $links = ShortLink::whereUserId(auth()->id())->get();
        return redirect()->route('form.create', $link->short_link);
        // return view('form', compact('link', 'links'));
    }

    public function delete()
    {
        $delete = ShortLink::find(request()->id);
        $delete->delete();
        return redirect()->back();
    }

    public function update(ShortLink $shortlink)
    {
        $validate = request()->validate([
            'short_link' => 'unique:short_links,short_link'
        ]);

        $shortlink->update(['short_link' => request()->short_link]);
        return redirect()->back()->withInput()->withErrors($validate);
    }
}
