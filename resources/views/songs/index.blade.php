@extends('layouts.app')

@section('content')
    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Administrar Canciones</h1>

                <!-- Botón para crear una nueva canción -->
                <a href="{{ route('songs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Nueva Canción</a>

                <!-- Tabla para listar canciones -->
                <table class="min-w-full bg-white mt-4">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Artista</th>
                            <th>Álbum</th>
                            <th>Género</th>
                            <th>Año</th>
                            <th>Duración</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($songs as $song)
                            <tr>
                                <td>{{ $song->id }}</td>
                                <td>{{ $song->title }}</td>
                                <td>{{ $song->artist->name }}</td>
                                <td>{{ $song->album->title ?? 'N/A' }}</td>
                                <td>{{ $song->genre->name }}</td>
                                <td>{{ $song->release_year }}</td>
                                <td>{{ sprintf('%02d:%02d', $song->duration_minutes, $song->duration_seconds) }}</td>
                                <td>
                                    <!-- Botón para editar -->
                                    <a href="{{ route('songs.edit', $song->id) }}"
                                        class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</a>
                                    <!-- Botón para eliminar -->
                                    <form action="{{ route('songs.destroy', $song->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta canción?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                {{ $songs->links() }}
            </div>
        </div>
    </div>
@endsection
