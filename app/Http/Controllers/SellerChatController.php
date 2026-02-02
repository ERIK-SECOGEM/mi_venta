<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Notifications\NewChatMessage;

class SellerChatController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $notifications = $user->unreadNotifications
        ->where('type', NewChatMessage::class)
        ->keyBy('data.conversation_id');

        $conversations = Conversation::where('seller_id', $user->id)
            ->with('vehicle')
            ->latest()
            ->get()
            ->map(function ($conversation) use ($notifications) {

                $notification = $notifications->get($conversation->id);

                $conversation->has_unread = (bool) $notification;
                $conversation->notification_id = $notification?->id;

                return $conversation;
            });

        return view('chats.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        abort_if($conversation->seller_id !== auth()->id(), 403);

        $conversation->load('messages', 'vehicle');
        auth()->user()->unreadNotifications()->where('data->conversation_id', $conversation->id)->update(['read_at' => now()]);

        return view('chats.show', compact('conversation'));
    }

    public function reply(Request $request, Conversation $conversation)
    {
        abort_if($conversation->seller_id !== auth()->user()->id, 403);

        $data = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $conversation->messages()->create([
            'sender_type' => 'vendedor',
            'message' => $data['message'],
        ]);

        return back();
    }
}
