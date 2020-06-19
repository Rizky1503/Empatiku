@extends('layout.index')

@section('content')
<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12" id="edit">
			    <div class="card">
			        <div class="card-body"><h5>Detail Mitra / Vendor : </h5><hr>
			          <div class = "row">
				          <div class="position-relative form-group col-md-6">
				              <label for="exampleEmail" class="">Mitra</label>
				              <input name="nama" readonly  placeholder="" type="text" form-control value="{{$data->nama}}" class="form-control">
				          </div>

				          <div class="position-relative form-group col-md-6">
				              <label for="exampleEmail" class="">email</label>
				              <input name="alamat" readonly  placeholder="" type="text" form-control value="{{$data->email}}" class="form-control">
				          </div>

				          <div class="position-relative form-group col-md-6">
				              <label for="exampleEmail" class="">No Telpon</label>
				              <input name="no_telpon" readonly placeholder="" type="text" form-control value="{{$data->no_telp}}" class="form-control">
				          </div>

				          <div class="position-relative form-group col-md-6">
				              <label for="exampleEmail" class="">Alamat</label>
				              <input name="no_telpon" readonly placeholder="" type="text" form-control value="{{ $data->alamat }}" class="form-control">
				          </div>

				          <div class="position-relative form-group col-md-6">
				              <label for="exampleEmail" class="">Provinsi</label>
				              <input name="no_telpon" readonly placeholder="" type="text" form-control value="{{$data->provinsi}}" class="form-control">
				          </div>

				          <div class="position-relative form-group col-md-6">
				              <label for="exampleEmail" class="">Kota</label>
				              <input name="no_telpon" readonly placeholder="" type="text" form-control value="{{ $data->kota}}" class="form-control">
				          </div>

				          <button class="btn btn-warning" onclick="update()">Edit</button>
			          </div>
			        </div>
		    	</div>
	    	</div>
	    	<div class="col-md-12" id="update" style="display: none">
			    <div class="card">
			        <div class="card-body"><h5>Detail Mitra / Vendor : </h5><hr>
			          <form method="get" action="{{ route('ViewMitraVendor.update') }}">
				          <div class = "row">
				          	  <input type="hidden" name="id_mitdor" value="{{$data->id_mitra}}">
					          <div class="position-relative form-group col-md-6">
					              <label for="exampleEmail" class="">Mitra</label>
					              <input name="nama"  placeholder="" type="text" form-control value="{{$data->nama}}" class="form-control">
					          </div>

					          <div class="position-relative form-group col-md-6">
					              <label for="exampleEmail" class="">email</label>
					              <input name="email" readonly="" placeholder="" type="text" form-control value="{{$data->email}}" class="form-control">
					          </div>

					          <div class="position-relative form-group col-md-6">
					              <label for="exampleEmail" class="">No Telpon</label>
					              <input name="no_telpon" placeholder="" type="text" form-control value="{{$data->no_telp}}" class="form-control">
					          </div>

					          <div class="position-relative form-group col-md-6">
					              <label for="exampleEmail" class="">Alamat</label>
					              <input name="alamat" placeholder="" type="text" form-control value="{{ $data->alamat }}" class="form-control">
					          </div>

					          <div class="position-relative form-group col-md-6">
					              <label for="exampleEmail" class="">Provinsi</label>
					              <select class="form-control level" required name="provinsi" id="provinsi" onchange="getkota(this.value)" style="width: 100%;">
									  <option value="{{$data->provinsi}}">{{$data->provinsi}}</option>
									  @foreach($provinsi as $key => $value)
									 	<option value="{{ $value->provinsi }}">{{ $value->provinsi }}</option>
									  @endforeach
									</select>
					          </div>

					          <div class="position-relative form-group col-md-6">
					              <label for="exampleEmail" class="">Kota</label>
					              <select class="form-control level" required name="kota" id="kota" style="width: 100%;">
									 <option value="{{ $data->kota }}">{{ $data->kota }}</option>
								   </select>
					          </div>

					          <button class="btn btn-success">update</button>
					          <a class="btn btn-danger" style="position:relative; left: 6px; color: white;" onclick="edit()">Cancel</a>
				          </div>
			          </form>
			        </div>
		    	</div>
	    	</div>
	    	@if($data->berkas)
	    	<div class="col-md-12" >
			    <div class="card">
			        <div class="card-body"><h5>Detail berkas Mitra / Vendor : </h5><hr>
			          <div class = "row">
				          <div class="position-relative form-group col-md-6">
				          	  <label>KTP  &nbsp;: </label>
				              <img style="width: 70%" src="{{ ENV('APP_URL_API').'image/file/KTP/'.$data->berkas->ktp }}">
				          </div>

				          <div class="position-relative form-group col-md-6">
				          	  <label>NPWP : </label>
				              <img style="width: 70%" src="{{ ENV('APP_URL_API').'image/file/NPWP/'.$data->berkas->npwp }}">
				          </div>
			          </div>
			        </div>
		    	</div>
	    	</div>
	    	@else
	    	<div class="col-md-12" >
			    <div class="card">
			        <div class="card-body"><h5>Detail berkas Mitra / Vendor : </h5><hr>
			          <div class = "row">
				          <div class="position-relative form-group col-md-6">
				              <a class="btn btn-danger" href="{{ route('MitraVendor.TambahBerkasMitraVendor',encrypt([$data->id_mitra,$data->jenis])) }}">Lengkapi Berkas</a>
				          </div>
			          </div>
			        </div>
		    	</div>
	    	</div>
	    	@endif
    	  	<div class="col-12" >
    	    	<div class="card">
	    	      <div class="card-body">
	    	        <table  id="example" class="display nowrap" style="width:100%">
	    	          <thead>
	    	            <tr>
	    	              <th scope="col">No</th>
	    	              <th scope="col">nama</th>
	    	              <th scope="col">Email</th>
	    	              <th scope="col">No. Telpon</th>
	    	              <th scope="col">Alamat</th>
	    	              <th scope="col">Provinsi</th>
	    	              <th scope="col">Kota</th>
	    	              <th scope="col"></th>
	    	            </tr>
	    	          </thead>
	    	          <tbody>
	    	            @foreach($data->pic as $key => $value)
	    	            	<tr>	
		    	           	  <td>{{ $key + 1}}</td>
		    	           	  <td>{{ $value->nama }}</td>
		    	           	  <td>{{ $value->email}}</td>
		    	           	  <td>{{ $value->no_telp}}</td>
		    	           	  <td>{{ $value->alamat}}</td>
		    	           	  <td>{{ $value->provinsi}}</td>
		    	           	  <td>{{ $value->kota}}</td>
		    	           	  <td>
		    	           	  </td>
	    	            	</tr>
	    	            @endforeach
	    	          </tbody>
	    	        </table>
	    	        <a class="btn btn-default" href="{{ route('MitraVendor.TambahPicMitraVendor',encrypt([$data->id_mitra,$data->jenis,'next'])) }}">Tambah PIC</a>
	    	      </div>
	    	    </div>
	    	</div>
	    	<div class="col-12" >
    	    	<div class="card">
	    	      <div class="card-body">
	    	        <table  id="produk" class="display nowrap" style="width:100%">
	    	          <thead>
	    	            <tr>
	    	              <th scope="col">No</th>
	    	              <th scope="col">nama Produk</th>
	    	              <th scope="col">Jumlah</th>
	    	              <th scope="col">Harga</th>
	    	              <th scope="col">Deskripsi</th>
	    	              <th scope="col">Kategori</th>
	    	              <th scope="col">Sub Kategori</th>
	    	              <th scope="col"></th>
	    	            </tr>
	    	          </thead>
	    	          <tbody>
	    	            @foreach($data->produk as $key => $value)
	    	            	<tr>	
		    	           		<td>{{ $key + 1 }}</td>
		    	           		<td>{{ $value->nama_produk }}</td>
		    	           		<td>{{ $value->jumlah }}</td>
		    	           		<td>{{ $value->harga }}</td>
		    	           		<td>{{ $value->deskripsi }}</td>
		    	           		<td>{{ $value->kategori }}</td>
		    	           		<td>{{ $value->sub_kategori }}</td>
		    	           		<td>
		    	           			<a href="{{ route('ProdukMitraVendor.DetailProduk',encrypt([$value->id_produk,$data->id_mitra])) }}" class="btn btn-default">Lihat</a>
		    	           		</td>
	    	            	</tr>
	    	            @endforeach
	    	          </tbody>
	    	        </table>
	    	        <a class="btn btn-default" href="{{ route('ProdukMitraVendor.produk',encrypt([$data->id_mitra,$data->jenis,'next'])) }}">Tambah Produk</a>
	    	      </div>
	    	    </div>
	    	</div>
		</div>
	</div>	
</section>
@endsection

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true
    } );

    $('#produk').DataTable( {
        "scrollX": true
    } );

    $(".level").select2({
	  tags: true,
	  theme: 'bootstrap4'
	});

	$('.select2bs4').select2({
	  theme: 'bootstrap4'
	})

});

function getkota(val){
	$.ajax({
	  type: "GET",
	  url: '{{ route("MitraVendor.getKota")}}',
	  data: {
	    provinsi : $('#provinsi').val(),
	  },
	  success: function(responses){  
	  	$('#kota').html(responses);  
	  }
	});
}

function edit(){
    $("#edit").show();
    $("#update").hide();
} 

function update(){
    $("#edit").hide();
    $("#update").show();
} 




</script>

<style type="text/css">
  div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>