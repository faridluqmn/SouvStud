<!DOCTYPE html>
<html lang="en">
@include('layout.header')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<body class="animsition">
    <div class="wrapper">
        <!-- Header Nav -->
        <header>
            <!-- Header desktop -->
            <div class="container-menu-desktop">
                <!-- Topbar -->
                <div class="wrap-menu-desktop">
                    <nav class="limiter-menu-desktop container">
                        <!-- Logo desktop -->
                        <a href="#" class="logo">
                            <img src="{{ asset('images/logosovstud.png') }}" alt="IMG-LOGO-SOUVSTUD"
                                style="width: 120px; height: auto;">
                        </a>
                        <a href="javascript:history.go(-1)" class="btn btn-outline-dark"
                            style="position: absolute; top: 20px; left: 15%;">
                            &#8592; Back
                        </a>
                        <!-- Menu desktop -->
                        <div class="menu-desktop">
                            <ul class="main-menu">
                                <li class="active-menu"><a href="#">Message</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="content">
            <div class="container mt-5">

                <!-- Chat Box -->
                <div class="d-flex flex-column h-100">
                    @if (isset($receiver))
                        <!-- Chat Header -->
                        <div class="border-bottom pb-2 mb-3">
                            <h5>Chatting with {{ $receiver->name }}</h5>
                        </div>
                        <!-- Chat Messages -->
                        <div class="flex-grow-1 mb-3" style="overflow-y: auto; max-height: 60vh; padding-right: 10px;">
                            @forelse($chats as $chat)
                                <div class="mb-2 {{ $chat->sender_id == auth()->id() ? 'text-right' : '' }}">
                                    <div class="d-inline-block p-2 rounded"  
                                        style="background-color: {{ $chat->sender_id == auth()->id() ? '#7f8c8d' : '#34495e' }}; color: white;">
                                        <strong>{{ $chat->sender_id == auth()->id() ? 'You' : $receiver->name }}:</strong>
                                        <p class="mb-0">{{ $chat->message }}</p>
                                        @if ($chat->image_path)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $chat->image_path) }}" alt="Image"
                                                    style="max-width: 200px; margin-top: 10px;">
                                            </div>
                                        @endif
                                        <small
                                            class="d-block text-muted">{{ $chat->created_at->format('H:i | M d') }}</small>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-muted">Start a conversation!</p>
                            @endforelse
                        </div>


                        <!-- Chat Input -->
                        <form action="{{ route('chat.store', $receiver->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="message" class="form-control"
                                    placeholder="Type a message..." required>
                                <input type="file" name="image" class="form-control-file mt-2 ml-2"
                                    accept="image/*" style="max-width: 120px;">
                                <div class="input-group-append">
                                    <button class="btn btn-dark" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </main>

        <!-- Footer -->
        @include('layout.footer')
    </div>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
    @include('layout.js')
</body>

</html>
