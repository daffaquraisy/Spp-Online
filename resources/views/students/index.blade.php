@extends('layouts.global')
@section('title') students list @endsection
@section('content')
<div class="row">

    <h1>Data Siswa</h1>

    <div class="col-md-12">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-12 text-right">
                <a href="{{route('students.create')}}" class="btn btn-default">Tambahkan data siswa</a>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th><b>Nisn</b></th>
                                <th><b>Nis</b></th>
                                <th><b>Nama</b></th>
                                <th><b>Alamat</b></th>
                                <th><b>Kelas</b></th>
                                <th><b>Tahun</b></th>
                                <th><b>Nominal</b></th>                    
                                <th><b>No Telepon</b></th>
                                <th><b>Action</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                            <tr>
                                <td>{{$student->nisn}}</td>
                                <td>{{$student->nis}}</td>
                                <td>{{$student->nama}}</td>
                                <td>{{$student->alamat}}</td>
                                <td>
                                    <ul class="pl-3">
                                        <li>{{$student->classrooms['nama_kelas']}}</li>
                                    </ul>
                                </td>
                                
            
                                <td>
                                    <ul class="pl-3">
                                        <li>{{$student->spp['tahun']}}</li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="pl-3">
                                        <li>{{$student->spp['nominal']}}</li>
                                    </ul>
                                </td>
                                <td>{{$student->no_telp}}</td>
            
                                <td>
                                    <a href="{{route('students.edit', [$student->id])}}" class="btn btn-info btn-sm"> Edit </a>
                                    <form method="POST" class="d-inline" onsubmit="return confirm('Hapus data siswa ?')"
                                        action="{{route('students.destroy', [$student->id])}}">
                                        @csrf
                                        <input type="hidden" value="DELETE" name="_method">
                                        <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    {{$students->appends(Request::all())->links()}}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
          </div>
    
    </div>
</div>
@endsection
