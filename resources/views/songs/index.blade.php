@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 text-center">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Administrar Canciones</h1>
                <a href="{{ route('songs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Nueva Canción</a>
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
                        <thead class="hover:bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">#</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">Título</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">Artista</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">Álbum</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">Género</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">Año</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">Duración</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($songs as $song)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $song->id }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $song->title }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $song->artist->name }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $song->album->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $song->genre->name }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $song->release_year }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">
                                        {{ sprintf('%02d:%02d', $song->duration_minutes, $song->duration_seconds) }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">
                                        <a href="{{ route('songs.edit', $song->id) }}"
                                            class="bg-blue-500 text-white px-4 py-2 rounded">Editar</a>
                                        <form action="{{ route('songs.destroy', $song->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta canción?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-2 rounded">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $songs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
