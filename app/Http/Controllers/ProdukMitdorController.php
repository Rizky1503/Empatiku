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

class ProdukMitdorController extends BaseController
{
    
  public function TambahKategori(){
    $this->title = 'Tambah Kategori';   
    $this->sub_title = '';

    $kategori = json_decode(file_get_contents(ENV('APP_URL_API').'ProdukMitdor/ViewKategori'));

    return view('page.TambahKategoriProduk')->with([
        'data' => $kategori->status,
        'page' => $this,
    ]);
  }

  public function StoreKategori(Request $request){
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', ENV('APP_URL_API').'ProdukMitdor/StoreKategori', [
            'form_params'  => [
                'kategori'      => strtoupper($request->kategori),
                'sub_kategori'  => strtoupper($request->sub_kategori),
            ]
    ]);
  }

  public function UpdateKategori(Request $request){
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', ENV('APP_URL_API').'ProdukMitdor/UpdateKategori', [
            'form_params'  => [
                'kategori'      => strtoupper($request->kategori),
                'sub_kategori'  => strtoupper($request->sub_kategori),
                'id_kategori'  => $request->id_kategori,
            ]
    ]);
  }
    
  public function TambahProduk($id){
      $dec = decrypt($id);
      $id_mitra = $dec[0];
      $jenis = $dec[1];
      
      $this->title = 'Tambah Produk Mitra/Vendor';   
      $this->sub_title = '';
     
      $kategori = json_decode(file_get_contents(ENV('APP_URL_API').'ProdukMitdor/GetKategori'));

      return view('page.TambahProdukMitraVendor')->with([
          'page' => $this,
          'id_mitra' => $id_mitra,
          'jenis' => $jenis,
          'kategori' => $kategori
      ]);
  }

  public function GetSubKategori(Request $request){
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', ENV('APP_URL_API').'ProdukMitdor/GetSubKategori', [
            'form_params'  => [
                'kategori'    => $request->kategori,
            ]
    ]);
    $sub_kategori = json_decode($response->getBody());

    echo "<option value=''>--Pilih Sub Kategori--</option>";
    
    foreach ($sub_kategori->data as $key => $value) {
        echo "<option value='".$value->sub_kategori."'>".$value->sub_kategori."</option>";
    }
  }

  public function StoreProduk(Request $request){
    $client = new \GuzzleHttp\Client();
    $response = $client->request('POST', ENV('APP_URL_API').'ProdukMitdor/StoreProduk', [
      'form_params'  => [
          'id_mitra'    => $request->id_mitra,
          'nama_produk'    => $request->nama_produk,
          'jumlah'    => $request->jumlah_produk,
          'deskripsi'    => $request->deskripsi,
          'harga'     => $request->harga,
          'kategori'    => $request->kategori,
          'sub_kategori'    => $request->sub_kategori,
          'jenis'    => $request->jenis
      ]
    ]);
    $responses = json_decode($response->getBody());

    return redirect()->route('ProdukMitraVendor.TambahImageProduk',encrypt([$responses->data,$request->jenis,$request->id_mitra]));
    
  }

  public function TambahImageProduk(Request $request,$id){
    $dec = decrypt($id);
    $id_produk = $dec[0];
    $jenis = $dec[1];
    $id_mitra = $dec[2];
    
    $this->title = 'Tambah Produk Mitra/Vendor';   
    $this->sub_title = '';

    return view('page.TambahImageProdukMitraVendor')->with([
        'page' => $this,
        'id_produk' => $id_produk,
        'jenis' => $jenis,
        'id_mitra' => $id_mitra
    ]);
  }

  public function StoreImageProduk(Request $request , $id){
    $dec = decrypt($id);
    $id_produk = $dec[1];
    $jenis = $dec[0];
    $id_mitra = $dec[2];

    if (!$request->imageOne) {
        $client = new \GuzzleHttp\Client();
        $result =  $client->request('POST', ENV('APP_URL_API')."ProdukMitdor/RemoveGambarProduk", [
            'form_params' => [
                'id_gambar' => $request->id,    
                'id_produk' => $id_produk,              
            ]
        ]);
        $responses = json_decode($result->getBody());

        $success_message = 
          array(
          'success' => 200,
          'filename' => 'sukses',
        );
    }else{
        $endpoint = "/file-submissions";
        $response = array();
        $file = $request->file('imageOne');
        $name = time() . '_' . $file->getClientOriginalName();
        $path = base_path() .'/public/images/produk/';
        $resource = fopen($file,"r") or die("File upload Problems");
        $file->move($path, $name);

        $client = new \GuzzleHttp\Client();
        $responsed = $client->request('POST', ENV('APP_URL_API').'ProdukMitdor/StoreGambarProduk', [
             'multipart' => [
                 [
                     'name'     => 'jenis_user',
                     'contents' => $jenis,
                 ],
                 [
                     'name'     => 'id_produk',
                     'contents' => $id_produk,
                 ],
                 [
                     'name'     => 'produk',
                     'contents' => file_get_contents($path . $name),
                     'filename' => $name
                 ],
             ]
         ]);
        $responsesImage = json_decode($responsed->getBody());
        unlink($path.'/'.$name);

        $success_message = 
          array(
          'success' => 200,
          'filename' => $responsesImage->error,
        );
    }
    return json_encode($success_message);
  }

  public function DetailProduk($id){
    $this->title = 'Detail Produk Mitra/Vendor';   
    $this->sub_title = '';

    $dec = decrypt($id);
    $id_produk = $dec[0];
    $id_mitra = $dec[1];

    $produk = json_decode(file_get_contents(ENV('APP_URL_API').'ProdukMitdor/DetailProduk/'.$id_produk));
    
    $pemesan = json_decode(file_get_contents(ENV('APP_URL_API').'order/pemesan'));
    
    return view('page.DetailProduk')->with([
        'page' => $this,
        'produk' => $produk->data[0],
        'image_produk' => $produk->data[0]->image,
        'id_produk' => $id_produk,
        'id_mitra' => $id_mitra,
        'pemesan' => $pemesan->data,
    ]);
  }

}
