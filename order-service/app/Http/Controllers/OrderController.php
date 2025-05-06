<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);

        // Mengambil data user dari UserService
        $user = Http::get('http://localhost:8001/api/users/' . $request->user_id);
        if ($user->failed()) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Mengambil data produk dari ProductService
        $product = Http::get('http://localhost:8002/api/products/' . $request->product_id);
        if ($product->failed()) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        // Menghitung total harga
        $total_price = $product->json()['price'];

        // Menyimpan data pesanan
        $order = Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'total_price' => $total_price,
        ]);

        return response()->json($order, 201);
    }

    public function index()
    {
        // Mengambil semua data pesanan
        $orders = Order::all();

        // Mengirim data pesanan ke view
        return view('welcome', ['orders' => $orders]);

    }
}
