@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 text-center">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Playlists</h1>
                <a href="{{ route('playlists.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Crear Playlist</a>
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
                        <thead class="hover:bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">ID</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">Nombre</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-semibold border-b">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($playlists as $playlist)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $playlist->id }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">{{ $playlist->name }}</td>
                                    <td class="px-4 py-3 border-b text-gray-700">
                                        <a href="{{ route('playlists.edit', $playlist) }}"
                                            class="bg-blue-500 text-white px-4 py-2 rounded">Editar</a>
                                        <form action="{{ route('playlists.destroy', $playlist) }}" method="POST"
                                            class="inline">
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
                    {{ $playlists->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
