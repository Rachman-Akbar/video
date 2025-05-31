@extends('Backend.back')

@section('admincontent')
    <div class="d-flex justify-content-between align-items-center mb-3 pe-5">
        <div>
            <h1><i class="fas fa-utensils me-2"></i> Menu</h1>
        </div>
        <div>
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter me-2"></i>Semua Kategori
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach ($kategoris as $kategori)
                            <li><a class="dropdown-item" href="{{ url('admin/menu?kategori='.$kategori->idkategori) }}">{{ $kategori->kategori }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <a class="btn btn-secondary" href="{{ url('admin/menu/create') }}"><i class="fas fa-plus"></i> Tambah Menu</a>
            </div>
        </div>
    
    </div>
    <div class="row">
        @foreach ($menus as $menu)
            <div class="card mx-2 mt-2 p-0" style="width: 18rem; height: 100%; overflow: hidden;">
                    <div class="card h-100">
                        <div style="width: 100%; height: 200px;">
                            <img src="{{ asset('gambar/'.$menu->gambar) }}" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover; display: block;" alt="...">
                        </div>
                        <div class="card-body d-flex flex-column" style="padding: 1rem; font-family: 'Segoe UI', Arial, sans-serif;">
                        <h5 class="card-title">{{ $menu->menu }}</h5>
                        <p class="card-text"><small class="text-muted">{{ $menu->kategori }}</small></p>
                        <p class="card-text">{{ $menu->deskripsi }}</p>
                        <h6 class="text-primary">Rp {{ number_format($menu->harga, 0, ',', '.') }}</h6>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-center gap-3">
                            <a class="btn btn-sm btn-warning text-white" href="{{ url('admin/menu/'.$menu->idmenu.'/edit') }}"><i class="fas fa-edit text-white"></i> Update</a>
                            <a class="btn btn-sm btn-danger text-white" href="{{ url('admin/menu/'.$menu->idmenu) }}" onclick="event.preventDefault(); Swal.fire({
                                title: 'Apakah Anda yakin?',
                                text: 'Anda akan menghapus menu ini!',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Ya, hapus!',
                                cancelButtonText: 'Batal'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = this.href;
                                }
                            });"><i class="fas fa-trash-alt text-white"></i> Delete</a>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $menus->withQueryString()->links() }}
    </div>
@endsection