@extends('layout')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4">Chat dengan {{ $receiver->name }}</h2>

            <div class="chat-box border p-3 rounded" style="background-color: #f8f9fa; max-height: 400px; overflow-y: auto; margin-bottom: 20px;">
                @foreach($chats as $chat)
                    <div class="chat-message {{ $chat->sender_id == auth()->id() ? 'sent' : 'received' }} mb-3 p-2 rounded" style="max-width: 75%;">
                        <p style="margin-bottom: 0;">{{ $chat->message }}</p>
                        <small class="text-muted">{{ $chat->created_at->format('d-m-Y H:i:s') }}</small>
                    </div>
                @endforeach
            </div>

            <form action="{{ route('chat.store', $receiver->id) }}" method="POST" class="form-inline">
                @csrf
                <div class="input-group w-100">
                    <input type="text" name="message" class="form-control" placeholder="Tulis pesan..." required>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .chat-message.sent {
        background-color: #d1e7dd;
        align-self: flex-end;
        text-align: right;
    }
    .chat-message.received {
        background-color: #f8d7da;
        align-self: flex-start;
        text-align: left;
    }
</style>
@endsection

// Controller tetap sama seperti yang Anda berikan sebelumnya

// Pastikan Anda sudah memodifikasi layout `cozastore.layout` sesuai template Coza Store

// Migration tetap sama seperti yang Anda berikan sebelumnya
