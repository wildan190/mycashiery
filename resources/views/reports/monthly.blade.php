@extends('layouts.admin')

@section('main-content')

{{ Breadcrumbs::render('reports.monthly') }}

<div class="card mb-4">
    <div class="card-header text-center">
        <h2 class="font-weight-bold">Total Sales for {{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</h2>
    </div>
    <div class="card-body text-center">
        <h1 class="display-4 font-weight-bold">{{ number_format($monthlySales, 2) }}</h1>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Transactions</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Transaction ID</th>
                    <th scope="col">Date</th>
                    <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->transaction_number }}</td>
                    <td>{{ $transaction->transaction_date }}</td>
                    <td>{{ number_format($transaction->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection