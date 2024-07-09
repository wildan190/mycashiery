@extends('layouts.admin')

@section('main-content')

{{ Breadcrumbs::render('transactions.create') }}

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Create Transaction') }}</h1>

<div class="row">
    <div class="col-lg-12 mb-4">
        <a href="{{ route('transactions.index') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">{{ __('Back') }}</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Transaction</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="shadow-md rounded-lg">
                            <div class="bg-white p-4">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Products</h3>
                                <input type="text" id="search-product" class="mb-4 p-2 border rounded-md w-full" placeholder="Search Product...">
                                <div id="product-grid" class="grid grid-cols-4 gap-4 mb-4">
                                    @foreach ($products->chunk(4) as $chunk)
                                        <div class="row">
                                            @foreach ($chunk as $product)
                                                <div class="col-md-3">
                                                    <div class="card mb-4 shadow-sm rounded-md border-0 bg-white" style="width: 10rem;">
                                                        <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->product_name }}" class="card-img-top" style="height: 10rem;">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-truncate">{{ $product->product_name }}</h5>
                                                            <p class="card-text text-truncate">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                                            <button class="btn btn-primary btn-sm add-product-btn" data-product-id="{{ $product->id }}" data-product-name="{{ $product->product_name }}" data-product-price="{{ $product->price }}">Add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                {{ $products->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Selected Products</h3>
                            <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="mb-3" style="display: none;">
                                    <label for="transaction_date" class="form-label">Transaction Date:</label>
                                    <input readonly type="date" name="transaction_date" id="transaction_date" class="form-control" value="<?php echo date('Y-m-d') ?>">
                                </div>
                                <p class="form-control-static"><strong><?php echo date('Y-m-d') ?></strong></p>
                                <div class="mb-3">
                                    <label for="customer" class="form-label">Customer:</label>
                                    <input type="text" name="customer" id="customer" class="form-control">
                                </div>
                                <div id="selected-products">
                                    <!-- Tempat untuk produk yang dipilih -->
                                </div>
                                <div id="total-price" class="text-lg font-medium text-gray-900 mt-4">
                                    Total Price: <span id="total-price-value">Rp0</span>
                                </div>
                                <button type="submit" class="btn btn-primary">Create Transaction</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addProductButtons = document.querySelectorAll('.add-product-btn');
        const selectedProductsContainer = document.getElementById('selected-products');
        const totalPriceElement = document.getElementById('total-price-value');
        const searchProductInput = document.getElementById('search-product');
        const productItems = document.querySelectorAll('.product-item');
        let totalPrice = 0;

        searchProductInput.addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            productItems.forEach(item => {
                const productName = item.getAttribute('data-product-name');
                if (productName.includes(searchValue)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        addProductButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const productName = this.getAttribute('data-product-name');
                const productPrice = this.getAttribute('data-product-price');

                const productRow = document.createElement('div');
                productRow.classList.add('mb-4');
                productRow.innerHTML = `
                    <input type="hidden" name="products[${productId}][id]" value="${productId}">
                    <p class="text-gray-700 dark:text-gray-300">${productName}</p>
                    <label for="quantity_${productId}" class="block mt-2 text-sm font-medium text-gray-700 dark:text-gray-300">Quantity:</label>
                    <input type="number" name="products[${productId}][quantity]" id="quantity_${productId}" class="mt-1 p-2 border rounded-md w-full dark:bg-gray-700 dark:text-gray-300 product-quantity" data-product-price="${productPrice}" required>
                `;
                selectedProductsContainer.appendChild(productRow);

                const quantityInput = productRow.querySelector('.product-quantity');
                quantityInput.addEventListener('input', function() {
                    updateTotalPrice();
                });
            });
        });

        function updateTotalPrice() {
            let total = 0;
            const quantityInputs = document.querySelectorAll('.product-quantity');
            quantityInputs.forEach(input => {
                const productPrice = parseFloat(input.getAttribute('data-product-price'));
                const quantity = parseInt(input.value);
                if (!isNaN(quantity)) {
                    total += productPrice * quantity;
                }
            });
            totalPriceElement.textContent = formatRupiah(total);
        }

        function formatRupiah(angka, prefix = "Rp") {
            var numberString = angka.toString().replace(/[^,\d]/g, ""),
                split = numberString.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                const separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            return prefix + (split[1] != undefined ? rupiah + "," + split[1] : rupiah);
        }
    });
</script>

@endsection