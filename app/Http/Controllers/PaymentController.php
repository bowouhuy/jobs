<?php

namespace App\Http\Controllers;

use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function handlePayment(Request $request)
    {
        $order_id = $request->order_id;

        // Your payment processing logic here
        $order = Order::where('order_id', $order_id)->first();
        $transaksi = $order->transaksi;

        $order->status = 2;
        $order->save();

        $transaksi->status = 'Paid';
        $transaksi->save();

        $transactionHistories = new TransactionHistory();
        $transactionHistories->transaksi_id = $transaksi->id;
        $transactionHistories->status = 2;
        $transactionHistories->save();
        return response()->json([
            'message' => 'Payment success',
            'order' => $order,
            'transaksi' => $transaksi,
            'transactionHistories' => $transactionHistories
        ]);
    }
}
