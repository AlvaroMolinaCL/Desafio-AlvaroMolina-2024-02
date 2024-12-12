@extends('layouts.app')

@section('content')
    <div class="container max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-4">Editar Canción</h1>

                <!-- Formulario -->
                <form id="songEditForm" action="{{ route('songs.update', $song->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Título de la canción -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-bold">Título de la Canción:</label>
                        <input type="text" name="title" id="title"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
                            value="{{ old('title', $song->title) }}">
                    </div>

                    <!-- Artista -->
                    <div class="mb-4">
                        <label for="artist_id" class="block text-gray-700 font-bold">Artista:</label>
                        <select name="artist_id" id="artist_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="" disabled>Seleccione un artista</option>
                            @foreach ($artists as $artist)
                                <option value="{{ $artist->id }}" {{ $artist->id == $song->artist_id ? 'selected' : '' }}>
                                    {{ $artist->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Álbum (cargado dinámicamente según el artista seleccionado) -->
                    <div class="mb-4">
                        <label for="album_id" class="block text-gray-700 font-bold">Álbum:</label>
                        <select name="album_id" id="album_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="" disabled>Seleccione un álbum</option>
                        </select>
                    </div>

                    <!-- Género -->
                    <div class="mb-4">
                        <label for="genre_id" class="block text-gray-700 font-bold">Género</label>
                        <select name="genre_id" id="genre_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="" disabled>Seleccione un género</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ $genre->id == $song->genre_id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Playlist -->
                    <div class="mb-4">
                        <label for="playlist_id" class="block text-gray-700 font-bold">Playlist (opcional)</label>
                        <select name="playlist_id" id="playlist_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                            <option value="" disabled>Selecciona una playlist</option>
                            @foreach ($playlists as $playlist)
                                <option value="{{ $playlist->id }}"
                                    {{ $playlist->id == $song->playlist_id ? 'selected' : '' }}>
                                    {{ $playlist->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Año de lanzamiento -->
                    <div class="mb-4">
                        <label for="release_year" class="block text-gray-700 font-bold">Año de lanzamiento</label>
                        <input type="number" name="release_year" id="release_year"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
                            value="{{ old('release_year', $song->release_year) }}" required min="1900" max="{{ date('Y') }}">
                    </div>

                    <!-- Duración -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold">Duración</label>
                        <div class="row">
                            <div class="col">
                                <input type="number" name="duration_minutes"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
                                    placeholder="Minutos" value="{{ old('duration_minutes', $song->duration_minutes) }}" required>
                            </div>
                            <div class="col">
                                <input type="number" name="duration_seconds"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500"
                                    placeholder="Segundos" value="{{ old('duration_seconds', $song->duration_seconds) }}" required max="59">
                            </div>
                        </div>
                    </div>

                    <!-- Carátula -->
                    <div class="mb-4">
                        <label for="cover" class="block text-gray-700 font-bold">Carátula (opcional)</label>
                        <input type="file" name="cover" id="cover"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                    </div>

                    <!-- Archivo MP3 -->
                    <div class="mb-4">
                        <label for="file_path" class="block text-gray-700 font-bold">Archivo MP3</label>
                        <input type="file" name="file_path" id="file_path"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">
                    </div>

                    <!-- Descripción -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold">Reseña o descripción
                            (opcional)</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-500">{{ old('description', $song->description) }}</textarea>
                    </div>

                    <!-- Botón de enviar -->
                    <div>
                        <button type="button" id="updateSong" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Actualizar
                        </button>
                        <a href="{{ route('songs.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('artist_id').addEventListener('change', function() {
            const artistId = this.value;
            const albumSelect = document.getElementById('album_id');

            albumSelect.innerHTML = '<option value="">Seleccione un álbum</option>';

            if (artistId) {
                fetch(`/api/albums/by-artist/${artistId}`)
                    .then(response => response.json())
                    .then(albums => {
                        albums.forEach(album => {
                            const option = document.createElement('option');
                            option.value = album.id;
                            option.textContent = album.name;
                            option.selected = album.id == {{ $song->album_id ?? 'null' }};
                            albumSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al cargar los álbumes:', error));
            }
        });

        document.getElementById('updateSong').addEventListener('click', function() {
            const formData = new FormData(document.getElementById('songEditForm'));

            fetch('{{ route('songs.update', $song->id) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud.');
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire('¡Éxito!', data.message, 'success');
                    window.location.href = "{{ route('songs.index') }}";
                })
                .catch(error => {
                    Swal.fire('Error', 'Ocurrió un problema al actualizar la canción.', 'error');
                });
        });
    </script>
@endsection
