@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Pesanan</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama Pengguna</th>
                    <th>Nama Produk</th>
                    <th>Kuantitas</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>Rp. {{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
