@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Editar Álbum</h1>

                <form action="{{ route('albums.update', $album) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Campo para el título del álbum -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold">Nombre del Álbum:</label>
                        <input type="text" name="name" id="name"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
                            value="{{ old('name', $album->name) }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Campo select para elegir el artista -->
                    <div class="mb-4">
                        <label for="artist_id" class="block text-gray-700 font-bold">Artista:</label>
                        <select name="artist_id" id="artist_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="">Seleccione un artista</option>
                            @foreach ($artists as $artist)
                                <option value="{{ $artist->id }}"
                                    {{ old('artist_id', $album->artist_id) == $artist->id ? 'selected' : '' }}>
                                    {{ $artist->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('artist_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
                        <a href="{{ route('albums.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
