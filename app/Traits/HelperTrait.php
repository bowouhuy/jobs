<?php
namespace App\Traits;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\TransactionHistory;

trait HelperTrait
{
    public function orderHistory($id){
        $order = Order::with('paket.jasa.mitra')->find($id);
        $orderHistories = OrderHistory::where('order_id', $id)->get();
        $transaksiHistories = TransactionHistory::where('transaksi_id', $order->transaksi_id)->get();
        $mergeHistory = [];

        $statusOrder = [
            1 => 'Pesanan Dibuat',
            2 => 'Menunggu Konfirmasi',
            3 => 'Dalam Proses',
            4 => 'Selesai',
            5 => 'Dibatalkan'
        ];
        $statusTransaksi = [
            1 => 'Menunggu Pembayaran',
            2 => 'Pembayaran Selesai',
            3 => 'Pembayaran Gagal'
        ];

        foreach ($orderHistories as $key => $orderHistory) {
            $mergeHistory[] = [
                'date' => $orderHistory->created_at,
                'status' => $statusOrder[$orderHistory->status],
                'type' => 'order'
            ];
        }
        foreach ($transaksiHistories as $key => $transaksiHistory) {
            $mergeHistory[] = [
                'date' => $transaksiHistory->created_at,
                'status' => $statusTransaksi[$transaksiHistory->status],
                'type' => 'transaksi'
            ];
        }
        usort($mergeHistory, function ($a, $b) {
            $dateComparison = $a['date']->timestamp - $b['date']->timestamp;

            if ($dateComparison === 0) {
                if ($a['type'] === 'order' && $b['type'] !== 'order') {
                    return -1;
                } elseif ($a['type'] !== 'order' && $b['type'] === 'order') {
                    return 1;
                } else {
                    return 0;
                }
            }

            return $dateComparison;
        });

        return $mergeHistory;
    }
}
