<!DOCTYPE html>
<html lang="en">
@include('layout.header')

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
                            <a href="logout" class="flex-c-m trans-04 p-lr-25">
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
                            <img src="images/logosovstud.png" alt="IMG-LOGO-SOUVSTUD"
                                style="width: 150px; height: auto;">
                        </a>

                        <!-- Menu desktop -->
                        <div class="menu-desktop">
                            <ul class="main-menu">
                                <li class="active-menu">
                                    <a href="admin">MyAdmin</a>
                                    <ul class="sub-menu">
                                        <li><a href="produk">Product</a></li>
                                        <li><a href="kategori">Category</a></li>
                                        <li><a href="kupon">Coupons</a></li>
                                    </ul>
                                </li>
                                <li><a href="order">Order</a></li>
                                <li><a href="data-user">User</a></li>
                                <li><a href="/chat/{{ auth()->user()->id }}">Message</a></li>
                                <li><a href="about.html">Setting</a></li>
                            </ul>
                        </div>

                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="content">
            <div class="main-content-inner">
                <div class="main-content-wrap">
                    <div class="header-section">
                        <h3 class="section-title">Product</h3>
                        <ul class="breadcrumbs">
                            <li><a href="#">Home</a></li>
                            <li><i class="icon-chevron-right"></i></li>
                            <li>Product</li>
                        </ul>
                    </div>

                    <div class="wg-box">
                        <!-- User Search Section -->
                        <div class="search-section">
                            <form method="GET" action="{{ route('userlog') }}">
                                <input type="text" name="search" placeholder="Search Users..."
                                    value="{{ request('search') }}">
                                <button type="submit">Search</button>
                            </form>
                            <button class="add-new-btn" href="javascript:void(0)" onclick="openModal()"><i
                                    class="icon-plus"></i>
                                Add Produk</button>
                        </div>


                        <div class="wg-table">
                            <table class="styled-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Souvenir</th>
                                        <th>Foto</th>
                                        <th>Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Qty</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>
                                                @if ($item->link_img)
                                                    <img src="{{ asset('storage/' . $item->link_img) }}"
                                                        alt="Foto Produk" width="80" height="80">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->nama_kategori }}</td>
                                            <td>{{ Str::limit($item->deskripsi, 50, '...') }}</td>
                                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($item->jumlah_stok > 0)
                                                    <span class="text-success">Available</span>
                                                @else
                                                    <span class="text-danger">Out of Stock</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->jumlah_stok }}</td>
                                            <td class="text-center">
                                                <!-- Edit Trigger -->
                                                <button type="button" class="btn btn-sm btn-warning"
                                                    onclick="openEditModal({{ $item->id }})">
                                                    <i class="bx bx-edit"></i> Edit
                                                </button>
                                                <!-- Delete Form -->
                                                <form action="{{ route('product.destroy', $item->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <i class="bx bx-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Modal Popup -->
            <div id="addProductModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <h3>Add Product</h3>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data"
                            class="form-add-product">
                            @csrf
                            <fieldset>
                                <!-- Product Name -->
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" name="nama_barang" placeholder="Enter product name" required>
                                </div>

                                <!-- Category -->
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                                        <option value="">Choose category</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Stock -->
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" name="jumlah_stok" placeholder="Enter stock quantity"
                                        required>
                                </div>

                                <!-- Status -->
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" required>
                                        <option value="Available">Available</option>
                                        <option value="Out of Stock">Out of Stock</option>
                                    </select>
                                </div>

                                <!-- Price -->
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="harga" placeholder="Enter price" required>
                                </div>

                                <!-- Upload Images -->
                                <fieldset>
                                    <div class="item up-load">
                                        <label>Upload Images</label>
                                        <div class="image-upload">
                                            <label for="imageUpload" class="upload-label">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span class="text-tiny">Drag or drop your images <span
                                                        class="tf-color" style="color: blue;">Click to
                                                        browse</span></span>
                                            </label>
                                            <input type="file" id="imageUpload" name="link_img" accept="image/*"
                                                multiple="">
                                        </div>
                                        <div id="previewContainer" class="preview-container"></div>
                                    </div>
                                </fieldset>

                                <!-- Description -->
                                <div class="form-group">
                                    <label>Deskripsi Produk</label>
                                    <textarea name="deskripsi" rows="4" placeholder="Enter product description" required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="submit-btn">Add Product</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>

            {{-- edit produk --}}
            @foreach ($products as $item)
                <div id="editProductModal{{ $item->id }}" class="modal" style="display: none;">
                    <div class="modal-content">
                        <span class="close" onclick="closeEditModal({{ $item->id }})">&times;</span>
                        <h3>Edit Product</h3>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('product.update', $item->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" name="nama_barang" value="{{ $item->nama_barang }}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="id_kategori" required>
                                            <option value="">Choose category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $item->id_kategori ? 'selected' : '' }}>
                                                    {{ $category->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input type="number" name="jumlah_stok" value="{{ $item->jumlah_stok }}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <td>
                                            @if ($item->jumlah_stok > 0)
                                                <span class="text-success">Available</span>
                                            @else
                                                <span class="text-danger">Out of Stock</span>
                                            @endif
                                        </td>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" name="harga" value="{{ $item->harga }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Current Image</label>
                                        <div>
                                            @if ($item->link_img)
                                                <img src="{{ asset('storage/' . $item->link_img) }}"
                                                    alt="Current Image" width="80">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </div>
                                        <label>Upload New Image</label>
                                        <input type="file" name="link_img" accept="image/*">
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi Produk</label>
                                        <textarea name="deskripsi" rows="4" required>{{ $item->deskripsi }}</textarea>
                                    </div>
                                    <button type="submit" class="submit-btn">Update Product</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </main>

        <!-- Footer -->
    </div>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
    @include('layout.js')
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
        }

        .wrapper {
            margin-top: 20px;
        }

        /* Title Styling */
        .header-section {
            text-align: center;
            /* Center the title */
            margin-bottom: 30px;
        }

        .header-section .section-title {
            font-size: 36px;
            font-weight: 700;
            color: #2c3e50;
            /* Darker color for the title */
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            font-family: 'Poppins', sans-serif;
            /* New font applied */
        }

        .breadcrumbs {
            text-align: center;
            font-size: 14px;
            color: #7f8c8d;
            /* Subtle gray color for breadcrumbs */
        }

        .breadcrumbs li {
            display: inline;
            margin-right: 5px;
        }

        .breadcrumbs li i {
            color: #7f8c8d;
        }

        /* Table Styling */
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e1e1e1;
        }

        .styled-table th {
            background-color: #34495e;
            /* Darker header background */
            color: #fff;
            text-transform: uppercase;
        }

        .styled-table tr:hover {
            background-color: #f1f1f1;
        }

        /* Search Box Styling */
        .search-section {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .search-section form {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px 10px;
            background-color: #fff;
        }

        .search-section input {
            border: none;
            padding: 8px 15px;
            outline: none;
            font-size: 14px;
            border-radius: 5px 0 0 5px;
            width: 200px;
        }

        .search-section button {
            background-color: #2c3e50;
            /* Dark blue color for button */
            border: none;
            padding: 8px 15px;
            color: white;
            font-size: 14px;
            cursor: pointer;
            border-radius: 0 5px 5px 0;
        }

        .search-section button:hover {
            background-color: #2e6eaf;
            /* Darker blue on hover */
        }

        /* Pagination Styling */
        .pagination {
            text-align: center;
            margin-top: 30px;
        }

        .pagination a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 5px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #34495e;
            /* Darker blue on hover */
        }

        /* Button Styling */
        .btn-delete {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-delete:hover {
            background-color: #c0392b;
            /* Darker red on hover */
        }

        /* Add extra spacing for mobile screens */
        @media (max-width: 768px) {

            .styled-table th,
            .styled-table td {
                padding: 8px;
            }

            .search-section input {
                width: 150px;
            }
        }
    </style>

    <!-- Modal Styling -->
    <style>
        /* Modal Background */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(2px);
            align-items: center;
            justify-content: center;
        }

        /* Modal Content */
        .modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 40%;
            position: relative;
            animation: fadeIn 0.5s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 25px;
            color: #333;
            cursor: pointer;
        }

        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
            padding-right: 10px;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Submit Button */
        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .image-upload {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border: 2px dashed #ccc;
            padding: 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .image-upload:hover {
            background-color: #f8f9fa;
            border-color: #007bff;
        }

        .upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #666;
            font-size: 16px;
        }

        .upload-label i {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .preview-item {
            position: relative;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .preview-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .preview-item .remove-btn {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }
    </style>

    <script>
        function openModal() {
            document.getElementById('addProductModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('addProductModal').style.display = 'none';
        }

        // Close modal jika klik di luar konten
        window.onclick = function(event) {
            const modal = document.getElementById('addProductModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    </script>

    <script>
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = ''; // Clear existing previews
            const files = event.target.files;
            const fileArray = Array.from(files);

            fileArray.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'remove-btn';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.onclick = () => removeImage(index);

                    previewItem.appendChild(img);
                    previewItem.appendChild(removeBtn);
                    previewContainer.appendChild(previewItem);
                };

                reader.readAsDataURL(file);
            });

            // Save the files globally to manage deletion
            window.selectedFiles = fileArray;
        });

        function removeImage(index) {
            const previewContainer = document.getElementById('previewContainer');
            const selectedFiles = window.selectedFiles;

            // Remove the file from the global array
            selectedFiles.splice(index, 1);

            // Clear and re-render previews
            previewContainer.innerHTML = '';
            selectedFiles.forEach((file, newIndex) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const previewItem = document.createElement('div');
                    previewItem.className = 'preview-item';

                    const img = document.createElement('img');
                    img.src = e.target.result;

                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'remove-btn';
                    removeBtn.innerHTML = '&times;';
                    removeBtn.onclick = () => removeImage(newIndex);

                    previewItem.appendChild(img);
                    previewItem.appendChild(removeBtn);
                    previewContainer.appendChild(previewItem);
                };

                reader.readAsDataURL(file);
            });

            // Update the files in the input field
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach((file) => dataTransfer.items.add(file));
            document.getElementById('imageUpload').files = dataTransfer.files;
        }
    </script>

</body>

</html>
