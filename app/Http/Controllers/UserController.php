<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = \App\User::paginate(10);

        $level = $request->get('level');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';

        if ($level) {
            $users = \App\User::where("level", "LIKE", "%$keyword%")->where('level', strtoupper($level))->paginate(10);
        } else {
            $users = \App\User::where("level", "LIKE", "%$keyword%")->paginate(10);
        }

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'username' => 'required|min:5',
            'nama' => 'required|min:10',
            'level' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ])->validate();

        $new_user = new \App\User;
        $new_user->username = $request->get('username');
        $new_user->nama = $request->get('nama');
        $arrayTostring = implode(',', $request->input('level'));
        $new_user['level'] = $arrayTostring;
        $new_user->password = Hash::make($request->get('password'));

        $new_user->save();
        return redirect()->route('users.index')->with('level', 'Data petugas berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::findOrFail($id);
        return view('users.edit', ['user' => $user]);
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
            'username' => 'required|min:5',
            'nama' => 'required|min:10',
            'level' => 'required'
        ])->validate();

        $user = \App\User::findOrFail($id);
        $user->username = $request->get('username');
        $user->nama = $request->get('nama');
        $arrayTostring = implode(',', $request->input('level'));
        $user['level'] = $arrayTostring;

        $user->save();
        return redirect()->route('users.index', [$id])->with('level', 'Data petugas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('level', 'Data petugas berhasil dihapus');
    }
}
