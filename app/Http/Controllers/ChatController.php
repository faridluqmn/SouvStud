<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index($receiverId)
    {
        $chats = Chat::where(function ($query) use ($receiverId) {
            $query->where('sender_id', auth()->id())
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', auth()->id());
        })->orderBy('created_at')->get();

        $receiver = User::findOrFail($receiverId);

        return view('chat.index', compact('chats', 'receiver'));
    }

    public function store(Request $request, $receiverId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return redirect()->route('chat.index', $receiverId);
    }
}
