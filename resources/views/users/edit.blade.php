@extends('layouts.global')
@section('title') Edit User @endsection

@section('content')
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.update', [$user->id])}}"
        method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="username">Username</label>
        <input value="{{old('username') ? old('username') : $user->username}}"
            class="form-control {{$errors->first('username') ? "is-invalid" : ""}}" placeholder="Full username" type="text"
            name="username" id="username" />
        <div class="invalid-feedback">
            {{$errors->first('username')}}
        </div>
        <br>

        <label for="nama_petugas">Nama petugas</label>
        <input value="{{$user->nama_petugas}}" class="form-control" placeholder="Nama petugas" type="text"
            name="nama_petugas" id="nama_petugas" />
        <br>

        <label for="">Level</label>
        <br>
        <div class="custom-control custom-checkbox small">
            <input type="checkbox" {{$user->level == 'ADMIN' ? 'checked' : ''}} class="custom-control-input mb-5{{$errors->first('level') ? "is-invalid" : "" }}" name="level[]"
            id="ADMIN" value="ADMIN">
            <label class="custom-control-label" for="ADMIN">Admin</label>
          </div>

          <div class="custom-control custom-checkbox small">
            <input type="checkbox" {{$user->level == 'PETUGAS' ? 'checked' : ''}} class="custom-control-input {{$errors->first('level') ? "is-invalid" : "" }}" name="level[]"
            id="PETUGAS" value="PETUGAS">
            <label class="custom-control-label" for="PETUGAS">Petugas</label>
          </div>
        <br>

        <input class="btn btn-primary" type="submit" value="Simpan" />
    </form>
</div>
@endsection
