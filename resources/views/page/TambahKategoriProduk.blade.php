@extends('layout.index')

@section('content')

<section class="content">
  <div class="container">
    <div class="row">
      <div class="col-12" >
        <div class="card">
          <div class="card-body">
            <div style="float: right;">
              <button class="btn btn-info" data-toggle="modal" data-target="#modal-default">Tambah Kategori</button>
            </div><br><br>
            <table  id="example" class="display nowrap" style="width:100%">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Sub Kategori</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $value->kategori }}</td>
                  <td>{{ $value->sub_kategori }}</td>
                  <td><center><a data-toggle="modal" data-target="#modal-edit" onclick="setkategori('{{$value->kategori}}','{{$value->sub_kategori}}','{{$value->id_kategori}}')" style="cursor: pointer; color: white;" class="btn btn-info"><i class="fas fa-eye"></i></a></center></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Tambah Kategori</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Kategori</label>
              <input type="text" id="kategori"  class="form-control" name="">
            </div>
            <div class="form-group">
              <label>Sub Kategori</label>
              <input type="text" id="sub_kategori"  class="form-control" name="">
            </div>
            <input type="hidden" id="id_kategori" value="">
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            <button type="button" class="btn btn-primary btn btn-success" onclick="storekategori()">Simpan</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Marga</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Kategori</label>
              <input type="text" id="kategori_edit"  class="form-control" name="">
            </div>
            <div class="form-group">
              <label>Sub Kategori</label>
              <input type="text" id="sub_kategori_edit"  class="form-control" name="">
            </div>
          </div>
          <input type="hidden" id="id_marga_update" value="">
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            <button type="button" class="btn btn-primary btn btn-success" onclick="updatekategori()">Update</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<script>
  function storekategori(){
    if( $('#kategori').val() == '' &&  $('#sub_kategori').val() == '' ){
      alert('Isi Form Terlebih Dahulu')
    }else{
      $.ajax({
        type: "GET",
        url: '{{ route("ProdukMitraVendor.StoreKategori")}}',
        data: {
            kategori      : $('#kategori').val(),
            sub_kategori  : $('#sub_kategori').val()
        },
        success: function(responses){  
          location.reload()
        }
      });
    }
  }

  function setkategori(kategori,sub_kategori,id_kategori){
    $('#kategori_edit').val(kategori)
    $('#sub_kategori_edit').val(sub_kategori)
    $('#id_kategori').val(id_kategori)
  }

  function updatekategori(){
    if( $('#kategori_edit').val() == '' &&  $('#sub_kategori_edit').val() == '' ){
      alert('Isi Form Terlebih Dahulu')
    }else{
      $.ajax({
        type: "GET",
        url: '{{ route("ProdukMitraVendor.UpdateKategori")}}',
        data: {
            kategori      : $('#kategori_edit').val(),
            sub_kategori  : $('#sub_kategori_edit').val(),
            id_kategori   : $('#id_kategori').val()
        },
        success: function(responses){  
          location.reload()
        }
      });
    }
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

  });

</script>

<style type="text/css">
  div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>