<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
