@extends("layouts.global")

@section("title") Users list @endsection
@section("content")

   <h1 class="p-0">Daftar Petugas</h1>

   
   <form action="{{route('users.index')}}">
    <div class="row">
        <div class="col-md-5">
            <input value="{{Request::get('username')}}" name="username" type="text" class="form-control"
                placeholder="Search by buyer name">
        </div>
        <div class="col-md-2">
            <select name="level" class="form-control" id="level">
                <option value="">ANY</option>
                <option {{Request::get('level') == "ADMIN" ? "selected" : ""}} value="ADMIN">ADMIN</option>
                <option {{Request::get('level') == "PETUGAS" ? "selected" : ""}} value="PETUGAS">PETUGAS</option>
                <option {{Request::get('level') == "SISWA" ? "selected" : ""}} value="SISWA">SISWA</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" value="Filter" class="btn btn-primary">
        </div>
    </div>
</form>

   @if(session('status'))
    <div class="alert alert-success mt-3">
        {{session('status')}}
    </div>
    @endif

<div class="row mb-3">
    <div class="col-md-12 text-right">
        <a href="{{route('users.create')}}" class="btn btn-primary">Tambah petugas</a>
   </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th><b>Username</b></th>
            <th><b>Nama Petugas</b></th>
            <th><b>Level</b></th>
            <th><b>Action</b></th>
        </tr>
    </thead>
    <tbody>

        @foreach($users as $user)
        <tr>
            <td>{{$user->username}}</td>
            <td>{{$user->nama_petugas}}</td>

            <td>
                @if($user->level == "ADMIN")
                <span class="badge btn-success">
                    {{$user->level}}
                </span>
                @elseif($user->level == 'PETUGAS')
                <span class="badge btn-info">
                    {{$user->level}}
                </span>
                @else
                <span class="badge btn-warning">
                    {{$user->level}}
                </span>
                @endif
            </td>
            
            <td>
                <a class="btn btn-info text-white btn-sm" href="{{route('users.edit', [$user->id])}}">Edit</a>

                <a href="{{route('users.show', [$user->id])}}" class="btn btn-primary btn-sm">Detail</a>
                
                <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                    action="{{route('users.destroy', [$user->id ])}}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">

                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan=10>
                {{$users->appends(Request::all())->links()}}
            </td>
        </tr>
    </tfoot>
</table>
@endsection
