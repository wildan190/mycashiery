@extends('layouts.admin')

@section('main-content')

{{ Breadcrumbs::render('reports.products') }}

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Products Report') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Sales by Product</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Total Sold</th>
                    <th scope="col">Total Sales Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productSales as $sale)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sale->product_name }}</td>
                    <td>{{ $sale->total_sold }}</td>
                    <td>{{ number_format($sale->total_sales_value, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-4 shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Remaining Products</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Stock</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($remainingProducts as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->product_stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection