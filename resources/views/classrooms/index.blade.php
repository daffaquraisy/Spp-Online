@extends("layouts.global")

@section("title") Kelas List @endsection
@section("content")

   <h1 class="p-0">Daftar Kelas</h1>

   <form action="{{route('classrooms.index')}}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <input value="{{Request::get('nama_kelas')}}" name="nama_kelas" type="text" class="form-control"
                placeholder="Search by nama kelas">
        </div>
        
        <div class="col-md-6">
            <input type="submit" value="Filter" class="btn btn-default">
        </div>
    </div>
</form>

<div class="row mb-3">
    <div class="col-md-12 text-right">
        <a href="{{route('classrooms.create')}}" class="btn btn-default">Tambah kelas</a>
   </div>
</div>
<div class="row">
    <div class="col-md">
        @if(session('status'))
        <div class="alert alert-success mt-3">
            {{session('status')}}
        </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><b>Nama Kelas</b></th>
                    <th><b>Action</b></th>
                </tr>
            </thead>
            <tbody>
        
                @foreach($classrooms as $c)
                <tr>
                    <td>{{$c->nama_kelas}}</td>
        
                    <td>
                        <a class="btn btn-info text-white btn-sm" href="{{route('classrooms.edit', [$c->id])}}">Edit</a>
                        
                        <form onsubmit="return confirm('Delete this class permanently?')" class="d-inline"
                            action="{{route('classrooms.destroy', [$c->id ])}}" method="POST">
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
                        {{$classrooms->appends(Request::all())->links()}}
                    </td>
                </tr>
            </tfoot>
        </table>
            </div>
        </div>
    </div>
</div>

@endsection
