<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/select2/select2.min.js"></script>
<script>
    $(".js-select2").each(function() {
        $(this).select2({
            minimumResultsForSearch: 20,
            dropdownParent: $(this).next('.dropDownSelect2')
        });
    })
</script>
<!--===============================================================================================-->
<script src="vendor/daterangepicker/moment.min.js"></script>
<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
<script src="vendor/slick/slick.min.js"></script>
<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
<script src="vendor/parallax100/parallax100.js"></script>
<script>
    $('.parallax100').parallax100();
</script>
<!--===============================================================================================-->
<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<script>
    $('.gallery-lb').each(function() { // the containers for all your galleries
        $(this).magnificPopup({
            delegate: 'a', // the selector for gallery item
            type: 'image',
            gallery: {
                enabled: true
            },
            mainClass: 'mfp-fade'
        });
    });
</script>
<!--===============================================================================================-->
<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
<script src="vendor/sweetalert/sweetalert.min.js"></script>
<script>
    $('.js-addwish-b2').on('click', function(e) {
        e.preventDefault();
    });

    $('.js-addwish-b2').each(function() {
        var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-b2');
            $(this).off('click');
        });
    });

    $('.js-addwish-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

        $(this).on('click', function() {
            swal(nameProduct, "is added to wishlist !", "success");

            $(this).addClass('js-addedwish-detail');
            $(this).off('click');
        });
    });

    /*---------------------------------------------*/

    $('.js-addcart-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function() {
            swal(nameProduct, "is added to cart !", "success");
        });
    });
</script>
<!--===============================================================================================-->
<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script>
    $('.js-pscroll').each(function() {
        $(this).css('position', 'relative');
        $(this).css('overflow', 'hidden');
        var ps = new PerfectScrollbar(this, {
            wheelSpeed: 1,
            scrollingThreshold: 1000,
            wheelPropagation: false,
        });

        $(window).on('resize', function() {
            ps.update();
        })
    });
</script>
<!--===============================================================================================-->
<script src="path/to/your/script.js"></script>
<script src="js/main.js"></script>
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Popper.js (jika menggunakan Bootstrap 4) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


{{-- <script>
    function openModal(product) {
        // Isi data produk ke dalam modal
        document.querySelector('.wrap-modal1 .wrap-pic-w img').src = product.link_img;
        document.querySelector('.wrap-modal1 .js-name-detail').innerText = product.nama_barang;
        document.querySelector('.wrap-modal1 .mtext-106').innerText = `$${product.harga.toFixed(2)}`;
        document.querySelector('.wrap-modal1 .stext-102').innerText = product.deskripsi;

        // Isi dropdown warna
        const colorSelect = document.querySelector('.wrap-modal1 .js-select2');
        colorSelect.innerHTML = ''; // Kosongkan opsi sebelumnya
        product.warna.forEach(color => {
            const option = document.createElement('option');
            option.value = color;
            option.textContent = color;
            colorSelect.appendChild(option);
        });

        // Tampilkan modal
        document.querySelector('.wrap-modal1').style.display = 'block';
    }

    function closeModal() {
        // Sembunyikan modal
        document.querySelector('.wrap-modal1').style.display = 'none';
    }

    // Tambahkan event listener untuk menutup modal saat overlay di klik
    document.querySelector('.overlay-modal1').addEventListener('click', closeModal);

    // Tambahkan event listener untuk tombol close
    document.querySelectorAll('.js-hide-modal1').forEach(btn => btn.addEventListener('click', closeModal));

    //cart
    document.querySelector('.js-show-cart').addEventListener('click', () => {
        document.querySelector('.wrap-header-cart').classList.add('show-cart');
    });
    document.querySelector('.js-hide-cart').addEventListener('click', () => {
        document.querySelector('.wrap-header-cart').classList.remove('show-cart');
    });
    fetch('/api/cart')
        .then(response => response.json())
        .then(data => {
            const cartItems = data.items.map(item => `
            <li class="header-cart-item flex-w flex-t m-b-12">
                <div class="header-cart-item-img">
                    <img src="${item.image}" alt="${item.name}">
                </div>
                <div class="header-cart-item-txt p-t-8">
                    <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                        ${item.name}
                    </a>
                    <span class="header-cart-item-info">
                        ${item.quantity} x $${item.price}
                    </span>
                </div>
            </li>
        `).join('');

            document.querySelector('.header-cart-wrapitem').innerHTML = cartItems;
            document.querySelector('.header-cart-total').innerText = `Total: $${data.total}`;
        });
</script>
<script>
    function openModal(product) {
        // Set data produk ke dalam modal
        document.getElementById('modal-image').src = product.link_img;
        document.getElementById('modal-name').innerText = product.nama_barang;
        document.getElementById('modal-price').innerText = 'Rp ' + product.harga.toLocaleString();
        document.getElementById('modal-description').innerText = product.deskripsi;
        document.getElementById('add-to-cart-btn').setAttribute('data-id', product.id);

        // Tampilkan modal
        const modal = new bootstrap.Modal(document.getElementById('productModal'));
        modal.show();
    }

    // Event Listener untuk Add to Cart
    document.getElementById('add-to-cart-btn').addEventListener('click', function () {
        const idBarang = this.getAttribute('data-id'); // ID barang dari tombol
        const quantity = document.getElementById('modal-quantity').value;

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                id_barang: idBarang,
                quantity: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product successfully added to cart!');
                // Tutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('productModal'));
                modal.hide();
            } else {
                alert('Failed: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script> --}}
{{-- <script>
    function openModal(product) {
        // Isi data produk ke dalam modal
        document.querySelector('.wrap-modal1 .wrap-pic-w img').src = product.link_img;
        document.querySelector('.wrap-modal1 .js-name-detail').innerText = product.nama_barang;
        document.querySelector('.wrap-modal1 .mtext-106').innerText = `$${product.harga.toFixed(2)}`;
        document.querySelector('.wrap-modal1 .stext-102').innerText = product.deskripsi;

        // Isi dropdown warna
        const colorSelect = document.querySelector('.wrap-modal1 .js-select2');
        colorSelect.innerHTML = ''; // Kosongkan opsi sebelumnya
        product.warna.forEach(color => {
            const option = document.createElement('option');
            option.value = color;
            option.textContent = color;
            colorSelect.appendChild(option);
        });

        // Set atribut untuk "Add to Cart" button
        document.getElementById('add-to-cart-btn').setAttribute('data-id', product.id);
        document.getElementById('add-to-cart-btn').setAttribute('data-harga', product.harga);

        // Tampilkan modal
        document.querySelector('.wrap-modal1').style.display = 'block';
    }

    function closeModal() {
        // Sembunyikan modal
        document.querySelector('.wrap-modal1').style.display = 'none';
    }

    // Tambahkan event listener untuk menutup modal
    document.querySelector('.overlay-modal1').addEventListener('click', closeModal);
    document.querySelectorAll('.js-hide-modal1').forEach(btn => btn.addEventListener('click', closeModal));

    // Fungsi untuk menambahkan ke keranjang
    document.getElementById('add-to-cart-btn').addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        const quantity = document.querySelector('.num-product').value || 1; // Jumlah produk
        const token = '{{ csrf_token() }}'; // CSRF token dari Laravel

        fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    id_barang: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product added to cart successfully!');
                    closeModal(); // Tutup modal
                    updateCart(); // Perbarui tampilan keranjang
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong!');
            });
    });

    // Fungsi untuk memperbarui isi keranjang
    function updateCart() {
        fetch('/api/cart')
            .then(response => response.json())
            .then(data => {
                const cartItems = data.items.map(item => `
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="${item.image}" alt="${item.name}">
                        </div>
                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                ${item.name}
                            </a>
                            <span class="header-cart-item-info">
                                ${item.quantity} x $${item.price.toFixed(2)}
                            </span>
                        </div>
                    </li>
                `).join('');

                document.querySelector('.header-cart-wrapitem').innerHTML = cartItems;
                document.querySelector('.header-cart-total').innerText = `Total: $${data.total.toFixed(2)}`;
            })
            .catch(error => console.error('Error fetching cart:', error));
    }
</script> --}}

{{-- produk --}}
<script>
    function openModal(product) {
        // Isi modal dengan data produk
        document.getElementById('modal-product-image').src = product.link_img;
        document.getElementById('modal-product-name').innerText = product.nama_barang;
        document.getElementById('modal-product-price').innerText = `Rp ${product.harga.toLocaleString()}`;
        document.getElementById('modal-product-description').innerText = product.deskripsi;

        // Menampilkan stok yang tersedia
        document.getElementById('modal-product-stock').innerText = `Stok Tersedia: ${product.jumlah_stok}`;

        // Simpan id_produk untuk Add to Cart button
        document.getElementById('add-to-cart-btn').setAttribute('data-id', product.id);

        // Menambahkan pembatasan input quantity
        document.getElementById('modal-product-quantity').max = product.jumlah_stok; // Max quantity sesuai stok

        // Tampilkan modal
        document.getElementById('productModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('productModal').style.display = 'none';
    }

    // Event untuk menutup modal
    document.querySelector('.overlay-modal1').addEventListener('click', closeModal);
    document.querySelectorAll('.js-hide-modal1').forEach(btn => btn.addEventListener('click', closeModal));

    // Event untuk Add to Cart
    document.getElementById('add-to-cart-btn').addEventListener('click', function() {
        const productId = this.getAttribute('data-id');
        const jumlah_barang = document.getElementById('modal-product-quantity').value;
        const stockAvailable = parseInt(document.getElementById('modal-product-quantity').max);

        // Cek apakah jumlah yang diminta lebih dari stok yang tersedia
        if (jumlah_barang > stockAvailable) {
            alert('Cannot add more than the available stock!');
            return;
        }

        fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id_barang: productId,
                    jumlah_barang: jumlah_barang
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Product added to cart successfully!');
                    closeModal();
                } else {
                    alert('Failed to add product to cart!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong!');
            });
    });
</script>

{{-- cart --}}
<script>
    // Menghitung ulang total harga berdasarkan produk yang dipilih
    document.querySelectorAll('.product-checkbox').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            const productId = this.getAttribute('data-id');
            const productPrice = parseFloat(this.getAttribute('data-price'));
            const quantity = parseInt(this.getAttribute('data-quantity'));
            const isChecked = this.checked;

            // Menampilkan tombol hapus jika produk dipilih
            const deleteButton = document.querySelector(`#cart-item-${productId} .btn-delete-product`);
            if (isChecked) {
                deleteButton.style.display = 'inline-block'; // Tampilkan tombol hapus
            } else {
                deleteButton.style.display = 'none'; // Sembunyikan tombol hapus
            }

            // Mengupdate total harga
            updateTotalPrice(isChecked, productPrice, quantity);
        });
    });

    // Fungsi untuk menghitung total harga
    function updateTotalPrice(isAdding, price, quantity) {
        let totalPrice = parseFloat(document.getElementById('total-price').innerText.replace(/[^\d.-]/g, ''));

        if (isAdding) {
            totalPrice += price * quantity; // Tambah harga x jumlah
        } else {
            totalPrice -= price * quantity; // Kurangi harga x jumlah
        }

        // Update total harga
        document.getElementById('total-price').innerText = totalPrice.toLocaleString();
    }

    // Checkbox Select All
    document.getElementById('select-all').addEventListener('change', function() {
        const isChecked = this.checked;

        // Centang atau hilangkan centang semua produk
        document.querySelectorAll('.product-checkbox').forEach(function(checkbox) {
            checkbox.checked = isChecked;

            const productId = checkbox.getAttribute('data-id');
            const productPrice = parseFloat(checkbox.getAttribute('data-price'));
            const quantity = parseInt(checkbox.getAttribute('data-quantity'));

            // Update total harga saat checkbox berubah
            updateTotalPrice(isChecked, productPrice, quantity);

            // Menampilkan tombol hapus jika produk dipilih
            const deleteButton = document.querySelector(`#cart-item-${productId} .btn-delete-product`);
            if (isChecked) {
                deleteButton.style.display = 'inline-block'; // Tampilkan tombol hapus
            } else {
                deleteButton.style.display = 'none'; // Sembunyikan tombol hapus
            }
        });
    });

    // Menghapus produk dari keranjang
    document.querySelectorAll('.btn-delete-product').forEach(function(button) {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productPrice = parseFloat(this.getAttribute('data-price'));
            const quantity = parseInt(document.getElementById(`quantity-${productId}`).innerText);

            // Hapus produk dari keranjang via AJAX
            fetch(`/cart/remove/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Menghapus elemen produk dari tampilan keranjang
                        document.querySelector(`#cart-item-${productId}`).remove();
                        updateTotalPrice(false, productPrice, quantity);
                        alert('Product removed from cart!');
                    } else {
                        alert('Failed to remove product!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong!');
                });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var chatBox = document.querySelector('.flex-grow-1');
        chatBox.scrollTop = chatBox.scrollHeight;
    });
</script>