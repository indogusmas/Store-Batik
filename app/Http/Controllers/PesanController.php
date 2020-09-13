<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pesanan;
use App\PesananDetail;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class PesanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $barang = Barang::where('id', $request->barang_id)->first();
        $userId = Auth::user()->id;

        #check data pesanan exist by status 0

        $checkPesanan = Pesanan::where('user_id', $userId)
            ->where('status_id', 0)
            ->first();

        //Create new data pesanan
        if ($checkPesanan == null) {
            $pesanan = new Pesanan();
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = Carbon::now();
            $pesanan->status_id = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->save();

            #Save to pesanan detail

            $pesananDetail = new PesananDetail();
            $pesananDetail->barang_id = $barang->id;
            $pesananDetail->pesan_id = $pesanan->id;
            $pesananDetail->qty = $request->jumlah_pesan;
            $pesananDetail->sub_total = ($barang->harga * $request->jumlah_pesan);
            $pesananDetail->save();

        } else {

            #update pesanan barang exist

            $checkPesananDetail = DB::table('pesanan_detail')->where('pesanan_id', $checkPesanan->id)
                ->where('barang_id', $request->id)
                ->first();
            if ($checkPesananDetail == null) {

                # create new pesanan detail
                $pesananDetail = new PesananDetail();
                $pesananDetail->barang_id = $barang->id;
                $pesananDetail->pesanan_id = $checkPesanan->id;
                $pesananDetail->qty = $request->jumlah_pesan;
                $pesananDetail->sub_total = ($barang->harga * $request->jumlah_pesan);
                $pesananDetail->save();

            } else {

                # update qty barang

                $checkPesananDetail->jumlah = $request->jumlah_pesan;
                $checkPesananDetail->jumlah_harga = ($barang->harga * $request->jumlah_pesan);
                $checkPesananDetail->save();

            }

        }
        return redirect('home');

    }

    public function checkout(Request $request)
    {
        try {

            $pesanan = DB::table('pesanan')
                ->where('user_id', Auth::user()->id)
                ->where('status_id', 0)
                ->first();
            $pesananList = DB::table('pesanan_detail')
                ->leftjoin('pesanan', 'pesanan_detail.pesanan_id', 'pesanan.id')
                ->leftjoin('barang', 'pesanan_detail.barang_id', 'barang.id')
                ->where('pesanan.user_id', Auth::user()->id)
                ->where('pesanan.status_id', 0)
                ->select('pesanan_detail.*', 'barang.nama_barang', 'barang.harga')
                ->get();
            $data['pesanan'] = $pesanan;
            $data['pesananList'] = $pesananList;

            return view('pesan.check_out', $data);
        } catch (\Throwable $th) {

        }
    }

    public function delete(Request $request)
    {            
            $pesanan = PesananDetail::findOrFail($request->pesanan_id);
            $pesanan->delete();

            $pesanan = DB::table('pesanan')
                ->where('user_id', Auth::user()->id)
                ->where('status_id', 0)
                ->first();
            $pesananList = DB::table('pesanan_detail')
                ->leftjoin('pesanan', 'pesanan_detail.pesanan_id', 'pesanan.id')
                ->leftjoin('barang', 'pesanan_detail.barang_id', 'barang.id')
                ->where('pesanan.user_id', Auth::user()->id)
                ->where('pesanan.status_id', 0)
                ->select('pesanan_detail.*', 'barang.nama_barang', 'barang.harga')
                ->get();
            $data['pesanan'] = $pesanan;
            $data['pesananList'] = $pesananList;

            return view('pesan.check_out', $data);
    }
}
