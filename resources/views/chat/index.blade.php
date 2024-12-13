@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Chat dengan {{ $receiver->name }}</h2>
            <div class="chat-box">
                @foreach($chats as $chat)
                    <div class="chat-message {{ $chat->sender_id == auth()->id() ? 'sent' : 'received' }}">
                        <p>{{ $chat->message }}</p>
                        <small>{{ $chat->created_at->format('d-m-Y H:i:s') }}</small>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('chat.store', $receiver->id) }}" method="POST">
                @csrf
                <div class="input-group">
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
    .chat-box {
        max-height: 400px;
        overflow-y: auto;
        margin-bottom: 20px;
    }
    .chat-message {
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }
    .chat-message.sent {
        background-color: #d1e7dd;
        text-align: right;
    }
    .chat-message.received {
        background-color: #f8d7da;
        text-align: left;
    }
</style>
@endsection
