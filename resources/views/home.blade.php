@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="row">
    <div class="col">
        <!-- Monthly Sales Chart -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h3 class="mb-0">Monthly Sales</h3>
                <p class="mb-0">Shows the total sales for each month.</p>
            </div>
            <div class="card-body">
                <canvas id="salesChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col">
        <!-- Products Sold Chart -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h3 class="mb-0">Products Sold</h3>
                <p class="mb-0">Shows the total quantity of products sold for each month.</p>
            </div>
            <div class="card-body">
                <canvas id="productsSoldChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col">
        <!-- Products Stock Chart -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h3 class="mb-0">Products in Stock</h3>
                <p class="mb-0">Shows the total quantity of products in stock for each category.</p>
            </div>
            <div class="card-body">
                <canvas id="productsStockChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col">
        <!-- Categories Pie Chart -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h3 class="mb-0">Categories Distribution</h3>
                <p class="mb-0">Shows the distribution of products for each category.</p>
            </div>
            <div class="card-body">
                <canvas id="categoriesPieChart" style="height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monthly Sales Data
        var ctxSales = document.getElementById('salesChart').getContext('2d');
        var salesData = @json($salesData);

        var salesLabels = salesData.map(function(item) {
            return item.month;
        });

        var salesValues = salesData.map(function(item) {
            return item.total_sales;
        });

        new Chart(ctxSales, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Monthly Sales',
                    data: salesValues,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Products Sold Data
        var ctxProductsSold = document.getElementById('productsSoldChart').getContext('2d');
        var productsSoldData = @json($productsSold);

        var productsSoldLabels = productsSoldData.map(function(item) {
            return item.product_name;
        });

        var productsSoldValues = productsSoldData.map(function(item) {
            return item.total_sold;
        });

        new Chart(ctxProductsSold, {
            type: 'bar',
            data: {
                labels: productsSoldLabels,
                datasets: [{
                    label: 'Products Sold',
                    data: productsSoldValues,
                    borderColor: 'rgba(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Products Stock Data
        var ctxProductsStock = document.getElementById('productsStockChart').getContext('2d');
        var productsStockData = @json($productsStock);

        var productsStockLabels = productsStockData.map(function(item) {
            return item.product_name;
        });

        var productsStockValues = productsStockData.map(function(item) {
            return item.product_stock;
        });

        new Chart(ctxProductsStock, {
            type: 'bar',
            data: {
                labels: productsStockLabels,
                datasets: [{
                    label: 'Products in Stock',
                    data: productsStockValues,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Categories Pie Chart
        var ctxCategoriesPie = document.getElementById('categoriesPieChart').getContext('2d');
        var categoriesData = @json($categories);

        var categoriesLabels = categoriesData.map(function(item) {
            return item.name;
        });

        var categoriesValues = categoriesData.map(function(item) {
            return item.products_count;
        });

        new Chart(ctxCategoriesPie, {
            type: 'bar',
            data: {
                labels: categoriesLabels,
                datasets: [{
                    label: 'Categories Distribution',
                    data: categoriesValues,
                    backgroundColor: [
                        'rgba(255, 99, 132)',
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(75, 192, 192)',
                        'rgba(153, 102, 255)',
                        'rgba(255, 159, 64)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>

@endsection