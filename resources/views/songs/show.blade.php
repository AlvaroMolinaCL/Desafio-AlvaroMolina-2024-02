@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 bg-white">
        <div class="flex py-12 md:flex-row items-center md:items-start gap-6" style="display: flex; justify-content: center;">
            <!-- Carátula -->
            <div class="flex-shrink-0">
                <img src="{{ Storage::url($song->cover) }}" alt="Carátula de {{ $song->name }}"
                    class="w-64 h-64 object-cover rounded-lg">
            </div>

            <!-- Detalles de la canción -->
            <div class="flex-grow">
                <h1 class="text-2xl font-bold text-gray-800">{{ $song->name }}</h1>
                <p class="text-lg text-gray-600">Artista: <span class="font-semibold">{{ $song->artist->name }}</span></p>
                <p class="text-lg text-gray-600">Álbum: <span class="font-semibold">{{ $song->album->name }}</span></p>
                @if ($song->playlist)
                    <p class="text-lg text-gray-600">Playlist: <span
                            class="font-semibold">{{ $song->playlist->name }}</span></p>
                @endif
                <p class="text-lg text-gray-600">Género: <span class="font-semibold">{{ $song->genre->name }}</span></p>
                <p class="text-lg text-gray-600">Año de lanzamiento: <span
                        class="font-semibold">{{ $song->release_year }}</span></p>
                <p class="text-lg text-gray-600">Duración: <span class="font-semibold">{{ $formattedDuration }}</span></p>
            </div>
        </div>

        <!-- Reproductor de audio -->
        <div class="mt-6">
            <audio controls class="w-full">
                <source src="{{ Storage::url($song->file_path) }}" type="audio/mpeg">
                Tu navegador no soporta el elemento de audio.
            </audio>
        </div>

        @if ($song->description)
            <p class="text-gray-800 mt-3">{{ $song->description }}</p>
        @endif

        <!-- Navegación entre canciones -->
        <div class="flex justify-between mt-6">
            @if ($previousSong)
                <a href="{{ route('songs.show', $previousSong->id) }}" class="text-blue-500 hover:underline">Anterior</a>
            @else
                <span class="text-gray-400">Anterior</span>
            @endif

            @if ($nextSong)
                <a href="{{ route('songs.show', $nextSong->id) }}" class="text-blue-500 hover:underline">Siguiente</a>
            @else
                <span class="text-gray-400">Siguiente</span>
            @endif
        </div>
    </div>
@endsection
