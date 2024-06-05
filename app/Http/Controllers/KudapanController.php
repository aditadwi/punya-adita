<?php

namespace App\Http\Controllers;

use App\Models\Kudapan;
use App\Models\Pelanggan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class KudapanController extends Controller
{
    //
    public function index()
{
    $kudapan=Kudapan::all();
    return view('kudapan.index',[
        "title"=>"Kudapan",
        "data"=>$kudapan
    ]);
}
public function create():View
{
    return view('kudapan.create')->with([
        "title"=>"Tambah Data Kudapan",
    ]);
}
public function store(Request $request):RedirectResponse
{
    $request->validate([
        "name"=>"required",
        "description"=>"nullable",
        "stock"=>"required",
        "harga"=>"required",
    ]); 

    Kudapan::create($request->all());
    return redirect()->route('kudapan.index')->with('success','Data Kudapan Berhasil Ditambahkan');
}
    public function edit(Kudapan $kudapan):View
{
    return view('kudapan.edit',compact('kudapan'))->with([
        "title" => "Ubah Data Kudapan",
        

    ]);
}
public function update(Kudapan $kudapan, Request $request): RedirectResponse
{
    $request->validate([
        "name"=>"required",
        "description"=>"required",
        "stock"=>"required",
        "harga"=>"required",
    ]);
    $kudapan->update($request->all());
    return redirect()->route('kudapan.index')->with('updated','Data Kudapan Berhasil Diubah');
}
public function show():View
{
    $kudapan=Kudapan::all();
    return view('kudapan.show')->with([
        "title" => "Tampil Data Kudapan",
        "data"=>$kudapan
    ]);
}
public function destroy($id):RedirectResponse
{
    Kudapan::where('id',$id)->delete();
    return redirect()->route('kudapan.index')->with('deleted','Data Kudapan Berhasil Dihapus');
}
}