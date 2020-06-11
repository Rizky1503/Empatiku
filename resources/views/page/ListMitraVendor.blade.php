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
		              <th scope="col">Mitra</th>
		              <th scope="col">Jumlah PIC</th>
		              <th scope="col">Berkas</th>
		              <th scope="col">Produk</th>
		              <th scope="col"></th>
		            </tr>
		          </thead>
		          <tbody>
		            
		          </tbody>
		          
		        </table>
		      </div>
		      <!-- /.card-body -->
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