@extends('layout.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Custom Image</th>
                <th>Custom Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customizations as $customization)
            <tr>
                <td>{{ $customization->product_name }}</td>
                <td><img src="{{ asset('storage/' . $customization->custom_image) }}" alt="Custom Image" width="100"></td>
                <td>{{ $customization->custom_message }}</td>
                <td>
                    <a href="{{ route('customizations.chat', $customization->id) }}" class="btn btn-info">Chat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
