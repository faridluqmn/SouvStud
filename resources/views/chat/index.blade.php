<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
@include('layout.header')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .chat-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
            height: 400px;
            overflow-y: scroll;
            background-color: #f9f9f9;
        }
        .chat-message {
            margin-bottom: 10px;
        }
        .chat-message.sender {
            text-align: right;
            color: #007bff;
        }
        .chat-message.receiver {
            text-align: left;
            color: #28a745;
        }
    </style>
<body class="animsition">
    <div class="wrapper">
        <!-- Header Nav -->
        <header>
            <!-- Header desktop -->
            <div class="container-menu-desktop">
                <!-- Topbar -->
                <div class="top-bar">
                    <div class="content-topbar container">
                        <div class="right-top-bar flex-w">
                            <a href="#" class="flex-c-m trans-04 p-lr-25">
                                Admin
                            </a>
                            <a href="/logout" class="flex-c-m trans-04 p-lr-25">
                                Logout
                            </a>
                            <a href="#" class="flex-c-m trans-04 p-lr-25">
                                EN
                            </a>
                            <a href="#" class="flex-c-m trans-04 p-lr-25">
                                USD
                            </a>
                        </div>
                    </div>
                </div>

                <div class="wrap-menu-desktop">
                    <nav class="limiter-menu-desktop container">
                        <!-- Logo desktop -->
                        <a href="#" class="logo">
                            <img src="" alt="IMG-LOGO-SOUVSTUD">
                        </a>

                        <!-- Menu desktop -->
                        <div class="menu-desktop">
                            <ul class="main-menu">
                                <li>
                                    <a href="/admin">MyAdmin</a>
                                    <ul class="sub-menu">
                                        <li><a href="/produk">Product</a></li>
                                        <li><a href="/kategori">Category</a></li>
                                        <li><a href="/kupon">Coupons</a></li>
                                    </ul>
                                </li>
                                {{-- <li><a href="product.html">Shop</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="about.html">About</a></li> --}}
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
=======
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
>>>>>>> 9e3fae605f9826c83057db3cad8c33aa87cf42ba
