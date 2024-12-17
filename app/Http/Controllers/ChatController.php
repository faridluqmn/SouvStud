<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    // Menampilkan halaman chat antara pengguna saat ini dan penerima tertentu
    public function index($receiverId)
    {
        // Tentukan ID penerima berdasarkan ID yang diteruskan
        $senderId = auth()->id(); // Ambil ID pengirim dari sesi autentikasi

        // Tentukan receiverId berdasarkan senderId
        if ($receiverId == 1) {
            $actualReceiverId = 2; // Jika receiverId adalah 1 (admin), maka penerima adalah user (ID 2)
        } elseif ($receiverId == 2) {
            $actualReceiverId = 1; // Jika receiverId adalah 2 (user), maka penerima adalah admin (ID 1)
        } else {
            abort(404); // Jika ID tidak valid, kembalikan error 404
        }

        $receiver = User::findOrFail($actualReceiverId); // Temukan penerima berdasarkan ID yang sebenarnya

        // Ambil semua chat antara pengirim dan penerima
        $chats = Chat::where(function ($query) use ($senderId, $actualReceiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $actualReceiverId);
        })->orWhere(function ($query) use ($senderId, $actualReceiverId) {
            $query->where('sender_id', $actualReceiverId)
                ->where('receiver_id', $senderId);
        })->orderBy('created_at')->get();

        return view('chat.index', compact('chats', 'receiver'));
    }

    // Menyimpan pesan baru ke dalam database
    public function store(Request $request, $receiverId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Dapatkan ID pengirim
        $senderId = auth()->id();

        // Tentukan receiver_id berdasarkan sender_id
        $receiverId = ($senderId == 1) ? 2 : 1; // Jika sender adalah admin (ID 1), receiver adalah user (ID 2)

        Chat::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId, // Gunakan receiverId yang sudah ditentukan
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent!');
    }
}
