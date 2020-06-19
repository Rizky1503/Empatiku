@extends('layout.index')

@section('content')
<section class="content">
	<div class="container">
		<div class="row">
		  <div class="col-12" >
		  	@if( $pesanan->pemesan->status == 'DP')
		  	<p>Id Invoice : {{$pesanan->deal->id_inv}}</p>
		  	@endif
		  	<p>Nama Pemesan: {{$pesanan->pemesan->nama_pemesan}}</p>
		  	<p>Alamat: {{$pesanan->pemesan->alamat}}</p>
		  	<p>No Telpon: {{$pesanan->pemesan->no_telpon}}</p>
		    <div class="card">
		      <div class="card-body">
		        <table  id="example" class="display nowrap" style="width:100%">
		          <thead>
		            <tr>
		              <th scope="col">No</th>
		              <th scope="col">Produk</th>
		              <th scope="col">Mitra</th>
		              <th scope="col">No telpon mitra</th>
		              <th scope="col">harga</th>
		              <th scope="col">deskripsi</th>
		              <th scope="col">Jumlah</th>
		              <th scope="col">Sub Total</th>
		              @if( $pesanan->pemesan->status != 'Requested')
		              <th scope="col"></th>
		              @endif
		            </tr>
		          </thead>
		          <tbody>
		          	<?php 
		          		$hasil = 0;
		          	?>
		           	@foreach($pesanan->data as $key =>$value)
		           		<tr>
		           			<td>{{ $key + 1 }}</td>
		           			<td>{{ $value->nama_produk }}</td>
		           			<td>{{ $value->nama  }}</td>
		           			<td>{{ $value->no_telp }}</td>
		           			<td>Rp {{number_format($value->harga,0,',','.') }}</td>
		           			<td>{{ $value->desc }}</td>
		           			<td>{{ $value->jumlah }}</td>
		           			<td>Rp {{number_format($value->jumlah * $value->harga,0,',','.') }}</td>
		           			@if($pesanan->pemesan->status == 'Requested')
		           			<td><a href="{{ route('Orderproduk.BatalkanPesanan',encrypt([$value->id_produk,$pesanan->pemesan->id_pemesan]))}}" class="btn btn-danger">Batal</a></td>
		           			@endif
		           		</tr>
		           		<?php
		           			$hasil += $value->jumlah * $value->harga;
		           		?>
		           	@endforeach
		           	
		           	@if($pesanan->pemesan->status == 'Requested')
		           	<tr>
		           		<td colspan="8"  align="right"><b>Total :</b></td>
		           		<td colspan="1"><b>Rp {{number_format($hasil,0,',','.') }}</b></td>
		           	</tr>
		           	@elseif($pesanan->pemesan->status == 'DP')
		           	<tr>
		           		<td colspan="7"  align="right"><b>Total :</b></td>
		           		<td colspan="1"><b>Rp {{number_format($hasil,0,',','.') }}</b></td>
		           	</tr>
		           	<tr>
		           		<td colspan="7"  align="right"><b>Dp :</b></td>
		           		<td colspan="1"><b>Rp {{number_format($pesanan->deal->dp,0,',','.') }}</b></td>
		           	</tr>
		           	<tr>
		           		<td colspan="7"  align="right"><b>Sisa :</b></td>
		           		<td colspan="1"><b>Rp - {{number_format($pesanan->deal->pelunasan,0,',','.') }}</b></td>
		           	</tr>
		           	@else
		           	<tr>
		           		<td colspan="7"  align="right"><b>Total :</b></td>
		           		<td colspan="1"><b>Rp {{number_format($hasil,0,',','.') }}</b></td>
		           	</tr>
		           	@endif
		          </tbody>
		        </table><br>
		        @if( $pesanan->pemesan->status == 'Requested')
		        <div style="float: right;">
			        <span>Masukan Jumlah DP : </span>
			        <input onkeypress="return hanyaAngka(event)" type="text" id="dp"  class="form_control">
			        <input type="hidden" id="id_pemesan" value="{{$pesanan->pemesan->id_pemesan}}"  class="form_control">
			        <input type="hidden" id="total" value="{{$hasil}}"  class="form_control">
			        <button class="btn btn-success" onclick="deal()">Bayarkan DP</button>
		        </div>
		        @elseif($pesanan->pemesan->status == 'DP')
		        <div style="float: right;">
		        	<input type="hidden" id="id_pemesan" value="{{$pesanan->pemesan->id_pemesan}}"  class="form_control">
		        	<button class="btn btn-success" onclick="lunas()">Melunasi</button>
		        </div>
		        @endif
		      </div>
		    </div>
		  </div>
		</div>
	</div>	
</section>
@endsection

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript">
function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

  return false;
  return true;
}

function deal(){
	$.ajax({
    type: "GET",
    url: '{{ route("Orderproduk.DealPesanan")}}',
    data: {
      id_pemesan    : $('#id_pemesan').val(),
      total 	    : $('#total').val(),
      dp            : $('#dp').val(),
    },
    success: function(responses){  
      location.reload()
    }
  });
}

function lunas(){
	$.ajax({
    type: "GET",
    url: '{{ route("Orderproduk.LunasiPesanan")}}',
    data: {
      id_pemesan    : $('#id_pemesan').val(),
    },
    success: function(responses){  
      location.reload()
    }
  });
}

$(document).ready(function() {
    $('#example').DataTable( {
        "scrollX": true
    } );

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        icon: 'success',
        title: 'Status Member Berhasil Dirubah'
      })
    });
  } );

</script>

<style type="text/css">
  div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>