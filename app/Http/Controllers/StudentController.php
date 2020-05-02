<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Spp;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-students')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index()
    {
        $students = \App\Student::with('classrooms')->with('spp')->paginate(10);
        return view('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric|digits_between:11,13'
        ])->validate();

        $new_student = new \App\Student;
        $new_student->nisn = $request->get('nisn');
        $new_student->nis = $request->get('nis');
        $new_student->nama = $request->get('nama');
        $new_student->alamat = $request->get('alamat');
        $new_student->no_telp = $request->get('no_telp');
        $new_student->id_kelas = $request->get('id_kelas');
        $new_student->id_spp = $request->get('id_spp');

        $new_student->save();

        return redirect()->route('students.index')->with('status', 'Data siswa berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = \App\Student::findOrFail($id);
        $classrooms = \App\Classroom::pluck('nama_kelas', 'id')->toArray();
        $spps = \App\Spp::pluck('tahun', 'id')->toArray();
        return view('students.edit')->with(compact('student', 'classrooms', 'spps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Validator::make($request->all(), [
            'nisn' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric|digits_between:11,13'
        ])->validate();

        $student = \App\Student::findOrFail($id);
        $student->nisn = $request->get('nisn');
        $student->nis = $request->get('nis');
        $student->nama = $request->get('nama');
        $student->alamat = $request->get('alamat');
        $student->no_telp = $request->get('no_telp');
        $student->id_kelas = $request->get('id_kelas');
        $student->id_spp = $request->get('id_spp');

        $student->save();

        return redirect()->route('students.index')->with('status', 'Data siswa berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = \App\Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('status', 'Data siswa berhasil dihapus');
    }

    public function ajaxSearchClassName(Request $request)
    {
        $keyword = $request->get('q');

        $classrooms = \App\Classroom::where("nama_kelas", "LIKE", "%$keyword%")->get();

        return $classrooms;
    }

    public function ajaxSearchTahun(Request $request)
    {
        $keyword = $request->get('q');

        $spps = \App\Spp::where("tahun", "LIKE", "%$keyword%")->get();

        return $spps;
    }
}
