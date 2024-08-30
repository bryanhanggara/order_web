@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Order #{{ $order->id }}</h1>
    
    <p><strong>Tanggal Order:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
    <p><strong>Total Harga:</strong> Rp {{ number_format($order->items->sum(function($item) {
        return $item->quantity * $item->price;
    }), 0, ',', '.') }}</p>

    <h3>Barang yang Dibeli:</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('history') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
