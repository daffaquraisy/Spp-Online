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

        <label for="email">Email</label>
        <input value="{{$user->email}}" class="form-control" placeholder="Masukan nama" type="text"
            name="email" id="email" />
        <br>

        <label for="username">Username</label>
        <input value="{{old('username') ? old('username') : $user->username}}"
            class="form-control {{$errors->first('username') ? "is-invalid" : ""}}" placeholder="Full username" type="text"
            name="username" id="username" />
        <div class="invalid-feedback">
            {{$errors->first('username')}}
        </div>
        <br>

        <label for="name">Nama</label>
        <input value="{{$user->name}}" class="form-control" placeholder="Nama petugas" type="text"
            name="name" id="name" />
        <br>

        <label for="">Level</label>
        <br>
        <input type="checkbox" {{in_array("ADMIN", json_decode($user->level)) ? "checked" : ""}} name="level[]" class=" {{$errors->first('level') ? "is-invalid" : ""}}" id="ADMIN" value="ADMIN">
        <label for="ADMIN">ADMIN</label>
        <input type="checkbox" {{in_array("PETUGAS", json_decode($user->level)) ? "checked" : ""}} name="level[]" class=" {{$errors->first('level') ? "is-invalid" : ""}}" id="PETUGAS" value="PETUGAS">
        <label for="PETUGAS">PETUGAS</label>
        <br>
        <br>

        <input class="btn btn-primary" type="submit" value="Simpan" />
    </form>
</div>
@endsection
