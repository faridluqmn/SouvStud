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
                            <img src="images/logosovstud.png" alt="IMG-LOGO-SOUVSTUD" style="width: 150px; height: auto;">
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
                                <li><a href="product.html">Shop</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="/chat/{{ auth()->user()->id }}">Message</a></li>
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

                    <div class="wg-box">
                        <div class="actions-section">
                            <form class="form-search">
                                <input type="text" placeholder="Search here..." name="name" required>
                                <button type="submit"><i class="icon-search"></i> Search</button>
                            </form>
                            <a class="add-new-btn" href="javascript:void(0)" onclick="openModal()"><i
                                    class="icon-plus"></i> Add Categories</a>
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
