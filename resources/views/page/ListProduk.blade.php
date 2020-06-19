@extends('layout.index')

@section('content')
<section class="content">
	<div class="container">
		<div class="row">
			@foreach($produk as $key => $value)
			    <div class="col-3" >
				    <div class="card">
				      <div class="card-body">
				        <a href="{{ route('ProdukMitraVendor.DetailProduk',encrypt([$value->id_produk,$value->id_mitra])) }}">
				        	<p style="color: black; font-size: 20px;">{{$value->nama_produk}}</p>
				        	<div style="height: 206px;">
				        		<img class="image" src="{{ ENV('APP_URL_API').'image/file/produk/'.$value->image->gambar_produk }}">
				        	</div><br>
				        	<center><p style="color: black;">Rp {{number_format($value->harga,0,',','.') }}</p></center>
				        	<a href="{{ route('ProdukMitraVendor.DetailProduk',encrypt([$value->id_produk,$value->id_mitra])) }}" class="form-control btn btn-success">Pesan</a>
				        </a>
				      </div>
				    </div>
			    </div>
			@endforeach
		</div>
	</div>	
</section>
@endsection

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<style type="text/css">
	.image{
		width: 98%;
	}
</style>