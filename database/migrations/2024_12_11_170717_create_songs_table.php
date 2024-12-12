<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título de la canción
            $table->foreignId('artist_id')->constrained('artists'); // Clave foránea a la tabla "artists"
            $table->foreignId('album_id')->nullable()->constrained('albums'); // Clave foránea a la tabla "albums"
            $table->foreignId('genre_id')->constrained('genres'); // Clave foránea a la tabla "genres"
            $table->foreignId('playlist_id')->nullable()->constrained('playlists'); // Clave foránea a la tabla "playlists"
            $table->integer('release_year'); // Año de lanzamiento
            $table->integer('duration_minutes'); // Duración en minutos
            $table->integer('duration_seconds'); // Duración en segundos
            $table->string('cover')->nullable(); // Carátula (ruta de la imagen)
            $table->string('file_path'); // Ruta del archivo MP3
            $table->text('description')->nullable(); // Descripción
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
}
