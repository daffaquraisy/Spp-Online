<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-classrooms')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $nama_kelas = $request->get('nama_kelas');

        $classrooms = \App\Classroom::where('nama_kelas', 'LIKE', "%$nama_kelas%")->paginate(5);

        return view('classrooms.index', ['classrooms' => $classrooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classrooms.create');
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
            'nama_kelas' =>  'required',
        ])->validate();

        $new_classroom = new \App\Classroom;
        $new_classroom->nama_kelas = $request->get('nama_kelas');

        $new_classroom->save();
        return redirect()->route('classrooms.index')->with('status', 'Data kelas baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom = \App\Classroom::findOrFail($id);
        return view('classrooms.edit', ['classroom' => $classroom]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Validator::make($request->all(), [
            'nama_kelas' => 'required',
        ])->validate();

        $classroom = \App\Classroom::findOrFail($id);
        $classroom->nama_kelas = $request->get('nama_kelas');

        $classroom->save();
        return redirect()->route('classrooms.index')->with('status', 'Data kelas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = \App\Classroom::findOrFail($id);
        $classroom->delete();
        return redirect()->route('classrooms.index')->with('status', 'Data kelas berhasil dihapus');
    }
}
