<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id',
        'marca',
        'submarca',
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

    // ✔ Usar fake ID automatizado para rutas
    public function getRouteKey()
    {
        return Hashids::encode($this->id);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $decoded = Hashids::decode($value);
        if (! isset($decoded[0])) {
            abort(404);
        }
        return $this->where('id', $decoded[0])->firstOrFail();
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}