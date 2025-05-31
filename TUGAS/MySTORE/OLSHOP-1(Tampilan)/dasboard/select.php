<style>
    .icon-link {
      border: 1px solid #ccc;
      border-radius: 50%;
      padding: 6px 9px;
      transition: all 0.3s ease;
      color: white;
      text-decoration: none;
    }
    .icon-link:hover {
      transform: scale(1.1);
      opacity: 0.9;
    }
    .icon-menu    { background-color: #4e73df; }
    .icon-user    { background-color: #1cc88a; }
    .icon-order   { background-color: #36b9cc; }
    .icon-income  { background-color: #f6c23e; }  
  </style>


  <div class="container-fluid px-3">
    <h1>Dasboard</h1>
    <!-- 4 Card Utama -->
    <div class="row mb-4">
      <div class="col-md-3">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center mb-2">
            <h6 class="card-title fw-bold">Menu</h6>
            <a href="#" class="icon-link icon-menu"><i class="fas fa-eye"></i></a>
          </div>
          <div class="card-body">
            <h4 class="fw-bold">12</h4>
            <small class="text-success"><i class="fas fa-arrow-up"></i> +5% dari minggu lalu</small>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center mb-2">
            <h6 class="card-title fw-bold">Pelanggan</h6>
            <a href="#" class="icon-link icon-user"><i class="fas fa-eye"></i></a>
          </div>
          <div class="card-body">
            <h4 class="fw-bold">58</h4>
            <small class="text-success"><i class="fas fa-arrow-up"></i> +10% dari minggu lalu</small>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center mb-2">
            <h6 class="card-title fw-bold">Pesanan</h6>
            <a href="#" class="icon-link icon-order"><i class="fas fa-eye"></i></a>
          </div>
          <div class="card-body">
            <h4 class="fw-bold">24</h4>
            <small class="text-success"><i class="fas fa-arrow-up"></i> +3% dari minggu lalu</small>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center mb-2">
            <h6 class="card-title fw-bold">Pendapatan</h6>
            <a href="#" class="icon-link icon-income"><i class="fas fa-eye"></i></a>
          </div>
          <div class="card-body">
            <h4 class="fw-bold">Rp 12.500.000</h4>
            <small class="text-success"><i class="fas fa-arrow-up"></i> +15% dari minggu lalu</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Ringkasan dan Grafik -->
    <div class="row mb-4">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header fw-bold">Ringkasan Penjualan</div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Order #12345 <span class="badge bg-primary">Rp 250.000</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Order #12346 <span class="badge bg-primary">Rp 180.000</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header fw-bold">Grafik Penjualan</div>
          <div class="card-body">
            <div style="overflow-x: auto;">
              <canvas id="salesChart" height="200"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Info Lanjutan -->
    <div class="row mb-4">
      <div class="col-md-4">
        <div class="card text-white bg-success shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Pelanggan Baru</h5>
            <p class="card-text">15 pelanggan bergabung minggu ini</p>
            <a href="#" class="btn btn-sm btn-light">Lihat Selengkapnya</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-warning shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Pesanan</h5>
            <p class="card-text">24 pesanan baru minggu ini</p>
            <a href="#" class="btn btn-sm btn-light">Lihat Selengkapnya</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card text-white bg-info shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Pembayaran</h5>
            <p class="card-text">Total pembayaran Rp 12.500.000</p>
            <a href="#" class="btn btn-sm btn-light">Lihat Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Produk dan Kategori -->
    <div class="row mb-4">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold">Produk</span>
            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Nasi Goreng</td>
                    <td>Nasi dengan bumbu spesial</td>
                    <td>Rp 25.000</td>
                    <td>Makanan</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Es Teh</td>
                    <td>Minuman dingin menyegarkan</td>
                    <td>Rp 10.000</td>
                    <td>Minuman</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold">Kategori</span>
            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
          </div>
          <div class="card-body d-flex gap-3 flex-wrap">
            <div class="flex-shrink-0 p-1 d-flex flex-column align-items-center kategori-small" style="width: 80px;">
              <a href="?f=home&m=kategori" style="text-decoration: none; color: inherit;">
                <div class="kategori-img-wrapper mb-2 d-flex justify-content-center align-items-center" data-aos="fade-up" style="width: 60px; height: 60px;">
                  <i class="fas fa-tf-largea-2x"></i>
                </div>
                <div class="text-center mt-2">Semua</div>
              </a>
            </div>
            <div class="flex-shrink-0 p-1 d-flex flex-column align-items-center kategori-small" style="width: 80px;">
              <a href="?f=home&m=kategori" style="text-decoration: none; color: inherit;">
                <div class="kategori-img-wrapper mb-2 d-flex justify-content-center align-items-center" data-aos="fade-up" style="width: 60px; height: 60px;">
                  <i class="fas fa-tf-largea-2x"></i>
                </div>
                <div class="text-center mt-2">Semua</div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


