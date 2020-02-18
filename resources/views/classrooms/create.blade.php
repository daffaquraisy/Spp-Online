@extends("layouts.global")

@section("title") Create Kelas @endsection

@section("content")

<div class="col-md-8 mt-2">

    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('classrooms.store')}}" method="POST">

        @csrf

        <label for="nama_kelas">Nama Kelas</label>

        <input value="{{old('nama_kelas')}}" class="form-control {{$errors->first('nama_kelas') ? "is-invalid": ""}}"
            placeholder="Nama kelas" type="text" name="nama_kelas" id="nama_kelas" />

        <div class="invalid-feedback">
            {{$errors->first('nama_kelas')}}
        </div>

        <br>

        <br>

        <input class="btn btn-primary" type="submit" value="Save">

    </form>

</div>

@endsection
