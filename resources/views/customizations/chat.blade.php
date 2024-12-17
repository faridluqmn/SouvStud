<!-- @extends('layout.app')

@section('content')
<div class="container">
    <h2>Chat</h2>
    <div class="chat-box" style="border: 1px solid #ddd; padding: 20px; margin-bottom: 20px; height: 300px; overflow-y: scroll;">
        @foreach($messages as $message)
            <div>
                <strong>{{ $message->sender_id == auth()->id() ? 'You' : 'Admin' }}:</strong>
                <p>{{ $message->message }}</p>
            </div>
        @endforeach
    </div>
    <form action="{{ route('customizations.chat.send') }}" method="POST">
        @csrf
        <input type="hidden" name="customization_id" value="{{ $id }}">
        <div class="form-group">
            <textarea name="message" class="form-control" rows="3" placeholder="Type your message here..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>
@endsection -->
