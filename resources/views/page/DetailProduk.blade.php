@extends('layout.index')

@section('content')
<section class="content">
  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3 class="d-inline-block d-sm-none"></h3>
          <div class="col-12">
            <img src="{{ ENV('APP_URL_API').'image/file/produk/'.$image_produk[0]->gambar_produk }}" class="product-image" alt="Product Image">
          </div>
          <div class="col-12 product-image-thumbs">
            @foreach( $image_produk as $key => $gambar)
              @if($key == 0)
                <div class="product-image-thumb active"><img src="{{ ENV('APP_URL_API').'image/file/produk/'.$gambar->gambar_produk }}" alt="Product Image"></div>
              @else
                <div class="product-image-thumb"><img src="{{ ENV('APP_URL_API').'image/file/produk/'.$gambar->gambar_produk }}" alt="Product Image"></div>
              @endif
            @endforeach
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <h3 class="my-3">{{ $produk->nama_produk}}</h3><span>{{ $produk->kategori }} - {{ $produk->sub_kategori }}</span>
            <p>{!! $produk->deskripsi !!}</p>
          <hr>
        
          <h3>Stock Tersedia {{ $produk->jumlah }}</h3>        
          <hr>
          <div class="bg-blue py-2 px-3 mt-4" style="border-radius: 6px;">
            <h2 class="mb-0">
              Rp {{number_format($produk->harga,0,',','.') }}
            </h2>
          </div>

          <div class="row">
            @if($produk->jumlah >= 1)
              <div class="col-md-6">
                <div class="mt-4">
                  <div class="btn btn-primary btn-lg btn-flat" style="border-radius: 6px;" data-toggle="modal" data-target="#modal-default">
                    <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                    Pesan
                  </div>
                </div>
              </div>
            @else
              <div class="col-md-6">
                <div class="mt-4">
                  <div class="btn btn-secondary btn-lg btn-flat" style="border-radius: 6px;">
                    <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                    Pesan
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Data Pemesan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="Pemesan_tersedia" style="display: block;">
            <div class="form-group">
              <label>Nama Pemesan Yang Sedang Request</label>
              <select class="form-control level" id="id_pemesan" style="width: 100%;">
                <option>--Nama Pemesan--</option>
                @foreach($pemesan as $key => $value)
                  <option value="{{ $value->id_pemesan }}">{{ $value->nama_pemesan }}</option>
                @endforeach
              <select>  
            </div>
          </div>
          <div class="pemesan_baru" style="display: none;">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" id="nama_pemesan" class="form-control" placeholder="Renata">
            </div>
            <div class="form-group">
              <label>No telpon</label>
              <input type="text" id="no_telp_pemesan" onkeypress="return hanyaAngka(event)" placeholder="08125346271" class="form-control">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text"id="alamat_pemesan" class="form-control" placeholder="jalan kanjeng no.2">
            </div>
          </div>
          <div class="form-group">
            <input type="checkbox" class="form-check-input" id="jenis_pemesan" onclick="jenis_pemesan()" style="display: block; left: 40px;">
            <label class="form-check-label" for="exampleCheck1" style="position: relative; left: 23px;">Data Pemesan Baru</label>
          </div>
          <div class="form-group">
            <label>Jumlah Tersedia : {{ $produk->jumlah }}</label>
            <input type="number" placeholder="Jumlah pesanan" min="1" max="{{ $produk->jumlah }}" oninput="validity.valid||(value='');" style="height: 48px;" class="form-control" id="qty">
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea class="form-control" placeholder="Jika ada pesanan khusus" id="deskripsi" name="deskripsi"></textarea>
          </div>
          <input type="hidden" id="id_produk" value="{{ encrypt($id_produk) }}">
          <input type="hidden" id="id_mitra" value="{{ encrypt($id_mitra) }}">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
          <button type="button" class="btn btn-primary btn btn-success" onclick="order()">Simpan</button>
        </div>
      </div>
    </div>
  </div>

</section>

@endsection

<script src="{{ asset('public/theme/plugins/jquery/jquery.min.js')}}"></script>

<script type="text/javascript">
  
  function jenis_pemesan(){
    var checkBox = document.getElementById("jenis_pemesan");
    if (checkBox.checked == true){
      $('.pemesan_baru').show()
      $('.Pemesan_tersedia').hide()
    }else{
      $('.pemesan_baru').hide()
      $('.Pemesan_tersedia').show()
    }
  }

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

  function order(){
    if ( $('#nama').val() == '' && $('#no_telp').val() == '' &&  $('#alamat').val() == '' && $('#qty').val() == '') {
      alert('Silahkan Lengkapi Data Pemesan Terlebih Dahulu');
    }else{
      $.ajax({
          type: "GET",
          url: '{{ route("Orderproduk.OrderProduk")}}',
          data: {
            nama_pemesan    : $('#nama_pemesan').val(),
            no_telp_pemesan : $('#no_telp_pemesan').val(),
            alamat          : $('#alamat_pemesan').val(),
            deskripsi       : $('#deskripsi').val(),
            id_produk       : $('#id_produk').val(),
            id_mitra        : $('#id_mitra').val(),
            jumlah          : $('#qty').val(),
            id_pemesan      : $('#id_pemesan').val(),
          },
          success: function(responses){  
            window.location.href = '{{route("Orderproduk.LihatPesanan")}}'
          }
        });
    }
  }
</script>

<style type="text/css">
 
</style>