<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishOrderCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function handle(): void
    {
        // Logic untuk mengirim pesan bisa ditaruh di sini,
        // tapi karena kita menggunakan Laravel Queue,
        // framework akan otomatis serialize object ini dan mengirimkannya ke RabbitMQ.
        // Service lain akan "menerima" data dari $this->order.
        echo "Publishing order created event for Order ID: {$this->order->id}\n";
    }
}