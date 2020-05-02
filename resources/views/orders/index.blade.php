@extends('layouts.global')
@section('title') Pembayaran list @endsection
@section('content')
<div class="row">

    <h1>Pembayaran</h1>



    <div class="col-md-12">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif


        <form class="form-horizontal" id="donation" onsubmit="return submitForm();">

            
    
                <div class="col-md-4">
    
                    <!-- Text input-->
                    <div class="form-group">
                        <label for="nama">Nama Siswa</label><br>
                        <select name="id_siswa" multiple id="nama" class="form-control">
                        </select>
                    </div>
    
                </div>
    
    
                <div class="col-md-4 ml-2">
    
                    <!-- Prepended text-->
                    <label control-label for="">Amount</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                        </div>
                        <input id="amount" name="amount" class="form-control" placeholder="" type="number" min="10000" max="999999999" required="">
                    </div>
    
                </div>

                <!-- Select Basic -->
                <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label" for="donation_type">Type</label>
                    <div>
                        <select disabled id="type" name="type" class="form-control">
                            <option value="Bayar SPP">Bayar SPP</option>
                        </select>
                    </div>
                </div>
            </div>
    
    
            <button id="submit" class="btn btn-dark mt-3 ml-4 ">Submit</button>

            @can('manage-users', $user ?? '')
            <a href="{{route('export.excel.orders')}}" class="btn btn-dark mt-3 ml-4"><i class="fas fa-file-excel-o"></i> Excel</a>
            @endcan

        </form>
        <div class="card shadow mb-4 mt-4">
            <div class="card-body">
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th><b>Nama</b></th>
                    <th><b>Nisn</b></th>
                    <th><b>Waktu Pembayaran</b></th>
                    <th><b>Jumlah</b></th>
                    <th><b>Status</b></th>
                    <th><b>Action</b></th>
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
                    <td style="text-align: center;">
                        @if ($order->status == 'PENDING')
                        <button class="btn btn-success btn-sm" onclick="snap.pay('{{ $order->snap_token }}')">Complete Payment</button>
                        @endif
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
    </div>
</div>
@endsection

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('#nama').select2({
        ajax: {
            url: '/ajax/orders/search_nama',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.nama
                        }
                    })
                }
            }
        }
    });

</script>
@endsection

@section('snap-js')

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{ !config('services.midtrans.isProduction') ? 'https://app.sandbox.midtrans.com/snap/snap.js' : 'https://app.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script>
    function submitForm() {
        // Kirim request ajax
        $.post("{{ route('orders.mine') }}",
        {
            _method: 'POST',
            _token: '{{ csrf_token() }}',
            amount: $('input#amount').val(),
            id_siswa: $('select#nama').val(),
            type: $('select#type').val(),

        },
        function (data, status) {
            snap.pay(data.snap_token, {
                // Optional
                onSuccess: function (result) {
                    location.reload();
                },
                // Optional
                onPending: function (result) {
                    location.reload();
                },
                // Optional
                onError: function (result) {
                    location.reload();
                }
            });
        });
        return false;
    }
    </script>    
@endsection