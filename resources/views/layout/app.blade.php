<!DOCTYPE html>
<html lang="en">
@include('layout.header')

<body class="animsition">

    <!-- Header -->
    @include('layout.navbar')

    <!-- Cart -->
        @yield('cart')

    <!-- Slider -->
        @yield('slider')

    <!-- Banner -->
        @yield('banner')

    <!-- Product -->
        @yield('product')


    <!-- Footer -->
    @include('layout.footer')


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    @include('layout.jsproduk')

    <!--===============================================================================================-->
    @include('layout.js')

</body>

</html>
