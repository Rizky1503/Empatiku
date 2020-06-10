@extends('layout.index')

@section('content')

<div class="container"> 
	<div class="row">
		<div class="col-md-12">
			<div class="card card-info">
				<div class="card-header">
				  <h3 class="card-title">Data PIC</h3>
				</div>
				<form action="{{ route('MitraVendor.StoreMitdorPIC') }}" method="get">
					<div class="card-body">
						<div class="row"> 
							<input type="hidden" name="id_mitra" value="{{$id_mitra}}">
							<input type="hidden" name="jenis" value="{{$jenis}}">
							<div class="col-md-6">
								<div class="form-group">
			                        <label>Nama PIC</label>
			                        <input type="text" class="form-control" required="required" name="nama" placeholder="PT. Duka Bersama">
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
			                        <label>E-mail</label>
			                        <input type="email" class="form-control" required="required" name="email" placeholder="NoelMatondang@gmail.com">
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
			                        <label>No telpon</label>
			                        <input type="text" name="telp" required="required" onkeypress="return hanyaAngka(event)" class="form-control" placeholder="0812989122">
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
			                        <label>Alamat</label>
			                        <textarea class="form-control" required="required" name="alamat" rows="1"></textarea>
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Provinsi Kelahiran</label>
									<select class="form-control select2bs4" required name="provinsi" id="provinsi" onchange="getkota(this.value)" style="width: 100%;">
									  <option value="">--Pilih Provinsi--</option>
									  @foreach($provinsi as $key => $value)
									 	<option value="{{ $value->provinsi }}">{{ $value->provinsi }}</option>
									  @endforeach
									</select>
								</div>
							</div>	
							<div class="col-md-6">
								<div class="form-group">
									<label>Kota Kelahiran</label>
									<select class="form-control select2bs4" required name="kota" id="kota" style="width: 100%;">
									  <option value="">--Pilih Kota--</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" placeholder="EmPatiKu">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Password</label>
									<input type="password" placeholder="******" minlength="6" name="password" class="form-control">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<button class="form-control btn btn-success">Selanjutnya</button>
			                    </div>
							</div>
						</div>
					</div>	
				</form>
			</div>	
		</div>
	</div>
</div>

@endsection

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
	function hanyaAngka(evt) {
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	 
	    return false;
	    return true;
	}

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