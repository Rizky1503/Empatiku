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

class ViewMitdorController extends BaseController
{
    
  public function index(){
      $this->title = 'List Mitra/Vendor';   
        $this->sub_title = '';

        $ListMitdor = json_decode(file_get_contents(ENV('APP_URL_API').'ListMitdor/list'));

        return view('page.ListMitraVendor')->with([
            'page' => $this,
            'list' => $ListMitdor,
        ]);
  }

  public function detail($id){
      $this->title = 'Detail Mitra/Vendor';   
      $this->sub_title = '';

      $data_provinsi = json_decode(file_get_contents(ENV('APP_URL_API').'mitdor/get_provinsi'));
      $data = json_decode(file_get_contents(ENV('APP_URL_API').'ListMitdor/detail/'.$id));

      return view('page.DetailMitraVendor')->with([
          'page' => $this,
          'data' => $data[0],
          'provinsi' => $data_provinsi,
      ]);
  }

  public function update(Request $request){
    return $request;
  }

}
