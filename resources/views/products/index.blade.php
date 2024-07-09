@extends('layouts.admin')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Products') }}</h1>

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
    <div class="col-lg-6 mb-4">
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">{{ __('Create Product') }}</span>
        </a>
    </div>
</div>

<div class="row">
    @foreach ($products as $product)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card shadow mb-4">
            @if ($product->picture)
            <img src="{{ asset('storage/' . $product->picture) }}" alt="{{ $product->product_name }}" class="card-img-top">
            @endif
            <div class="card-body p-2">
                <h4 class="card-title mb-0">{{ $product->product_name }}</h4>
                <p class="card-text text-muted mb-0">{{ $product->category->name }}</p>
                <p class="card-text text-muted mb-0">Stok: {{ $product->product_stock }}</p>
                <p class="card-text">Rp. {{ number_format($product->price, 2) }}</p>    
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="mx-auto">
            {!! $products->links() !!}
        </div>
    </div>
</div>
@endsection

