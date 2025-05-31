@extends('front')

@section('content')
    @if (session('cart'))
        <div class="pe-5">
            
            @php
                $no = 1;
                $total = 0;
            @endphp
            <table class="table  ">
                <thead class="table-dark">
                    <tr class="">
                        <th>No.</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('cart') as $idmenu=>$menu )
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $menu['menu'] }}</td>
                            <td>Rp {{ number_format($menu['harga'], 0, ',', '.') }}</td>
                            <td>
                                <span><a class="btn btn-outline-primary p-0 border-0" href="{{ url('kurang/'.$menu['idmenu']) }}">[-]</a></span>
                                {{ $menu['jumlah'] }}
                                <span><a class="btn btn-outline-primary p-0 border-0" href="{{ url('tambah/'.$menu['idmenu']) }}">[+]</a></span>
                            </td>
                            <td>Rp {{ number_format($menu['jumlah'] * $menu['harga'], 0, ',', '.') }}</td>
                            <td><button class="btn btn-outline-danger p-0 border-0" onclick="window.location.href='{{ url('hapus/'.$menu['idmenu']) }}'"><i class="fas fa-trash-alt"></i> Hapus</button></td>
                        </tr>
                    @php
                        $total = $total + ($menu['jumlah'] * $menu['harga']);
                    @endphp
                    @endforeach
                    <td colspan="4" class="text-end text-success"><h3>Total Pembayaran :</h3></td>
                    <td colspan="2" class="text-success"><h3>Rp {{ number_format($total, 0, ',', '.') }}</h3></td>
                </tbody>
            </table>
            <div>   
                <a class="btn btn-success" href="{{ url('checkout') }}" onclick="confirmCheckout(event)"><i class="fas fa-shopping-cart me-1"></i> CheckOut</a>
                <a class="btn btn-danger" href="{{ url('batal') }}" onclick="confirmBatal(event)"><i class="fas fa-trash-alt me-1"></i> Batal</a>
            <div>

        </div>
    @else
        <script>
            window.location.href="/";
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmCheckout(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Checkout',
                text: "Apakah Anda yakin ingin melanjutkan checkout?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, lanjutkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = e.target.href;
                }
            });
        }
        
        function confirmBatal(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Pembatalan',
                text: "Apakah Anda yakin ingin membatalkan pesanan?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = e.target.href;
                }
            });
        }
    </script>
@endsection