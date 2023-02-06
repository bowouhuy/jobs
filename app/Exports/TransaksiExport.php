<?php
 
namespace App\Exports;
 
use App\Models\Transaksi;
use App\Models\JasaImage;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class TransaksiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transaksi = Transaksi::with('jasa')->get();
        $data = array();
        foreach ($transaksi as $key => $item) {
            $jasa_image = Jasaimage::where('jasa_id', $item->jasa_id)->take(1)->first();
            $data[$key] = $item;
            if ($jasa_image){
                $data[$key]['image'] = $jasa_image->url;
            }
        }
        foreach ($transaksi as $key => $item) {
            $mitra = User::where('id', $item->jasa->mitra_id)->take(1)->first();
            $data[$key] = $item;
            if ($mitra){
                $data[$key]['nama_mitra'] = $mitra->first_name.' '.$mitra->last_name;
            }
        }

        return collect($data);
    }
}