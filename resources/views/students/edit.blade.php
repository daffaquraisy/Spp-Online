@extends('layouts.global')
@section('title') Edit Siswa @endsection

@section('content')
<div class="col-md-8">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('students.update', [$student->id])}}"
        method="POST">
        @csrf
        <input type="hidden" value="PUT" name="_method">
        <label for="nisn">Nisn</label>
        <input value="{{old('nisn') ? old('nisn') : $student->nisn}}"
            class="form-control {{$errors->first('nisn') ? "is-invalid" : ""}}" placeholder="Nisn" type="text"
            name="nisn" id="nisn" />
        <div class="invalid-feedback">
            {{$errors->first('nisn')}}
        </div>
        <br>

        <label for="nis">Nis</label>
        <input value="{{old('nis') ? old('nis') : $student->nis}}"
            class="form-control {{$errors->first('nis') ? "is-invalid" : ""}}" placeholder="nis" type="text"
            name="nis" id="Nis" />
        <div class="invalid-feedback">
            {{$errors->first('nis')}}
        </div>
        <br>

        <label for="nama">Nama</label>
        <input value="{{old('nama') ? old('nama') : $student->nama}}"
            class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" placeholder="Nama" type="text"
            name="nama" id="nama" />
        <div class="invalid-feedback">
            {{$errors->first('nama')}}
        </div>
        <br>

        <label for="alamat">Alamat</label><br>
        <textarea name="alamat" id="alamat" class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}} "placeholder="Masukan alamat">{{old('alamat') ? old('alamat') : $student->alamat}}</textarea>

        <div class="invalid-feedback">
            {{$errors->first('alamat')}}
        </div>

        <br>

        <label for="no_telp">Nomor telepon</label>
        <input value="{{old('no_telp') ? old('no_telp') : $student->no_telp}}"
            class="form-control {{$errors->first('no_telp') ? "is-invalid" : ""}}" placeholder="Masukan nomor telepon" type="text"
            name="no_telp" id="no_telp" />
        <div class="invalid-feedback">
            {{$errors->first('no_telp')}}
        </div>
        <br>

        <label for="nama_kelas">Nama Kelas</label>
        <select multiple selected="selected" class="form-control" name="id_kelas" id="nama_kelas">
            @foreach ($classrooms as $id => $nama_kelas)
                @if (old('id_kelas', $student->id_kelas) == $id)
                    <option value="{{$id}}" selected>{{$nama_kelas}}</option>
                @else
                <option value="{{$id}}">{{$nama_kelas}}</option>
                @endif
            @endforeach
        </select>

        <br>
        <br>

        <label for="id_spp">Tahun</label>
        <select multiple class="form-control" name="id_spp" id="tahun">
            @foreach ($spps as $id => $tahun)
                @if (old('id_spp', $student->id_spp) == $id)
                    <option value="{{$id}}" selected>{{$tahun}}</option>
                @else
                <option value="{{$id}}">{{$tahun}}</option>
                @endif
            @endforeach
        </select>

        <br>
        <br>

        <br>

        <input class="btn btn-primary" type="submit" value="Simpan" />
    </form>
</div>
@endsection

@section('footer-scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('#nama_kelas').select2({
        ajax: {
            url: '/ajax/classrooms/search_name',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.nama_kelas
                        }
                    })
                }
            }
        }
    });
    var classrooms = {!!$student->classrooms!!}
    classrooms.forEach(function (classroom) {
        var option = new Option(classroom.nama_kelas, classroom.id, true, true);
        $('#classrooms').append(option).trigger('change');
    });

</script>
<script>
    $('#tahun').select2({
        ajax: {
            url: '/ajax/spps/search_tahun',
            processResults: function (data) {
                return {
                    results: data.map(function (item) {
                        return {
                            id: item.id,
                            text: item.tahun
                        }
                    })
                }
            }
        }
    });

    var spps = {!!$student->spps!!}
    spps.forEach(function (spp) {
        var option = new Option(spp.tahun, spp.id, true, true);
        $('#spps').append(option).trigger('change');
    });

</script>
@endsection

