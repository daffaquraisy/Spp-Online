@extends("layouts.global")

@section("title") Create Spp @endsection

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

@section("content")

<div class="col-md-8 mt-2">

    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('orders.store')}}" method="POST">

        @csrf

        <label for="nama">Nama Siswa</label><br>
        <select name="id_siswa" multiple id="nama" class="form-control">
        </select>

        <br> <br>

        <label for="jumlah">Jumlah</label>
        <input value="{{old('jumlah')}}" class="form-control {{$errors->first('jumlah') ? "is-invalid": ""}}"
            placeholder="jumlah" type="number" name="jumlah" id="jumlah" />

        <div class="invalid-feedback">
            {{$errors->first('jumlah')}}
        </div>

            <br><br />


        <input class="btn btn-primary" type="submit" value="Save">

    </form>

</div>

@endsection
