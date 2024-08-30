@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Total Pembelian Hari Ini</h1>
        <a href="{{route('orders.create')}}" class="btn btn-primary mt-4 mb-4"><i class="bi bi-cart"></i></a>

        @if ($totalRupiah > 0)
            <div class="alert alert-info">
                Total Rupiah: Rp {{ number_format($totalRupiah, 2, ',', '.') }}
            </div>
        @else
            <div class="alert alert-warning">
                Belum ada pembelian hari ini.
            </div>
        @endif
    </div>
@endsection
