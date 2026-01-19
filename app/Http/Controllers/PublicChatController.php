<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Conversation;

class PublicChatController extends Controller
{
    public function store(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'contact' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

        $conversation = Conversation::create([
            'vehicle_id' => $vehicle->id,
            'seller_id' => $vehicle->user_id,
            'client_name' => $data['name'],
            'client_contact' => $data['contact'],
        ]);

        $conversation->messages()->create([
            'sender_type' => 'cliente',
            'message' => $data['message'],
        ]);

        return response()->json(['ok' => true]);
    }
}
