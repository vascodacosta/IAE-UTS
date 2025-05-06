<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Order Service</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5 flex-fill">

        <!-- Notifikasi -->
        <div id="notification" class="alert alert-success d-none" role="alert">
            Pesanan Anda berhasil dibuat!
        </div>

        <!-- Section: Form Pesanan -->
        <section class="mb-5">
            <h2 class="mb-4">Buat Pesanan Baru</h2>
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="orderForm">
                        @csrf
                        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">User ID</label>
                                <input type="number" class="form-control" id="user_id" name="user_id" required>
                            </div>
                            <div class="col-md-6">
                                <label for="product_id" class="form-label">Product ID</label>
                                <input type="number" class="form-control" id="product_id" name="product_id" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Buat Pesanan</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Section: Tabel Pesanan -->
        <section>
            <h2 class="mb-4">Daftar Pesanan</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-sm bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Product ID</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>{{ $order->product_id }}</td>
                                <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <small>&copy; {{ date('Y') }} Order Service. All rights reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script AJAX -->
    <script>
        document.getElementById('orderForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const user_id = document.getElementById('user_id').value;
            const product_id = document.getElementById('product_id').value;
            const csrfToken = document.getElementById('csrf_token').value;

            fetch("{{ url('/orders') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    user_id: user_id,
                    product_id: product_id
                })
            })
            .then(response => {
                if (!response.ok) throw new Error("Gagal membuat pesanan");
                return response.json();
            })
            .then(data => {
                document.getElementById('notification').classList.remove('d-none');
                document.getElementById('orderForm').reset();
                // Bisa tambahkan baris ke tabel di sini kalau mau
            })
            .catch(error => {
                alert("Terjadi kesalahan: " + error.message);
            });
        });
    </script>
</body>
</html>
