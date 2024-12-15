@extends('layout.app')

@section('content')
<!-- <style>
    .container {
        margin-top: 100px;
        max-width: 800px;
    }

    .chat-box {
        background-color: #f8f9fa;
        height: 450px;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        overflow-y: auto;
    }

    .chat-message {
        margin-bottom: 15px;
    }

    .text-right {
        text-align: right;
    }

    .input-group {
        margin-top: 10px;
    }
<<<<<<< Updated upstream
</style>
<<<<<<< HEAD
@endsection

// Controller tetap sama seperti yang Anda berikan sebelumnya

// Pastikan Anda sudah memodifikasi layout `cozastore.layout` sesuai template Coza Store

// Migration tetap sama seperti yang Anda berikan sebelumnya
=======
@endsection
>>>>>>> 5bf4f071861607f9f8b8b8ea4441d3789ff3f026
=======
</style> -->

<div class="container mt-5">
    <!-- Chat Box -->
    <div class="chat-box border rounded mt-3">
        @forelse($chats as $chat)
        <div class="chat-message {{ $chat->sender_id == auth()->id() ? 'text-right' : '' }}">
            <strong>{{ $chat->sender_id == auth()->id() ? 'You' : $receiver->name }}:</strong>
            <p class="mb-1">{{ $chat->message }}</p>
            <small class="text-muted">{{ $chat->created_at->format('H:i') }}</small>
        </div>
        @empty
        <p class="text-center text-muted">No messages yet. Start the conversation!</p>
        @endforelse
    </div>

    <!-- Input Form -->
    <form action="{{ route('chat.store', $receiver->id) }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Type your message here..." required>
            <div class="input-group-append">
                <button class="btn btn-dark" type="submit">Send</button>
            </div>
        </div>
    </form>
</div>
@endsection
>>>>>>> Stashed changes
