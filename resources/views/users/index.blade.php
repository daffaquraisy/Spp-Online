@extends("layouts.global")

@section("title") Users list @endsection
@section("content")

   <h1 class="p-0">Daftar Users</h1>

   
   <form action="{{route('users.index')}}">
    <div class="row">
        <div class="col-md-5 mb-3">
            <input value="{{Request::get('username')}}" name="username" type="text" class="form-control"
                placeholder="Search by username">
        </div>
        <div class="col-md-2 mb-3">
            <select name="level" class="form-control" id="level">
                <option value="">ANY</option>
                <option {{Request::get('level') == "ADMIN" ? "selected" : ""}} value="ADMIN">ADMIN</option>
                <option {{Request::get('level') == "PETUGAS" ? "selected" : ""}} value="PETUGAS">PETUGAS</option>
                <option {{Request::get('level') == "SISWA" ? "selected" : ""}} value="SISWA">SISWA</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="submit" value="Filter" class="btn btn-default">
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
        <a href="{{route('users.create')}}" class="btn btn-default">Tambah user</a>
   </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive mt-3">
        <table id="basic-datatables" class="table table-bordered">
            <thead>
                <tr>
                    <th><b>Email</b></th>
                    <th><b>Username</b></th>
                    <th><b>Nama</b></th>
                    <th><b>Level</b></th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>
        
                @foreach($users as $user)
                <tr>
                    <td>{{$user->email}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->name}}</td>
        
                    <td>
                        @foreach (json_decode($user->level) as $l)
                        
                        &middot; {{$l}} 
                        
                        <br>
                        @endforeach
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
    </div>
    </div>
  </div>
@endsection
