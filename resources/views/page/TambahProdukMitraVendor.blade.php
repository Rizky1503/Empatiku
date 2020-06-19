@extends('layout.index')

@section('content')

<script src="{!! asset('public\assets\dropzone/dist/dropzone.js') !!}"></script>
<script src="{!! asset('ublic/theme/plugins/summernote/summernote-bs4.min.js') !!}"></script>

<link rel="stylesheet" href="{!! asset('public\assets\dropzone/dist/dropzone.css') !!}">
<link rel="stylesheet" href="{!! asset('public/theme/plugins/summernote/summernote-bs4.css') !!}">

<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<form action="{{ route('ProdukMitraVendor.StoreProduk') }}" method="GET">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Nama Produk</label>
										<input type="text" class="form-control" name="nama_produk">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Jumlah Produk</label>
										<input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="jumlah_produk">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Harga</label>
										<input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="harga">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Kategori</label>
										<select class="form-control level" required name="kategori" id="kategori" style="width: 100%;" onchange="getsubkategori()">
										  <option value="">--Pilih Kategori--</option>
										  @foreach($kategori->data as $key => $data)
										  	<option value="{{ $data->kategori }}">{{ $data->kategori }}</option>
										  @endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Sub Kategori</label>
										<select class="form-control level" required name="sub_kategori" id="sub_kategori" style="width: 100%;">
											 <option value="">--Pilih Sub Kategori--</option>
										</select>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Deskripsi</label>
										<textarea class="textarea" name="deskripsi" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
										</textarea>
									</div>
								</div>
								<input type="hidden" name="id_mitra" value="{{ $id_mitra }}">
								<input type="hidden" name="jenis" value="{{ $jenis }}">
								<div class="col-md-12">
									<button class="form-control btn btn-success">Selanjutnya</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<style type="text/css">
	.dropzone {
	    border: 2px dashed #0087F7;
	    border-radius: 5px;
	    background: white;
	}
</style>

<script>
  $(function () {
    $('.textarea').summernote()

    $(".level").select2({
      tags: true,
      theme: 'bootstrap4'
    });

  })

  function getsubkategori(){
  	$.ajax({
	  type: "GET",
	  url: '{{ route("ProdukMitraVendor.GetSubKategori")}}',
	  data: {
	    kategori : $('#kategori').val(),
	  },
	  success: function(responses){  
	  	$('#sub_kategori').html(responses);  
	  }
	});
  }

  function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
   
      return false;
      return true;
  }
</script>

@endsection

