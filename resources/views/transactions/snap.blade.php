@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Transactions') }}</h1>

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
    <div class="col-lg-12 mb-4">
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
        <script type="text/javascript">
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    /* You may add your own implementation here */
                    alert("payment success!"); 
                    window.location.href = "{{ route('transactions.create') }}";
                },
                onPending: function(result){
                    /* You may add your own implementation here */
                    alert("wating your payment!"); 
                },
                onError: function(result){
                    /* You may add your own implementation here */
                    alert("payment failed!"); 
                },
                onClose: function(){
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        </script>
    </div>
</div>


@endsection