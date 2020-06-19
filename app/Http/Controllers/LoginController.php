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

class LoginController extends BaseController
{
  public function login(){
    return view('login.login');
  }

  public function loginApi(Request $request){
    $client = new \GuzzleHttp\Client();            
    $response = $client->request('POST', ENV('APP_URL_API').'login/login', [
        'form_params'   => [
            'email'  => $request->username,
            'password'  => $request->password,
        ]
    ]);
    $responses = json_decode($response->getBody());
    // dd($responses);
    if ($responses->status == "true Mitra") {
        Session::put('id_username_token',$responses->data->nama);
        Session::put('id_member_token',$responses->data->id_mitra);
        Session::put('id_member_status','Mitra');
        Session::put('login',TRUE);
        return redirect()->route('Home.home');
    }else if ($responses->status == "true Vendor") {
        Session::put('id_username_token',$responses->data->nama);
        Session::put('id_member_token',$responses->data->id_vendor);
        Session::put('id_member_status','Vendor');
        Session::put('login',TRUE);
        return redirect()->route('Home.home');
    }else if ($responses->status == "true Admin"){
        Session::put('id_username_token','Admin');
        Session::put('id_member_status','Admin');
        Session::put('login',TRUE);
        return redirect()->route('Home.home');
    }else{
        return redirect()->route('Home.index')->with('alert','Login Gagal, pastikan Email dan Password sesuai');
    }
  }

  public function logout (){
    Session::flush();
    return redirect()->route('Home.index')->with('alert','Anda berhasil logout');
  }

}
