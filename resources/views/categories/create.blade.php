@extends('layouts.admin')

@section('main-content')

{{ Breadcrumbs::render('categories.create') }}

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Create Category') }}</h1>

<div class="row">
    <div class="col-lg-12 mb-4">
        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">{{ __('Back') }}</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('Create Category') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endSection