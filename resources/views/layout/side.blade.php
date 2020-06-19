<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <center><span style="font-size: 30px;" class="brand-text font-weight-light"><b>EmpatiKu</b></span></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="#" class="d-block">{{ Session::get('id_username_token') }}</a>
        </div>
      </div>

      @if(Session::get('id_member_status') == 'Admin' )
      <!-- Sidebar Menu --><nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-header">MITRA / VENDOR</li>
          <li class="nav-item">
            <a href="{{ route('ViewMitraVendor.index')}}" class="nav-link">
              <i class="nav-icon fa fa-eye"></i>
              <p>
                Lihat Mitra / Vendor
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{ route ('MitraVendor.TambahMitraVendor') }}" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Tambah Mitra / vendor
              </p>
            </a>
          </li>
          <li class="nav-header">PRODUK</li>
          <li class="nav-item">
            <a href="{{ route ('ProdukMitraVendor.TambahKategori') }}" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Kategori Produk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route ('Orderproduk.LihatPesanan') }}" class="nav-link">
              <i class="nav-icon fas fa-eye"></i>
              <p>
                Lihat Pesanan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route ('Orderproduk.ListProduk') }}" class="nav-link">
              <i class="nav-icon fas fa-eye"></i>
              <p>
                Lihat Produk
              </p>
            </a>
          </li>
        </ul>
      @else
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-header">Produk</li>
          <li class="nav-item">
            <a href="{{ route('ProdukMitraVendor.produk',encrypt([Session::get('id_username_token'),Session::get('id_member_status'),'next'])) }}" class="nav-link">
              <i class="nav-icon fa fa-eye"></i>
              <p>
                Tambah produk
              </p>
            </a>
          </li> 
          <li class="nav-item">
            <a href="{{ route ('Orderproduk.ListPemesanan') }}" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Lihat Pemesan
              </p>
            </a>
          </li>
        </ul>
      @endif
      </nav>

      
      <!-- /.sidebar-menu -->
      
    </div>
    <!-- /.sidebar -->
  </aside>