@extends('layouts.app')

@section('content')
    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Artistas</h1>
                <a href="{{ route('artists.create') }}" class="bg-blue-500 text-black px-4 py-2 rounded">Crear Artista</a>

                <table class="min-w-full bg-white mt-4">
                    <thead>
                        <tr>
                            <th class="py-2">ID</th>
                            <th class="py-2">Nombre</th>
                            <th class="py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artists as $artist)
                            <tr>
                                <td class="py-2">{{ $artist->id }}</td>
                                <td class="py-2">{{ $artist->name }}</td>
                                <td class="py-2">
                                    <a href="{{ route('artists.edit', $artist) }}"
                                        class="bg-yellow-500 text-black px-4 py-2 rounded">Editar</a>
                                    <form action="{{ route('artists.destroy', $artist) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-black px-4 py-2 rounded">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection