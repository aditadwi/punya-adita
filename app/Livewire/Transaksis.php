<?php

namespace App\Livewire;

use Exception;
use App\Models\Transaksi;
use App\Models\Kudapan;
use Livewire\Component;
use App\Models\Detiltransaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Transaksis extends Component
{
    public $total;
    public $transaksi_id;
    public $kudapan_id;
    public $jumlah=1;
    public $uang;
    public $kembali;

    public function render()
    {
        $transaksi=Transaksi::select('*')->where('user_id','=',Auth::user()->id)->orderBy('id','desc')->first();

        $this->total=$transaksi->total;
        $this->kembali=$this->uang-$this->total;
        return view('livewire.transaksis')
        ->with("data",$transaksi)
        ->with("dataKudapan",Kudapan::where('stock','>','0')->get())
        ->with("dataDetiltransaksi",Detiltransaksi::where('transaksi_id','=',$transaksi->id)->get());
    }

    public function store()
    {
        $this->validate([
            
            'kudapan_id'=>'required'
        ]);
        $transaksi=Transaksi::select('*')->where('user_id','=',Auth::user()->id)->orderBy('id','desc')->first();
        $this->transaksi_id=$transaksi->id;
        $kudapan=Kudapan::where('id','=',$this->kudapan_id)->get();
        $harga=$kudapan[0]->harga;
        Detiltransaksi::create([
            'transaksi_id'=>$this->transaksi_id,
            'kudapan_id'=>$this->kudapan_id,
            'jumlah'=>$this->jumlah,
            'harga'=>$harga
        ]);
        
        
        $total=$transaksi->total;
        $total=$total+($harga*$this->jumlah);
        Transaksi::where('id','=',$this->transaksi_id)->update([
            'total'=>$total
        ]);
        $this->kudapan_id=NULL;
        $this->jumlah=1;

    }

    public function delete($Detiltransaksi_id)
    {
        $Detiltransaksi=Detiltransaksi::find($Detiltransaksi_id);
        $Detiltransaksi->delete();

        //update total
        $Detiltransaksi=Detiltransaksi::select('*')->where('transaksi_id','=',$this->transaksi_id)->get();
        $total=0;
        foreach($Detiltransaksi as $od){
            $total+=$od->jumlah*$od->harga;
        }
        
        try{
            Transaksi::where('id','=',$this->transaksi_id)->update([
                'total'=>$total
            ]);
        }catch(Exception $e){
            dd($e);
        }
    }
    
    public function receipt($id)
    {
        $Detiltransaksi = Detiltransaksi::select('*')->where('transaksi_id','=', $id)->get();
        //dd ($Detiltransaksi);
        foreach ($Detiltransaksi as $od) {
            $stocklama = Kudapan::select('stock')->where('id','=', $od->kudapan_id)->sum('stock');
            $stock = $stocklama - $od->jumlah;
            try {
                Kudapan::where('id','=', $od->kudapan_id)->update([
                    'stock' => $stock
                ]);
            } catch (Exception $e) {
                dd($e);
            }
        }
        return Redirect::route('cetakReceipt')->with(['id' => $id]);

    }

}
