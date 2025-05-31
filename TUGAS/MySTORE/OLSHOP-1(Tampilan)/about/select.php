<style>
  .store-card {
  border-radius: 1rem;
  padding: 1rem;
  position: relative;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.store-card:hover {
  transform: translateY(-7px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
}
.store-icon-top {
  position: absolute;
  top: 15px;
  right: 20px;
  font-size: 1.2rem;
  color: black;
}
.store-icon-left {
  font-size: 3.5rem;
  color: #6c757d;
}
.store-title {
  font-weight: 700;
  font-size: 1.1rem;
}
.store-text {
  font-size: 0.95rem;
  color: #555;
}
.text-content {
  flex: 1;
  text-align: start;
}
.store-icon {
  font-size: 48px;
  color: #0d6efd;
  margin-bottom: 15px;
}

.card-body {
  display: flex;
  align-items: center;
  gap: 1rem;
}
.space {
  margin-bottom: 100px;
}


</style>

<div class="container-fluid px-3">
<div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-0">Alamat Toko</h1>
    <button class="btn btn-primary icon-hover"><i class="fas fa-plus"></i> Tambah Alamat </button>
  </div>
</div>

<!-- Card Tentang -->
<div class="container py-4 space">
  <div class="row justify-content-center">
    <div class="col-md-10 col-lg-6">
      <div class="card shadow-sm store-card">
        <i class="fas fa-map-marker-alt store-icon-top"></i>
        <div class="card-body about-card">
          <div class="store-icon-left">
            <i class="fas fa-store"></i>
          </div>
          <div class="text-content">
            <div class="store-title">MyStore Bali Duta Plaza</div>
            <div class="store-text">
              Jl. Dewi Sartika No.1, Dauh Puri Klod, Kec. Denpasar Bar., Kota Denpasar, Bali 80114
            </div>
            <div class="store-text mt-1">Senin - Minggu 10:00 – 22:00</div>
          </div>
        </div>
        <div class="d-flex align-items-center ms-3 gap-2">
        <button class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
        </div>
      </div>
    </div>

    <div class="col-md-10 col-lg-6">
      <div class="card shadow-sm store-card">
        <i class="fas fa-map-marker-alt store-icon-top"></i>
        <div class="card-body about-card">
            <div class="store-icon-left">
                <i class="fas fa-store"></i>
            </div>
            <div class="text-content">
                <div class="store-title">MyStore Bali Duta Plaza</div>
                <div class="store-text">
                    Jl. Dewi Sartika No.1, Dauh Puri Klod, Kec. Denpasar Bar., Kota Denpasar, Bali 80114
                </div>
                <div class="store-text mt-1">Senin - Minggu 10:00 – 22:00</div>
            </div>
        </div>
        <div class="d-flex align-items-center ms-3 gap-2">
        <button class="btn btn-primary btn-sm" title="Edit"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>
        </div>
      </div>
    </div>

  </div>
</div>