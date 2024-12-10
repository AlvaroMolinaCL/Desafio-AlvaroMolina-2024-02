<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
    
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
