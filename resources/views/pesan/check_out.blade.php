@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-body">
                        <h3>List Pesanan</h3>
                        @if (!empty($pesananList))
                        <p align="right">Tanggal Pesan: {{$pesanan->tanggal}} </p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                $tot_pesan = 0;
                                @endphp
                                @foreach ($pesananList as $pesanan)
                                @php
                                $tot_pesan = $tot_pesan + $pesanan->sub_total;
                                @endphp

                                <tr>

                                    <td>{{$no++}}</td>
                                    <td>{{$pesanan->nama_barang}}</td>
                                    <td>{{number_format($pesanan->qty)}}</td>
                                    <td>{{number_format($pesanan->harga)}}</td>
                                    <td>{{number_format($pesanan->sub_total)}}</td>
                                    <td>
                                        <form action="{{url('pesanan/delete')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="pesanan_id" value="{{$pesanan->id}}">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Anda yakin akan menghapus data ?');">
                                                <li class="fa fa-trash"></li>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right"><strong>Total Harga :</strong></td>
                                    <td>{{ number_format($tot_pesan) }}</td>
                                    <td>
                                        <a href="{{ url('konfirmasi-check-out') }}" class="btn btn-success"
                                            onclick="return confirm('Anda yakin akan Check Out ?');">
                                            <i class="fa fa-shopping-cart"></i> Check Out
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection