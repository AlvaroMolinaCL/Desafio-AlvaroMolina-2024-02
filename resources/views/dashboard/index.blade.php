@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 text-center">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Panel de Administración</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Tarjeta de Géneros -->
                    <a href="{{ route('genres.index') }}" class="p-6 bg-blue-100 rounded-lg shadow hover:bg-blue-200">
                        <h2 class="text-lg font-semibold">Géneros Musicales</h2>
                        <p>Gestiona los géneros disponibles.</p>
                    </a>

                    <!-- Tarjeta de Álbumes -->
                    <a href="{{ route('albums.index') }}" class="p-6 bg-green-100 rounded-lg shadow hover:bg-green-200">
                        <h2 class="text-lg font-semibold">Álbumes/Sencillos</h2>
                        <p>Gestiona los álbumes y sencillos.</p>
                    </a>

                    <!-- Tarjeta de Artistas -->
                    <a href="{{ route('artists.index') }}" class="p-6 bg-yellow-100 rounded-lg shadow hover:bg-yellow-200">
                        <h2 class="text-lg font-semibold">Artistas</h2>
                        <p>Gestiona los artistas.</p>
                    </a>

                    <!-- Tarjeta de Playlists -->
                    <a href="{{ route('playlists.index') }}" class="p-6 bg-red-100 rounded-lg shadow hover:bg-red-200">
                        <h2 class="text-lg font-semibold">Playlists</h2>
                        <p>Gestiona las playlists.</p>
                    </a>

                    <!-- Tarjeta de Canciones -->
                    <a href="{{ route('songs.index') }}" class="p-6 bg-blue-100 rounded-lg shadow hover:bg-blue-200">
                        <h2 class="text-lg font-semibold">Canciones publicadas</h2>
                        <p>Gestiona las canciones publicadas.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
