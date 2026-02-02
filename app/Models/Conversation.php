<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Conversation extends Model
{
    protected $fillable = [
        'vehicle_id',
        'seller_id',
        'client_name',
        'client_contact',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
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
}
