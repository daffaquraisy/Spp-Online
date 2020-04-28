@extends("layouts.global")

@section("title") Spp List @endsection
@section("content")

   <h1 class="p-0">Daftar Spp</h1>

<div class="row mb-3">
    <div class="col-md-12 text-right">
        <a href="{{route('spps.create')}}" class="btn btn-default">Tambah spp</a>
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
                            <th><b>Tahun</b></th>
                            <th><b>Nominal</b></th>
                            <th><b>Action</b></th>
                        </tr>
                    </thead>
                    <tbody>
                
                        @foreach($spps as $spp)
                        <tr>
                            <td>{{$spp->tahun}}</td>
                            <td>{{$spp->nominal}}</td>
                
                            <td>
                                <a class="btn btn-info text-white btn-sm" href="{{route('spps.edit', [$spp->id])}}">Edit</a>
                                
                                <form onsubmit="return confirm('Delete this class permanently?')" class="d-inline"
                                    action="{{route('spps.destroy', [$spp->id ])}}" method="POST">
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
                                {{$spps->appends(Request::all())->links()}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>    

    </div>
</div>

@endsection
