@extends("layouts.global")

@section("title") Create Spp @endsection

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

</script>
@endsection

@section("content")

<div class="col-md-8 mt-2">

    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif

    <form enctype="multipart/form-data" class="bg-white shadow-sm p-3" action="{{route('students.store')}}" method="POST">

        @csrf

        <label for="nisn">Nisn</label>

        <input value="{{old('nisn')}}" class="form-control {{$errors->first('nisn') ? "is-invalid": ""}}"
            placeholder="Nsin" type="number" name="nisn" id="nisn" />

        <div class="invalid-feedback">
            {{$errors->first('nisn')}}
        </div>

        <br>

        <label for="nis">Nis</label>
        <input value="{{old('nis')}}" class="form-control {{$errors->first('nis') ? "is-invalid": ""}}"
            placeholder="Nis" type="number" name="nis" id="nis" />

        <div class="invalid-feedback">
            {{$errors->first('nis')}}
        </div>

        <br>

        <label for="nama">Nama</label>
        <input value="{{old('nama')}}" class="form-control {{$errors->first('nama') ? "is-invalid": ""}}"
            placeholder="Nama Siswa" type="text" name="nama" id="nama" />

        <div class="invalid-feedback">
            {{$errors->first('nama')}}
        </div>

        <br>

        <label for="nama_kelas">Nama Kelas</label><br>
        <select name="id_kelas" multiple id="nama_kelas" class="form-control">
        </select>
        <br><br />

        <label for="alamat">Alamat</label><br>
            <textarea name="alamat" id="alamat" class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}} "placeholder="Masukan alamat rumah">{{old('alamat')}}</textarea>

            <div class="invalid-feedback">
                {{$errors->first('alamat')}}
            </div>

            <br>

            <label for="no_telp">Nomor Telepon</label>
            <input value="{{old('no_telp')}}" class="form-control {{$errors->first('no_telp') ? "is-invalid": ""}}"
                placeholder="Masukan nomor telepon" type="number" name="no_telp" id="no_telp" />
    
            <div class="invalid-feedback">
                {{$errors->first('no_telp')}}
            </div>

            <br>

            <label for="tahun">Tahun</label><br>
            <select name="id_spp" multiple id="tahun" class="form-control">
            </select>
            <br><br />


        <input class="btn btn-primary" type="submit" value="Save">

    </form>

</div>

@endsection
