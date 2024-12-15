<!DOCTYPE html>
<html lang="en">

@include('layout.header')

<body class="animsition">

    <div class="wrapper" style="display: flex; flex-direction: column; min-height: 100vh;">
        <!-- Header -->
        @include('layout.navbar')

        <!-- CSS -->
        @include('layout.css')

        <!-- Content -->
        <main style="flex: 1; margin-top: 70px;"> <!-- Sesuaikan margin-top dengan tinggi navbar -->
            <!-- Cart -->
            @yield('cart')

            <!-- Slider -->
            @yield('slider')

            <!-- Banner -->
            @yield('banner')

            <!-- Product -->
            @yield('product')

            @yield('content')
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

    <!-- Scripts -->
    @include('layout.jsproduk')
    @include('layout.js')
</body>

</html>
