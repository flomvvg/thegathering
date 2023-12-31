<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Models\Artist;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $upcomingEvents = $artist->getUpcomingEvents();
        $pastEvents = $artist->getPastEvents();

        $users = $artist->users()->get();
        return view('profiles.artists.show', [
            'artist' => $artist,
            'users' => $users,
            'upcomingEvents' => $upcomingEvents,
            'pastEvents' => $pastEvents,
        ]);
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

        return to_route('artists.show', $artist)->with('status', 'Your user has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $this->authorize('delete', $artist);
        DB::table('artists')
            ->where('id', $artist->id)
            ->update([
                'name' => "[Deleted Artist]",
                'description' => null,
                'tag' => null,
                'spotify' => null,
                'soundcloud' => null,
                'youtube' => null,
                'amazon_music' => null,
                'apple_music' => null,
                'website' => null,
                'archived' => true,
            ]);

        $artist->users()->detach(Auth::id());
        $artist->save();

        return to_route('users.show', Auth::user())->with('status', 'Your artist profile has been deleted');
    }
}
