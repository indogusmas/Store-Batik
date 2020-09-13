@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{$barang->nama_barang}}</li>
                </ol>
            </nav>
        </div>


        <div class="col-md-12 mt-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{url($barang->image)}}" class="rounded mx-auto d-block" width="100%">
                        </div>
                        <div class="col-md-6 mt-5">
                            <h3>{{$barang->nama_barang}}</h3>
                            <table class="table">
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td>{{$barang->harga}}</td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td>:</td>
                                    <td>{{$barang->stock}}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:</td>
                                    <td>{{$barang->keterangan}}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Pesan</td>
                                    <td>:</td>
                                    <td>
                                        <form method="post" action="{{url('pesanan/store')}}">
                                            @csrf
                                            <input type="hidden" name="barang_id" value="{{$barang->id}}" id="barang_id">
                                            <input type="number" name="jumlah_pesan" class="form-control" required>
                                            <button type="submit" class="btn btn-primary mt-2"><i
                                                    class="fa fa-shopping-cart"></i>
                                                Tambahkan ke Keranjang</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection