@extends('layouts.template') 
@section('judulh1','Admin - Kudapan') 
 
@section('konten') 
<div class="col-md-6"> 
    @if ($errors->any()) 
    <div class="alert alert-danger"> 
        <strong>Whoops!</strong> There were some problems with your input.<br><br> 
        <ul> 
            @foreach ($errors->all() as $error) 
            <li>{{ $error }}</li> 
            @endforeach 
        </ul> 
    </div> 
    @endif 
 
    <div class="card card-warning"> 
        <div class="card-header"> 
            <h3 class="card-title">Ubah Data Kudapan</h3> 
        </div> 
        <!-- /.card-header --> 
        <!-- form start --> 
        <form action="{{ route('kudapan.update',$kudapan->id) }}" method="POST"> 
            @csrf 
            @method('PUT') 
            <div class=" card-body"> 

                <div class="form-group"> 
                    <label for="name">Nama kudapan</label> 
                    <input type="text" class="form-control" id="name" name="name" placeholder=""                         value="{{$kudapan->name}}"> 
                </div> 
                <div class="form-group"> 
                    <label for="stock">Stok</label> 
                    <input type="number" class="form-control" id="stock" name="stock" value="{{$kudapan->stock}}"> 
                </div> 
 
                <div class="form-group"> 
                    <label for="price">Harga</label> 
                    <input type="number" class="form-control" id="harga" name="harga" value="{{$kudapan->harga}}"> 
                </div> 
                <div class=" form-group"> 
                    <label for="description">Deskripsi</label> 
                    <textarea id="description" name="description" class=" form-control"                         rows="4">{{ $kudapan->description }}</textarea> 
                </div> 
            </div> 
            <!-- /.card-body --> 
 
            <div class="card-footer"> 
            <button type="submit" class="btn btn-warning floatright">Ubah</button> 
            </div> 
        </form> 
    </div> 
 
 
</div> 
 
 
@endsection 
