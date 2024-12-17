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
                <div class="header-section">
                    <h3 class="section-title">DAFTAR PENGGUNA</h3>
                    <ul class="breadcrumbs">
                        <li><a href="javascript:history.go(-1)">Home</a></li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>Users</li>
                    </ul>
                </div>

                <!-- User Search Section -->
                <div class="search-section">
                    <form method="GET" action="{{ route('userlog') }}">
                        <input type="text" name="search" placeholder="Search Users..."
                            value="{{ request('search') }}">
                        <button type="submit">Search</button>
                    </form>
                </div>

                <!-- Users Table -->
                <div class="users-table">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Registered At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </main>

        <!-- Back to top -->
        <div class="btn-back-to-top" id="myBtn">
            <span class="symbol-btn-back-to-top">
                <i class="zmdi zmdi-chevron-up"></i>
            </span>
        </div>
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


</body>

</html>
