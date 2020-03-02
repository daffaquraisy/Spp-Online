<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if (Gate::allows('manage-spp')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index()
    {
        $spps = \App\Spp::paginate(10);
        return view('spps.index', ['spps' => $spps]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('spps.create');
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
            'tahun' => 'required|numeric',
            'nominal' => 'required|numeric'
        ])->validate();

        $new_spp = new \App\Spp;
        $new_spp->tahun = $request->get('tahun');
        $new_spp->nominal = $request->get('nominal');

        $new_spp->save();
        return redirect()->route('spps.index')->with('status', 'Data spp baru berhasil ditambahkan');
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
        $spp = \App\Spp::findOrFail($id);
        return view('spps.edit', ['spp' => $spp]);
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
            'tahun' => 'required|numeric',
            'nominal' => 'required|numeric'
        ])->validate();

        $spp = \App\Spp::findOrFail($id);
        $spp->tahun = $request->get('tahun');
        $spp->nominal = $request->get('nominal');

        $spp->save();
        return redirect()->route('spps.index')->with('status', 'Data spp berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spp = \App\Spp::findOrFail($id);
        $spp->delete();
        return redirect()->route('spps.index')->with('status', 'Data spp berhasil dihapus');
    }
}
