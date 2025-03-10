<!DOCTYPE html>
<html lang="en">
@include('layout.header')

<body class="animsition">
    <div class="wrapper">
        <!-- Header -->
        @include('layout.navbar')

        <!-- Main Content -->
        <main class="content">
            <!-- Cart -->
            @yield('cart')

            <!-- Slider -->
            @yield('slider')

            <!-- Banner -->
            @yield('banner')

            <!-- Product -->
            @yield('product')
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

    @include('layout.jsproduk')
    @include('layout.js')
</body>

</html>
