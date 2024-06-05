<?php

namespace App\Http\Controllers;
use App\Models\Detiltransaksi;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\View\View;

class CetakController extends Controller
{
    public function receipt():View
    {
    $id=session()->get('id');

    $transaksi=Transaksi::find($id);
    //dd($order)
    $Detiltransaksi=Detiltransaksi::where('transaksi_id',$id)->get();
    return view('penjualan.receipt')->with([
        'dataTransaksi'=>$transaksi,
        'dataDetiltransaksi'=>$Detiltransaksi
    ]);
    }
}
