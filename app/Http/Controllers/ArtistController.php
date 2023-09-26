<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Models\Artist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profiles.artists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArtistRequest $request)
    {
        $artist = Artist::create($request->validated());
        $artist->users()->attach(Auth::user());

        return to_route('artists.show', ['artist' => $artist]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $users = $artist->users()->get();
        return view('profiles.artists.show', ['artist' => $artist, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        $this->authorize('edit', $artist);
        return view('profiles.artists.edit', ['artist' => $artist]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArtistRequest $request, Artist $artist)
    {
        $this->authorize('edit', $artist);
        $artist->update($request->validated());
        $users = $artist->users()->get();

        return view('profiles.artists.show', ['organizer' => $artist, 'users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $this->authorize('delete', $artist);
        $dateTime = Carbon::now();
        $name = Hash::make($artist->name);
        $name = $name . $dateTime->toString();
        $artist->name = "Deleted Artist [" . Hash::make($name) . "]";
        $artist->description = null;
        $artist->spotify = null;
        $artist->soundcloud = null;
        $artist->youtube = null;
        $artist->amazon_music = null;
        $artist->apple_music = null;
        $artist->website = null;
        $artist->archived = true;
        $artist->save();

        return to_route('users.show', Auth::user())->with('status', 'Your artist profile has been deleted');
    }
}
