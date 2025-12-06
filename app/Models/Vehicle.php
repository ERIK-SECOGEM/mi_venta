<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id',
        'marca',
        'modelo',
        'anio',
        'precio',
        'descripcion',
        'estatus',
    ];

    // Relación con Usuario (vendedor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación polimórfica con imágenes
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
