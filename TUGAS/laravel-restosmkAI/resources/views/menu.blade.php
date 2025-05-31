@extends('front')

@section('content')
<div class="row">
    @foreach ($menus as $menu)
        <div class="card mx-2 mt-2 p-0" style="width: 18rem; height: 100%; overflow: hidden;">
            <div style="width: 100%; height: 200px;">
                <img src="{{ asset('gambar/'.$menu->gambar) }}" class="card-img-top" style="height: 100%; width: 100%; object-fit: cover; display: block;" alt="...">
            </div>
            <div class="card-body d-flex flex-column" style="padding: 1rem; font-family: 'Segoe UI', Arial, sans-serif;">
                <h5 class="card-title mb-1" style="font-size: 1.2rem; font-weight: 600; color: #333;">{{  $menu->menu }}</h5>
                <p class="card-text" style="font-size: 0.98rem; color: #555; min-height: 60px;">{{ $menu->deskripsi }}</p>
                <p class="card-title mb-2" style="font-size: 1.1rem; font-weight: 500; color: #27ae60;">Rp {{ number_format($menu->harga,0,',','.') }}</p>
            </div>
            <a href="{{ url('beli/'.$menu->idmenu) }}" style="width: 100%" class="btn btn-primary align-self-start">Buy</a>
       </div>
    @endforeach
    <div class="d-flex justify-content-center mt-5">
        {{ $menus->links() }}
    </div>
</div>
@endsection

