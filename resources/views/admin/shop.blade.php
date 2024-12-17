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
            <div class="container">
                <div class="row">
                  
                </div>
            </div>
        </main>
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
