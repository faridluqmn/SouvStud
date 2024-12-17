@extends('layout.main')
@section('content')
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Product Overview
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        All Products
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="cat.1">
                        Romance
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="cat.2">
                        Ulang Tahun
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="cat.3">
                        Pernikahan
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="cat.4">
                        Wisuda
                    </button>

                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter="cat.5">
                        Seminar
                    </button>
                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filter
                    </div>

                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Search
                    </div>
                </div>

                <!-- Search product -->
                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>

                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product"
                            placeholder="Search">
                    </div>
                </div>

                <!-- Filter -->
                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Sort By
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Default
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Popularity
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Average rating
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                        Newness
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Price: Low to High
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Price: High to Low
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col2 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Price
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                        All
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        $0.00 - $50.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        $50.00 - $100.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        $100.00 - $150.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        $150.00 - $200.00
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <a href="#" class="filter-link stext-106 trans-04">
                                        $200.00+
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col3 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Color
                            </div>

                            <ul>
                                <li class="p-b-6">
                                    <span class="fs-15 lh-12 m-r-6" style="color: #222;">
                                        <i class="zmdi zmdi-circle"></i>
                                    </span>

                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Black
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <span class="fs-15 lh-12 m-r-6" style="color: #4272d7;">
                                        <i class="zmdi zmdi-circle"></i>
                                    </span>

                                    <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
                                        Blue
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <span class="fs-15 lh-12 m-r-6" style="color: #b3b3b3;">
                                        <i class="zmdi zmdi-circle"></i>
                                    </span>

                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Grey
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <span class="fs-15 lh-12 m-r-6" style="color: #00ad5f;">
                                        <i class="zmdi zmdi-circle"></i>
                                    </span>

                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Green
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <span class="fs-15 lh-12 m-r-6" style="color: #fa4251;">
                                        <i class="zmdi zmdi-circle"></i>
                                    </span>

                                    <a href="#" class="filter-link stext-106 trans-04">
                                        Red
                                    </a>
                                </li>

                                <li class="p-b-6">
                                    <span class="fs-15 lh-12 m-r-6" style="color: #aaa;">
                                        <i class="zmdi zmdi-circle-o"></i>
                                    </span>

                                    <a href="#" class="filter-link stext-106 trans-04">
                                        White
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="filter-col4 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Tags
                            </div>

                            <div class="flex-w p-t-4 m-r--5">
                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Fashion
                                </a>

                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Lifestyle
                                </a>

                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Denim
                                </a>

                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Streetstyle
                                </a>

                                <a href="#"
                                    class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                    Crafts
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- isi produk --}}
            <div class="row isotope-grid">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item cat.{{ $product->id_kategori }}">
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{{ asset('storage/' . $product->link_img) }}" alt="{{ $product->nama_barang }}">
                                <button
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                                    onclick="openModal({
                                        id: '{{ $product->id }}',
                                        link_img: '{{ asset('storage/' . $product->link_img) }}',
                                        nama_barang: '{{ $product->nama_barang }}',
                                        deskripsi: '{{ $product->deskripsi ?? '' }}',
                                        harga: {{ $product->harga }},
                                        warna: ['hitam','merah','biru','putih','hijau'] // Simulasi data warna
                                    })">
                                    Quick View
                                </button>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $product->nama_barang }}
                                    </a>
                                    <span class="stext-105 cl3">
                                        ${{ number_format($product->harga, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- modal produk --}}
            <div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="productModal" style="display: none;">
                <div class="overlay-modal1 js-hide-modal1"></div>

                <div class="container">
                    <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                        <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                            <img src="{{ asset('images/icons/icon-close.png') }}" alt="CLOSE">
                        </button>

                        <div class="row">
                            <div class="col-md-6 col-lg-7 p-b-30">
                                <div class="p-l-25 p-r-30 p-lr-0-lg">
                                    <div class="wrap-pic-w pos-relative">
                                        <!-- Gambar Produk -->
                                        <img id="modal-product-image" class="img-fluid rounded shadow-sm" src=""
                                            alt="Product Image">
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian Detail Produk -->
                            <div class="col-md-6 col-lg-5 p-b-30">
                                <div class="p-4 bg-light shadow-sm">
                                    <!-- Nama Produk -->
                                    <h4 id="modal-product-name" class="mtext-105"></h4>

                                    <!-- Harga Produk -->
                                    <span id="modal-product-price" class="mtext-106"></span>

                                    <!-- Deskripsi Produk -->
                                    <p id="modal-product-description" class="stext-102"></p>

                                    <!-- Stok Tersedia -->
                                    <p id="modal-product-stock" class="stext-102 text-success"></p>
                                
                                    <!-- Input Quantity -->
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="modal-product-quantity"
                                            class="me-3 font-weight-bold">Quantity:</label>
                                        <input id="modal-product-quantity" type="number" value="1" min="1">
                                    </div>

                                    <!-- Tombol Add to Cart -->
                                    <button id="add-to-cart-btn" class="btn btn-success w-100">
                                        <i class="fas fa-cart-plus me-2"></i> Add to Cart
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            {{-- modal cart --}}
            <div class="wrap-header-cart js-panel-cart">
                <div class="s-full js-hide-cart"></div>

                <div class="header-cart flex-col-l p-l-65 p-r-25">
                    <div class="header-cart-title flex-w flex-sb-m p-b-8">
                        <span class="mtext-103 cl2">Your Cart</span>
                        <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                            <i class="zmdi zmdi-close"></i>
                        </div>
                    </div>
                    {{-- <!-- Checkbox "Select All" -->
                    <div class="header-cart-select-all">
                        <input type="checkbox" id="select-all" />
                        <label for="select-all">Select All</label>
                    </div> --}}
                    <div class="header-cart-content flex-w js-pscroll">
                        <ul class="header-cart-wrapitem w-full" id="cart-items-list">
                            @forelse ($cartItems as $item)
                                <li class="header-cart-item flex-w flex-t m-b-12" id="cart-item-{{ $item->id }}">
                                    <div class="product-checkbox-container">
                                        <input type="checkbox" class="product-checkbox" data-id="{{ $item->id }}"
                                            data-price="{{ $item->harga }}" data-name="{{ $item->nama_barang }}"
                                            data-quantity="{{ $item->jumlah_barang }}" />
                                    </div>

                                    <div class="header-cart-item-img">
                                        @if ($item->link_img)
                                            <img src="{{ asset('storage/' . $item->link_img) }}"
                                                alt="{{ $item->nama_barang }}">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}" alt="No Image">
                                        @endif
                                    </div>

                                    <div class="header-cart-item-txt p-t-8">
                                        <label class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                            {{ $item->nama_barang }}
                                        </label>

                                        <span class="header-cart-item-info" id="price-{{ $item->id }}">
                                            Rp {{ number_format($item->harga, 0, ',', '.') }} x
                                            <span id="quantity-{{ $item->id }}">{{ $item->jumlah_barang }}</span>
                                        </span>

                                        <!-- Tombol Hapus Produk -->
                                        <button class="btn-delete-product" data-id="{{ $item->id }}"
                                            style="display:none;">
                                            Hapus
                                        </button>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center">Your cart is empty!</li>
                            @endforelse
                        </ul>

                        <div class="w-full">
                            <div class="header-cart-total w-full p-tb-40">
                                Total: Rp <span id="total-price">0</span>
                            </div>

                            <div class="header-cart-buttons flex-w w-full">
                                <form action="{{ route('cart.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                                        Check Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Load More
                </a>
            </div>
        </div>
    </section>
@endsection
