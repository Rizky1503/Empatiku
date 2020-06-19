@extends('layout.index')

@section('content')

<script src="{!! asset('public\assets\dropzone/dist/dropzone.js') !!}"></script>
<link rel="stylesheet" href="{!! asset('public\assets\dropzone/dist/dropzone.css') !!}">

<section class="content">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="m-dropzone dropzone m-dropzone--primary" id="m_dropzone_one">
					<div class="m-dropzone__msg dz-message needsclick">
						<h3 class="m-dropzone__msg-title">
							Unggah gambar kamu disini.
						</h3>
						<span class="m-dropzone__msg-desc">
							Klik atau tarik gambar kesini untuk mengunggah 
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<br><a href="{{ route('ViewMitraVendor.detail',$id_mitra) }}" class="btn btn-success form-control">Simpan</a>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	var myDropzone = new Dropzone("div#m_dropzone_one", {
		url: "{{ route('Produk.Image.StoreImageProduk',encrypt([$jenis,$id_produk,$id_mitra])) }}",
	 	method: 'POST',
	 	autoProcessQueue: true, 
	 	maxFilesize: 2, //mb
	 	paramName: "imageOne",
	 	acceptedFiles: "image/*",
	 	maxFiles: 5,
	 	parallelUploads: 5,  
	   	init: function() {
	       	myDropzone = this;      
	       	this.on("queuecomplete", function(file, response) {
	       		console.log('succsess')
	       	});
	   	}, 
	   	addRemoveLinks: true,
	   	removedfile: function(file, response ) {
	 		obj = JSON.parse(file.xhr.responseText);
	 		var name = file.name;  
		    $.ajax({
		        type: 'POST',
		        url: "{{ route('Produk.Image.StoreImageProduk',encrypt([$jenis,$id_produk,$id_mitra])) }}",
		        data: "id="+obj.filename,
		        dataType: 'html'
		    });
		    var _ref;
		    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0; 		
		},
	});
</script>

<style type="text/css">
	.dropzone {
	    border: 2px dashed #0087F7;
	    border-radius: 5px;
	    background: white;
	}


</style>

@endsection

