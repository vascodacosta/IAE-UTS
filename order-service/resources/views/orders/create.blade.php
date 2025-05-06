@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Pesanan Baru</h1>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Pilih Pengguna</label>
                <select name="user_id" id="user_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="product_id">Pilih Produk</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - Rp. {{ number_format($product->price, 2) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Kuantitas</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success mt-3">Buat Pesanan</button>
        </form>
    </div>
@endsection
