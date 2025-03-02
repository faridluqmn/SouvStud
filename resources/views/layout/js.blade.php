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


<script>
    //admin edit produk
    function openEditModal(id) {
        document.getElementById(`editProductModal${id}`).style.display = "flex";
    }

    function closeEditModal(id) {
        document.getElementById(`editProductModal${id}`).style.display = "none";
    }
</script>

{{-- produk --}}
<script>
    //ambil stok dari database hanya user , admin gabisa (letak di user index)

    async function openModal(product) {
        // Isi modal dengan data produk
        document.getElementById('modal-product-image').src = product.link_img;
        document.getElementById('modal-product-name').innerText = product.nama_barang;
        document.getElementById('modal-product-price').innerText = `Rp ${product.harga.toLocaleString()}`;
        document.getElementById('modal-product-description').innerText = product.deskripsi;

        // Ambil stok dari database
        let stok = await getStock(product.id);
        document.getElementById('modal-product-stock').innerText = `Stok Tersedia: ${stok}`;

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
    document.addEventListener('DOMContentLoaded', function() {
        const addToCartBtn = document.getElementById('add-to-cart-btn');

        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', async function() {
                const productId = this.getAttribute('data-id');
                const quantityInput = document.getElementById('modal-product-quantity');
                const jumlah_barang = parseInt(quantityInput.value);
                const stockAvailable = parseInt(quantityInput.max);

                // Validasi stok sebelum mengirim request
                if (jumlah_barang > stockAvailable || jumlah_barang <= 0 || isNaN(jumlah_barang)) {
                    alert('Invalid quantity! Please enter a valid amount within stock limits.');
                    return;
                }

                try {
                    let response = await fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id_barang: productId,
                            jumlah_barang: jumlah_barang
                        })
                    });

                    let data = await response.json();

                    if (response.ok && data.success) {
                        alert('Product added to cart successfully!');
                        closeModal();
                    } else {
                        alert(data.message || 'Failed to add product to cart!');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Something went wrong! Please try again.');
                }
            });
        }
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
<script>
    document.getElementById('apply-coupon').addEventListener('click', function() {
        var couponCode = document.getElementById('coupon-code').value.trim();
        var totalPrice = parseFloat(document.getElementById('total-price').innerText.replace('Rp', '').replace(
            ',', '').trim());
        var discountAmount = 0;
        var discountMessage = '';

        // Pastikan kode kupon tidak kosong
        if (!couponCode) {
            discountMessage = 'Silakan masukkan kode kupon.';
            document.getElementById('discount-message').innerText = discountMessage;
            document.getElementById('discount-message').classList.remove('hidden');
            return;
        }

        // Mengirim request AJAX untuk memeriksa kupon
        fetch('/kupon/validate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    coupon_code: couponCode,
                    total_price: totalPrice
                })
            })
            .then(response => response.json())
            .then(data => {
                // Memeriksa apakah kupon valid
                if (data.success) {
                    discountAmount = data.discount_amount;
                    discountMessage =
                        `Kupon berhasil diterapkan! Diskon: Rp ${discountAmount.toLocaleString()}`;
                } else {
                    discountMessage = data.message || 'Kupon tidak valid!';
                }

                // Periksa apakah diskon lebih besar dari harga total (jangan sampai negatif)
                var finalPrice = totalPrice - discountAmount;
                if (finalPrice < 0) finalPrice = 0;

                // Tampilkan pesan dan harga setelah diskon
                document.getElementById('discount-message').innerText = discountMessage;
                document.getElementById('final-price').innerText = `Rp ${finalPrice.toLocaleString()}`;

                // Pastikan pesan muncul (tampilkan elemen discount-message jika belum ditampilkan)
                document.getElementById('discount-message').classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('discount-message').innerText =
                    'Terjadi kesalahan saat memeriksa kupon.';
                document.getElementById('discount-message').classList.remove('hidden');
            });
    });
</script>
<script>
    //checkout
    document.getElementById('checkout-btn').addEventListener('click', async function(event) {
        event.preventDefault(); // Hindari submit form default

        let selectedItems = [];
        document.querySelectorAll('.product-checkbox:checked').forEach(checkbox => {
            selectedItems.push(checkbox.getAttribute('data-id'));
        });

        console.log("Selected Items:", selectedItems); // Debugging

        if (selectedItems.length === 0) {
            alert('Pilih setidaknya satu produk untuk checkout!');
            return;
        }

        try {
            let response = await fetch('/cart/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    selectedItems: selectedItems
                })
            });

            let data = await response.json();

            if (data.success) {
                alert('Checkout berhasil!');
                selectedItems.forEach(id => {
                    let item = document.getElementById(`cart-item-${id}`);
                    if (item) item.remove();
                });
            } else {
                alert(data.message);
            }
        } catch (error) {
            console.error('Error during checkout:', error);
            alert('Terjadi kesalahan saat checkout!');
        }
    });
</script>
