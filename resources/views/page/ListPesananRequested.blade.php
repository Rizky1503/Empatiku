@extends('layout.index')

@section('content')
<section class="content">
	<div class="container">
		<div class="row">
		  <div class="col-12" >
		    <div class="card">
		      <div class="card-body">
		        <table  id="example" class="display nowrap" style="width:100%">
		          <thead>
		            <tr>
		              <th scope="col">No</th>
		              <th scope="col">Nama pemesan</th>
		              <th scope="col">No telpon</th>
		              <th scope="col">Alamat</th>
		              <th scope="col">Pesanan</th>
		              <th scope="col">Status</th>
		              <th scope="col"></th>
		            </tr>
		          </thead>
		          <tbody>
		           	@foreach($pemesan->data as $key =>$value)
		           		<tr>
		           			<td>{{ $key + 1 }}</td>
		           			<td>{{ $value->nama_pemesan }}</td>
		           			<td>{{ $value->no_telpon  }}</td>
		           			<td>{{ $value->alamat }}</td>
		           			<td>{{ $value->pesanan->count }}</td>
		           			<td>{{ $value->status }}</td>
		           			<td><a href="{{ route('Orderproduk.DetailPesanan',encrypt([ $value->id_pemesan ]))}}" class="btn btn-default">Lihat</a></td>
		           		</tr>
		           	@endforeach
		          </tbody>
		        </table>
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