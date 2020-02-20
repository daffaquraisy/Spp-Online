@extends('layouts.global')
@section('title') Inovice list @endsection
@section('content')
<div class="row">

    <h1>Invoice</h1>

    <div class="col-md-12">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <a href="{{route('orders.create')}}" class="btn btn-primary">Tambahkan invoice</a>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th><b>Nama</b></th>
                    <th><br>Nisn</th>
                    <th><b>Waktu Pembayaran</b></th>
                    <th><b>Jumlah</b></th>
                    <th><b>Petugas</b></th>
                    <th><br>Status</th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->students->nama}}</td>
                    <td>{{$order->students->nisn}}</td>
                    <td>{{$order->waktu_pembayaran}}</td>
                    <td>{{$order->jumlah}}</td>
                    <td>{{$order->users->nama}}</td>

                    <td>
                        @if($order->status == "PROSES")
                        <span class="badge bg-info text-light">
                            {{$order->status}}
                        </span>
                        @else
                        <span class="badge bg-success text-light">
                            {{$order->status}}
                        </span>
                        @endif
                    </td>

                    <td>
                        <a href="{{route('orders.edit', [$order->id])}}" class="btn btn-info btn-sm"> Edit </a>
                        <form method="POST" class="d-inline" onsubmit="return confirm('Hapus data siswa ?')"
                            action="{{route('orders.destroy', [$order->id])}}">
                            @csrf
                            <input type="hidden" value="DELETE" name="_method">
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">
                        {{$orders->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
</div>
@endsection
