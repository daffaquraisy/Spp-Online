@extends("layouts.global")

@section("title") Create User @endsection

@section("content")

<div class="col-md-8 mt-2">

    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('users.store')}}" method="POST">

        @csrf

        <label for="username">Username</label>

        <input value="{{old('username')}}" class="form-control {{$errors->first('username') ? "is-invalid": ""}}"
            placeholder="Username" type="text" name="username" id="username" />

        <div class="invalid-feedback">
            {{$errors->first('username')}}
        </div>

        <br>

        <label for="nama_petugas">Nama Petugas</label>

        <input value="{{old('nama_petugas')}}" class="form-control {{$errors->first('nama_petugas') ? "is-invalid": ""}}"
            placeholder="Nama petugas" type="text" name="nama_petugas" id="nama_petugas">

        <div class="invalid-feedback">
            {{$errors->first('nama_petugas')}}
        </div>
        <br>

        <label for="">Level</label>
        <br>

            <div class="custom-control custom-checkbox small">
              <input type="checkbox" class="custom-control-input mb-5{{$errors->first('level') ? "is-invalid" : "" }}" name="level[]"
              id="ADMIN" value="ADMIN">
              <label class="custom-control-label" for="ADMIN">Admin</label>
            </div>

            <div class="custom-control custom-checkbox small">
              <input type="checkbox" class="custom-control-input {{$errors->first('level') ? "is-invalid" : "" }}" name="level[]"
              id="PETUGAS" value="PETUGAS">
              <label class="custom-control-label" for="PETUGAS">Petugas</label>
            </div>

        <div class="invalid-feedback">
            {{$errors->first('level')}}
        </div>
        
        <br>

        <label for="password">Password</label>
        <br>
        <input class="form-control {{$errors->first('password') ? "is-invalid" : ""}}" placeholder="password"
            type="password" name="password" id="password">

        <div class="invalid-feedback">
            {{$errors->first('password')}}
        </div>

        <br>

        <label for="password_confirmation">Password Confirmation</label>
        <br>
        <input class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : ""}}"
            placeholder="password confirmation" type="password" name="password_confirmation" id="password_confirmation">

        <div class="invalid-feedback">
            {{$errors->first('password_confirmation')}}
        </div>

        <br>

        <input class="btn btn-primary" type="submit" value="Save">

    </form>

</div>

@endsection
