@extends("layouts.global")

@section("title") Create Spp @endsection

@section("content")

<div class="col-md-8 mt-2">

    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('spps.store')}}" method="POST">

        @csrf

        <label for="tahun">Tahun</label>

        <input value="{{old('tahun')}}" class="form-control {{$errors->first('tahun') ? "is-invalid": ""}}"
            placeholder="Tahun" type="number" name="tahun" id="tahun" />

        <div class="invalid-feedback">
            {{$errors->first('tahun')}}
        </div>

        <br>

        <label for="nominal">Nominal</label>
        <input value="{{old('nominal')}}" class="form-control {{$errors->first('nominal') ? "is-invalid": ""}}"
            placeholder="Nominal" type="number" name="nominal" id="nominal" />

        <div class="invalid-feedback">
            {{$errors->first('nominal')}}
        </div>

        <br>

        <input class="btn btn-primary" type="submit" value="Save">

    </form>

</div>

@endsection
