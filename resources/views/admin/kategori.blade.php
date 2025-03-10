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
                        <h3 class="section-title">Categories</h3>
                        <ul class="breadcrumbs">
                            <li><a href="#">Home</a></li>
                            <li><i class="icon-chevron-right"></i></li>
                            <li>Categories</li>
                        </ul>
                    </div>

                    <!-- User Search Section -->
                    <div class="search-section">
                        <form method="GET" action="{{ route('userlog') }}">
                            <input type="text" name="search" placeholder="Search Users..."
                                value="{{ request('search') }}">
                            <button type="submit">Search</button>
                        </form>
                        <button class="add-new-btn" href="javascript:void(0)" onclick="openModal()"><i class="icon-plus"></i>
                            Add Categories</button>
                    </div>

                    <div class="wg-table">
                        <table class="styled-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kategori->nama_kategori }}</td>
                                        <td>{{ $kategori->deskripsi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>


    <!-- Add Category Modal -->
    <div class="modal" id="addCategoryModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Add New Category</h4>
                <span class="close-modal" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm" action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_kategori">Category Name</label>
                        <input type="text" id="nama_kategori" name="nama_kategori" class="form-control"
                            placeholder="Enter category name" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Description</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" placeholder="Enter description" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <script>
        function openModal() {
            document.getElementById('addCategoryModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('addCategoryModal').style.display = 'none';
        }

        // Optional: Close modal when clicking outside content
        window.onclick = function(event) {
            const modal = document.getElementById('addCategoryModal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        };
    </script>
</body>

</html>
