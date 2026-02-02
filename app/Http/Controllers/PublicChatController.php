<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Conversation;
use App\Notifications\NewChatMessage;

class PublicChatController extends Controller
{
    public function store(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'contact' => 'required|string|email|max:100',
            'message' => 'required|string|max:1000',
        ]);

        $conversation = Conversation::where('vehicle_id', $vehicle->id)
            ->where('client_contact', $data['contact'])
            ->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'vehicle_id' => $vehicle->id,
                'seller_id' => $vehicle->user_id,
                'client_name' => $data['name'],
                'client_contact' => $data['contact'],
            ]);
        }

        $conversation->messages()->create([
            'sender_type' => 'cliente',
            'message' => $data['message'],
        ]);

        $conversation->load(['vehicle', 'vehicle.user']);

        $conversation->vehicle->user->notify(
            new NewChatMessage($conversation)
        );

        return response()->json(['ok' => $conversation]);
    }

    public function lastMessage(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'contact' => 'required|string|email|max:100',
        ]);

        $conversation = Conversation::where('vehicle_id', $vehicle->id)
            ->where('client_contact', $request->contact)
            ->first();

        if (! $conversation) {
            return response()->json(['message' => null]);
        }

        $lastSellerMessage = $conversation->messages()
            ->where('sender_type', 'vendedor')
            ->latest()
            ->first();

        return response()->json([
            'message' => $lastSellerMessage?->message,
            'date'    => optional($lastSellerMessage?->created_at)->diffForHumans()
        ]);
    }
}
