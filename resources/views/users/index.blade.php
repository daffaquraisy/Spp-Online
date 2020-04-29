@extends("layouts.global")

@section("title") Users list @endsection
@section("content")

   <h1 class="p-0">Daftar Petugas</h1>

   

   @if(session('status'))
    <div class="alert alert-success mt-3">
        {{session('status')}}
    </div>
    @endif

<div class="row mb-3">
    <div class="col-md-12 text-right mb-3">
        <a href="{{route('users.create')}}" class="btn btn-primary">Tambah petugas</a>
   </div>
</div>

<div class="row">
    <div class="col-md-6">
        <form action="{{route('users.index')}}">
            <div class="input-group mb-3">
                <input value="{{Request::get('keyword')}}" name="keyword" class="form-control col-md-10" type="text"
                    placeholder="Cari nama user..." />
                <div class="input-group-append">
                    <input type="submit" value="Filter" class="btn btn-primary btn-sm">
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <table class="table table-bordered">
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
@endsection
