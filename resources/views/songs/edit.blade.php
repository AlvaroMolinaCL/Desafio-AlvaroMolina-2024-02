@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Canción</h1>
        <form action="{{ route('songs.update', $song->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Título de la canción -->
            <div class="form-group">
                <label for="title">Título de la canción</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $song->title) }}" required>
            </div>
            
            <!-- Artista -->
            <div class="form-group">
                <label for="artist_id">Artista</label>
                <select name="artist_id" id="artist_id" class="form-control" required>
                    <option value="" selected disabled>Selecciona un artista</option>
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Álbum (cargado dinámicamente según el artista seleccionado) -->
            <div class="form-group">
                <label for="album_id">Álbum</label>
                <select name="album_id" id="album_id" class="form-control">
                    <option value="" selected>Ninguno</option>
                    <!-- Opciones cargadas dinámicamente con JavaScript -->
                </select>
            </div>

            <!-- Género -->
            <div class="form-group">
                <label for="genre_id">Género</label>
                <select name="genre_id" id="genre_id" class="form-control" required>
                    <option value="" selected disabled>Selecciona un género</option>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Playlist -->
            <div class="form-group">
                <label for="playlist_id">Playlist (opcional)</label>
                <select name="playlist_id" id="playlist_id" class="form-control">
                    <option value="" selected>Ninguna</option>
                    @foreach ($playlists as $playlist)
                        <option value="{{ $playlist->id }}">{{ $playlist->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Año de lanzamiento -->
            <div class="form-group">
                <label for="release_year">Año de lanzamiento</label>
                <input type="number" name="release_year" id="release_year" class="form-control"
                    value="{{ old('release_year') }}" required min="1900" max="{{ date('Y') }}">
            </div>

            <!-- Duración -->
            <div class="form-group">
                <label>Duración</label>
                <div class="row">
                    <div class="col">
                        <input type="number" name="duration_minutes" class="form-control" placeholder="Minutos"
                            value="{{ old('duration_minutes') }}" required>
                    </div>
                    <div class="col">
                        <input type="number" name="duration_seconds" class="form-control" placeholder="Segundos"
                            value="{{ old('duration_seconds') }}" required max="59">
                    </div>
                </div>
            </div>

            <!-- Carátula -->
            <div class="form-group">
                <label for="cover">Carátula (opcional)</label>
                <input type="file" name="cover" id="cover" class="form-control-file">
            </div>

            <!-- Archivo MP3 -->
            <div class="form-group">
                <label for="file_path">Archivo MP3</label>
                <input type="file" name="file_path" id="file_path" class="form-control-file" required>
            </div>

            <!-- Descripción -->
            <div class="form-group">
                <label for="description">Reseña o descripción (opcional)</label>
                <textarea name="description" id="description" rows="5" class="form-control">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Canción</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('artist_id').addEventListener('change', function() {
            const artistId = this.value;
            const albumSelect = document.getElementById('album_id');
            albumSelect.innerHTML = '<option value="" selected>Ninguno</option>';

            if (artistId) {
                fetch(`/api/albums/by-artist/${artistId}`)
                    .then(response => response.json())
                    .then(albums => {
                        albums.forEach(album => {
                            const option = document.createElement('option');
                            option.value = album.id;
                            option.textContent = album.title;
                            albumSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
@endsection