@extends('layout.index')

@section('content')

@if($jenis == 'Mitra')
<div class="container"> 
	<div class="row">
		<div class="col-md-12">
			<div class="card card-info">
				<div class="card-header">
				  <h3 class="card-title">Data Berkas</h3>
				</div>
				<form action="{{ route('MitraVendor.StoreMitdorBerkas') }}" method="post" enctype="multipart/form-data">@csrf
					<div class="card-body">
						<div class="row"> 
							<input type="hidden" name="id_mitra" value="{{$id_mitra}}">
							<input type="hidden" name="jenis" value="{{$jenis}}">
							<div class="col-md-6">
								<div class="form-group">
			                    <label for="exampleInputFile">KTP PIC</label>
			                    <div class="input-group">
			                      <div class="custom-file">
			                        <input type="file" name="ktp" class="custom-file-input" id="exampleInputFile">
			                        <label class="custom-file-label" for="exampleInputFile"></label>
			                      </div>
			                    </div>
			                  </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
			                    <label for="exampleInputFile">NPWP</label>
			                    <div class="input-group">
			                      <div class="custom-file">
			                        <input type="file" name="npwp" class="custom-file-input" id="exampleInputFile">
			                        <label class="custom-file-label" for="exampleInputFile"></label>
			                      </div>
			                    </div>
			                  </div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<button class="form-control btn btn-success">Simpan</button>
			                    </div>
							</div>
						</div>
					</div>	
				</form>
			</div>	
		</div>
	</div>
</div>
@else
<div class="container"> 
	<div class="row">
		<div class="col-md-12">
			<div class="card card-info">
				<div class="card-header">
				  <h3 class="card-title">Data Berkas</h3>
				</div>
				<form action="{{ route('MitraVendor.StoreMitdorBerkas') }}" method="post" enctype="multipart/form-data">@csrf
					<div class="card-body">
						<input type="hidden" name="id_mitra" value="{{$id_mitra}}">
						<input type="hidden" name="jenis" value="{{$jenis}}">
						<div class="row"> 
							<div class="col-md-6">
								<div class="form-group">
			                    <label for="exampleInputFile">KTP</label>
			                    <div class="input-group">
			                      <div class="custom-file">
			                        <input type="file" name="ktp" class="custom-file-input" id="exampleInputFile">
			                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
			                      </div>
			                    </div>
			                  </div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<button class="form-control btn btn-success">Simpan</button>
			                    </div>
							</div>
						</div>
					</div>	
				</form>
			</div>	
		</div>
	</div>
</div>
@endif

@endsection

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
	function hanyaAngka(evt) {
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	 
	    return false;
	    return true;
	}

	$(function (){
		$('.select2bs4').select2({
		  theme: 'bootstrap4'
		})

		$(".level").select2({
		  tags: true,
		  theme: 'bootstrap4'
		});
	})
</script>