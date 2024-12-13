@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Buscador -->
        <div class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl font-bold text-gray-800">Descubre música increíble</h1>
                <p class="mt-4 text-gray-600">Explora las canciones más recientes y encuentra tus favoritos.</p>
                <div class="mt-6">
                    <form id="search-form">
                        <input type="text" id="search-bar" name="query"
                            placeholder="Buscar canciones, artistas, álbumes, géneros o años"
                            class="w-full sm:w-1/2 p-3 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-500">
                        <button type="submit"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                            Buscar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Canciones más recientes -->
        <div class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Canciones Recientes</h2>
                <div id="songs-container" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Las canciones se cargarán dinámicamente -->
                </div>
                <div id="pagination" class="flex justify-center mt-6"></div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Blog de Música. Todos los derechos reservados.
                </p>
                <a href="#" class="text-gray-400 hover:text-white text-sm">Términos y condiciones</a> |
                <a href="#" class="text-gray-400 hover:text-white text-sm">Contacto</a>
            </div>
        </footer>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let currentPage = 1;

            const loadSongs = (page = 1) => {
                fetch(`/songs/recent?page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('songs-container');
                        container.innerHTML = '';
                        data.data.forEach(song => {
                            const songDiv = document.createElement('div');
                            songDiv.className =
                                'flex bg-white shadow-md rounded-lg overflow-hidden';
                            songDiv.innerHTML = `
                                <img src="${song.cover}" alt="Cover" class="w-32 aspect-square object-cover">
                                <div class="p-4 flex-1">
                                    <h3 class="text-sm font-bold text-gray-800 truncate">${song.title}</h3>
                                    <p class="text-sm text-gray-600 truncate">${song.artist_name}</p>
                                </div>
                            `;
                            container.appendChild(songDiv);
                        });

                        // Paginación
                        const pagination = document.getElementById('pagination');
                        pagination.innerHTML = '';

                        if (data.links) {
                            data.links.forEach(link => {
                                const button = document.createElement('button');
                                button.textContent = link.label;
                                button.disabled = link.active;
                                button.className = link.active ?
                                    'px-4 py-2 mx-1 bg-blue-600 text-white rounded' :
                                    'px-4 py-2 mx-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400';
                                button.addEventListener('click', () => loadSongs(link.url.split(
                                    'page=')[1]));
                                pagination.appendChild(button);
                            });
                        }
                    });
            };

            loadSongs(); // Cargar canciones iniciales
        });

        document.getElementById('search-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Evitar la recarga de página

            const query = document.getElementById('search-bar').value;

            fetch(`/songs/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('songs-container');
                    container.innerHTML = '';

                    if (data.data.length === 0) {
                        container.innerHTML =
                            '<p class="text-center text-gray-500">No se encontraron canciones.</p>';
                        return;
                    }

                    data.data.forEach(song => {
                        const songDiv = document.createElement('div');
                        songDiv.className = 'flex bg-white shadow-md rounded-lg overflow-hidden';
                        songDiv.innerHTML = `
                    <img src="${song.cover}" alt="Cover" class="w-32 aspect-square object-cover">
                    <div class="p-4 flex-1">
                        <h3 class="text-sm font-bold text-gray-800 truncate">${song.title}</h3>
                        <p class="text-sm text-gray-600 truncate">${song.artist_name}</p>
                    </div>
                `;
                        container.appendChild(songDiv);
                    });

                    const pagination = document.getElementById('pagination');
                    pagination.innerHTML = '';

                    if (data.links) {
                        data.links.forEach(link => {
                            const button = document.createElement('button');
                            button.textContent = link.label;
                            button.disabled = link.active;
                            button.className = link.active ?
                                'px-4 py-2 mx-1 bg-blue-600 text-white rounded' :
                                'px-4 py-2 mx-1 bg-gray-300 text-gray-700 rounded hover:bg-gray-400';
                            button.addEventListener('click', () => loadSongs(link.url.split('page=')[
                                1]));
                            pagination.appendChild(button);
                        });
                    }
                });
        });
    </script>
@endsection
