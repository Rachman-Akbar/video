@extends('Backend.back')

@section('admincontent')
    <div class="container mt-4">
        <h1 class="mb-4">Order Detail</h1>

        <div class="card-body ">
            <h4>Pelanggan: {{ $orders[0]['pelanggan'] }}</h4>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
            <thead>
                <th>No.</th>
                <th>Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $order->menu }}</td>
                        <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>Rp {{ number_format($order->jumlah * $order->harga, 0, ',', '.') }}</td>
                    </tr>   
                    @endforeach
                </table>
            </div>
            <h4 class="text-end">Total:  Rp {{ number_format($orders[0]['total'], 0, ',', '.') }}</h4>
    </tbody>
@endsection