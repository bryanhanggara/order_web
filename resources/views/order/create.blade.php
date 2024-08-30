@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Tambah Pesanan</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf

            <div id="product-list">
                <!-- Baris produk akan ditambahkan di sini -->
            </div>

            <button type="button" id="add-product" class="btn btn-primary">Tambah Produk</button>
            <hr>
            
            <div class="mb-3">
                <label for="total" class="form-label">Total Harga</label>
                <input type="text" id="total" name="total_price" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-success">Kirim Pesanan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let productIndex = 0;

        const products = @json($products); // Menyertakan data produk dari controller

        // Fungsi untuk kalkulasi total harga
        function calculateTotal() {
            let total = 0;
            $('.product-row').each(function() {
                let price = $(this).find('.product-select option:selected').data('price');
                let quantity = $(this).find('.quantity').val();
                if (price && quantity) {
                    total += price * quantity;
                }
            });
            $('#total').val(total.toFixed(2));
        }

        // Fungsi untuk add produk
        function addProductRow() {
            let productOptions = products.map(product => 
                `<option value="${product.id}" data-price="${product.price}" data-stock="${product.stock}">${product.name} (Stok: ${product.stock})</option>`
            ).join('');

            $('#product-list').append(`
                <div class="product-row mb-3">
                    <div class="row">
                        <div class="col-md-5">
                            <select name="products[${productIndex}][id]" id="product-${productIndex}" class="form-control product-select" required>
                                <option value="">Pilih Produk</option>
                                ${productOptions}
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="number" name="products[${productIndex}][quantity]" class="form-control quantity" min="1" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-product"> <i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            `);

            productIndex++;
        }

        $('#add-product').click(function() {
            addProductRow();
        });

        $('#product-list').on('click', '.remove-product', function() {
            $(this).closest('.product-row').remove();
            calculateTotal();
        });

        $('#product-list').on('change', '.quantity, .product-select', function() {
            calculateTotal();
            updateStock();
        });

        function updateStock() {
            $('.product-row').each(function() {
                let select = $(this).find('.product-select');
                let quantityInput = $(this).find('.quantity');
                let stock = select.find('option:selected').data('stock');
                let quantity = quantityInput.val();

                if (quantity > stock) {
                    quantityInput.val(stock);
                    alert('Jumlah melebihi stok produk.');
                }
            });
        }
    });
</script>

@endsection
