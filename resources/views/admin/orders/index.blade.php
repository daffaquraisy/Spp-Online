@extends('layouts.global')
@section('title') Pembayaran list @endsection
@section('content')
<div class="row">

    <h1>Manage Pembayaran</h1>



    <div class="col-md-12">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
        <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><b>Nama</b></th>
                    <th><b>Nisn</b></th>
                    <th><b>Waktu Pembayaran</b></th>
                    <th><b>Jumlah</b></th>
                    <th><b>Status</b></th>
                    {{-- <th><b>Action</b></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->students->nama}}</td>
                    <td>{{$order->students->nisn}}</td>
                    <td>{{$order->waktu_pembayaran}}</td>
                    <td>{{$order->amount}}</td>

                    <td>{{ ucfirst($order->status) }}</td>
                    {{-- <td style="text-align: center;">
                        @if ($order->status == 'pending')
                        <button class="btn btn-success btn-sm" onclick="snap.pay('{{ $order->snap_token }}')">Complete Payment</button>
                        @endif
                    </td> --}}
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
    </div>
</div>
@endsection

