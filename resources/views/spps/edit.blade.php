@extends('layouts.global')
@section('title') Edit Kelas @endsection

@section('content')
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('spps.update', [$spp->id])}}"
        method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="tahun">Tahun</label>
        <input value="{{old('tahun') ? old('tahun') : $spp->tahun}}"
            class="form-control {{$errors->first('tahun') ? "is-invalid" : ""}}" placeholder="Tahun" type="text"
            name="tahun" id="tahun" />
        <div class="invalid-feedback">
            {{$errors->first('tahun')}}
        </div>
        <br>

        <label for="nominal">Nominal</label>
        <input value="{{old('nominal') ? old('nominal') : $spp->nominal}}"
            class="form-control {{$errors->first('nominal') ? "is-invalid" : ""}}" placeholder="Nominal" type="text"
            name="nominal" id="nominal" />
        <div class="invalid-feedback">
            {{$errors->first('nominal')}}
        </div>
        <br>

        <br>

        <input class="btn btn-primary" type="submit" value="Simpan" />
    </form>
</div>
@endsection
