<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::with(['artist', 'album', 'genre'])->paginate(10);
        return view('songs.index', compact('songs'));
    }

    public function create()
    {
        $artists = Artist::all();
        $genres = Genre::all();
        $playlists = Playlist::all();
        return view('songs.create', compact('artists', 'genres', 'playlists'));
    }

    public function store(Request $request)
    {
        try {
            $song = new Song();
            $song->title = $request->input('title');
            $song->artist_id = $request->input('artist_id');
            $song->album_id = $request->input('album_id');
            $song->genre_id = $request->input('genre_id');
            $song->playlist_id = $request->input('playlist_id');
            $song->release_year = $request->input('release_year');
            $song->duration_minutes = $request->input('duration_minutes');
            $song->duration_seconds = $request->input('duration_seconds');

            if ($request->hasFile('cover')) {
                $song->cover = $request->file('cover')->store('covers');
            }

            if ($request->hasFile('file_path')) {
                $song->file_path = $request->file('file_path')->store('songs');
            }

            $song->description = $request->input('description');
            $song->save();

            return response()->json(['success' => true, 'message' => 'Canción publicada exitosamente.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al guardar la canción.', 'error' => $e->getMessage()]);
        }
    }

    public function edit(Song $song)
    {
        $artists = Artist::all();
        $genres = Genre::all();
        $playlists = Playlist::all();
        return view('songs.edit', compact('song', 'artists', 'genres', 'playlists'));
    }

    public function update(Request $request, Song $song)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_id' => 'nullable|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'playlist_id' => 'nullable|exists:playlists,id',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'duration_minutes' => 'required|integer|min:0',
            'duration_seconds' => 'required|integer|min:0|max:59',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file_path' => 'nullable|mimes:mp3|max:10240',
            'description' => 'nullable|string',
        ]);
        dd($request->all());

        $data = $request->all();

        // Actualizar carátula si se proporciona
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        // Actualizar archivo MP3 si se proporciona
        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('songs', 'public');
        }

        $song->update($data);

        return redirect()->route('songs.index')->with('success', 'Canción actualizada exitosamente.');
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return redirect()->route('songs.index')->with('success', 'Canción eliminada exitosamente.');
    }
}