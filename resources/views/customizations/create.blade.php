// Blade Template: Coza Store Example (create.blade.php) 
@extends('layout.app') 
@section('content')
    <div class="container">
        <h2>Create Customization</h2>
        <form action="{{ route('customizations.store') }}" method="POST" enctype="multipart/form-data"> @csrf <div
                class="form-group"> <label for="product_name">Product Name</label> <input type="text" name="product_name"
                    class="form-control" required> </div>
            <div class="form-group"> <label for="custom_image">Custom Image</label> <input type="file" name="custom_image"
                    class="form-control" required> </div>
            <div class="form-group"> <label for="custom_message">Custom Message</label>
                <textarea name="custom_message" class="form-control" rows="3" required></textarea>
            </div> <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
