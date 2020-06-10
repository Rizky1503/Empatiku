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

class HomeController extends BaseController
{
    public function index(){

    	$this->title = '';   
        $this->sub_title = '';
        return view('page.index')->with([
            'page' => $this
        ]);

    }

    public function TambahMitraVendor(){
    	$this->title = 'Tambah Mitra / Vendor';   
        $this->sub_title = '';

        $data_provinsi = json_decode(file_get_contents(ENV('APP_URL_API').'mitdor/get_provinsi'));

        return view('page.TambahMitraVendor')->with([
            'page' => $this,
            'provinsi' => $data_provinsi,
        ]);
    }

    public function TambahPicMitraVendor($id){
        $dec = decrypt($id);
        $id_mitra = $dec[0];
        $jenis = $dec[1];

        $this->title = 'Tambah Mitra / Vendor';   
        $this->sub_title = '';

        $data_provinsi = json_decode(file_get_contents(ENV('APP_URL_API').'mitdor/get_provinsi'));

        return view('page.TambahPicMitraVendor')->with([
            'page' => $this,
            'id_mitra' => $id_mitra,
            'jenis' => $jenis,
            'provinsi' => $data_provinsi,
        ]);
    }

     public function TambahBerkasMitraVendor($id){
        $dec = decrypt($id);
        $id_mitra = $dec[0];
        $jenis = 'Mitra';
        // $jenis = $dec[1];
        
        $this->title = 'Tambah Mitra / Vendor';   
        $this->sub_title = '';

        return view('page.TambahBerkasMitraVendor')->with([
            'page' => $this,
            'id_mitra' => $id_mitra,
            'jenis' => $jenis,

        ]);
    }

    public function getKota(Request $request){
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', ENV('APP_URL_API').'mitdor/get_kota', [
                'form_params'  => [
                    'provinsi'    => $request->provinsi,
                ]
        ]);
        $kota = json_decode($response->getBody());
        if ($request->id_kota) {
            foreach ($kota as $key => $value) {
                echo "<option value='".$value->kota."'  @if($value->kota == $request->id_kota ) selected='selected' @endif>".$value->kota."</option>";
            }
        }else{
            echo "<option value=''>--Pilih Kota--</option>";
            foreach ($kota as $key => $value) {
                echo "<option value='".$value->kota."'>".$value->kota."</option>";
            }
        }    
    }

    public function StoreMitdor(Request $request){
       $client = new \GuzzleHttp\Client();
       $response = $client->request('POST', ENV('APP_URL_API').'mitdor/StoreMitdor', [
               'form_params'  => [
                   'jenis_user' => $request->jenis_user,
                   'nama'       => $request->nama,
                   'email'      => $request->email,
                   'no_telp'    => $request->no_telp,
                   'alamat'     => $request->alamat,
                   'kota'       => $request->kota,
                   'provinsi'   => $request->provinsi,
               ]
       ]);
       $res = json_decode($response->getBody());

       if ($res->id == 'already exist') {
            Alert::error('Error Title', 'Error Message');
            return redirect()->route('MitraVendor.TambahMitraVendor');
       }else{
            return redirect()->route('MitraVendor.TambahPicMitraVendor',encrypt([$res->id,$request->jenis_user]));
       }
    }   

    public function StoreMitdorPIC(Request $request){
       $client = new \GuzzleHttp\Client();
       $response = $client->request('POST', ENV('APP_URL_API').'mitdor/StoreMitdorPic', [
               'form_params'  => [
                   'id_mitdor'   => $request->id_mitra,
                   'jenis_user' => $request->jenis,
                   'nama'       => $request->nama,
                   'email'      => $request->email,
                   'no_telp'    => $request->no_telp,
                   'alamat'     => $request->alamat,
                   'kota'       => $request->kota,
                   'provinsi'   => $request->provinsi,
                   'username'   => $request->username,
                   'password'   => $request->password,
               ]
       ]);
       $res = json_decode($response->getBody());

       if ($res->id == 'already exist') {
            Alert::error('Error Title', 'Error Message');
            return redirect()->route('MitraVendor.TambahPicMitraVendor');
       }else{
            return redirect()->route('MitraVendor.TambahBerkasMitraVendor',encrypt([$res->id,$request->jenis]));
       }
    }   

    public function StoreMitdorBerkas(Request $request){
        // return $request;    
        $endpoint_ktp = "/file-submissions";
        $response_ktp = array();
        $file_ktp = $request->file('ktp');
        $name_ktp = time() . '_' . $file_ktp->getClientOriginalName();
        $path_ktp = base_path() .'/public/images/berkas/ktp/';
        $resource_ktp = fopen($file_ktp,"r") or die("File upload Problems");
        $file_ktp->move($path_ktp, $name_ktp);

         $endpoint_npwp = "/file-submissions";
         $response_npwp = array();
         $file_npwp = $request->file('npwp');
         $name_npwp = time() . '_npwp_' . $file_npwp->getClientOriginalName();
         $path_npwp = base_path() .'/public/images/berkas/npwp/';
         $resource_npwp = fopen($file_npwp,"r") or die("File upload Problems");
         $file_npwp->move($path_npwp, $name_npwp);

         $client = new \GuzzleHttp\Client();
         $responsed = $client->request('POST', ENV('APP_URL_API').'mitdor/StoreMitdorBerkas', [
               'multipart' => [
                   [
                       'name'     => 'jenis_user',
                       'contents' => $request->jenis,
                   ],
                   [
                       'name'     => 'id_mitdor',
                       'contents' => $request->id_mitra,
                   ],
                   [
                       'name'     => 'ktp',
                       'contents' => file_get_contents($path_ktp . $name_ktp),
                       'filename' => $name_ktp
                   ],
                   [
                       'name'     => 'npwp',
                       'contents' => file_get_contents($path_npwp . $name_npwp),
                       'filename' => $name_npwp
                   ],
               ]
           ]);
     return redirect()->route('MitraVendor.TambahPicMitraVendor');
    }


    
}
