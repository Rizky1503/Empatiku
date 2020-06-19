<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Image;

class OrderProdukController extends BaseController
{
  public function OrderProduk(Request $request){
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', ENV('APP_URL_API').'order/OrderProduk', [
            'form_params'         => [
                'id_produk'       => decrypt($request->id_produk),
                'id_mitra'        => decrypt($request->id_mitra),
                'jumlah'          => $request->jumlah,
                'nama_pemesan'    => $request->nama_pemesan,
                'no_telp_pemesan' => $request->no_telp_pemesan,
                'alamat'          => $request->alamat,
                'desc'            => $request->deskripsi,
                'id_pemesan'      => $request->id_pemesan,
            ]
    ]);
  }

  public function ListProduk(){
    $this->title = 'Lihat Produk';   
    $this->sub_title = '';

    $produk = json_decode(file_get_contents(ENV('APP_URL_API').'order/ListProduk'));

    return view('page.ListProduk')->with([
        'page' => $this,
        'produk' => $produk,
    ]);
  }

  public function LihatPesanan(){
    $this->title = 'Lihat Pesanan';   
    $this->sub_title = '';

    $pemesan = json_decode(file_get_contents(ENV('APP_URL_API').'order/pemesanRequest'));

    return view('page.ListPesananRequested')->with([
        'page' => $this,
        'pemesan' => $pemesan
    ]);
  }

   public function DetailPesanan($id){
    $dec = decrypt($id);
    $id_pemesan = $dec[0];

    $this->title = 'Lihat Pesanan';   
    $this->sub_title = '';

    $pesanan = json_decode(file_get_contents(ENV('APP_URL_API').'order/DetailPesanan/'.$id_pemesan));

    return view('page.DetailPesananRequested')->with([
        'page' => $this,
        'pesanan' => $pesanan
    ]);
  }

  public function BatalkanPesanan($id){
    $dec = decrypt($id);
    $id_produk = $dec[0];
    $id_pemesan = $dec[1];

    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', ENV('APP_URL_API').'order/HapusPesanan', [
            'form_params'         => [
                'id_produk'       => $id_produk,
                'id_pemesan'      => $id_pemesan,
            ]
    ]);

    return redirect()->route('Orderproduk.DetailPesanan',encrypt([$id_pemesan]));
  }

   public function DealPesanan(Request $request){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', ENV('APP_URL_API').'order/OrderlDeal', [
                'form_params'      => [
                    'id_pemesan'  => $request->id_pemesan,
                    'dp'          => $request->dp,
                    'total'       => $request->total,
                ]
        ]);
   }

   public function LunasiPesanan (Request $request){
    $pesanan = json_decode(file_get_contents(ENV('APP_URL_API').'order/LunasiPemesanan/'.$request->id_pemesan));
   }

   public function ListPemesanan (){
        $this->title = 'Lihat Pesanan';   
        $this->sub_title = '';

        $pesanan = json_decode(file_get_contents(ENV('APP_URL_API').'order/pesananmitdor/'.Session::get('id_member_token') ));

        return view('page.ListPesananMitdor')->with([
            'page' => $this,
            'pesanan' => $pesanan
        ]);
   }
}
