@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($barangs as $barang)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{url($barang->image)}}" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title">{{$barang->name_barang}}</h5>
                      <p class="card-text">{{$barang->keterangan}}</p>
                      <p class="card-text">
                          <strong>Harga: </strong>{{number_format($barang->harga)}}
                      </p>
                      <a href="{{ url('barang')}}/{{$barang->id}}" class="btn btn-primary">Detail</a>
                    </div>
                  </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
@endsection