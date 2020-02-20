<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = \App\Order::with('users')->paginate(10);
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
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
            'jumlah' => 'required'
        ])->validate();

        $new_order = new \App\Order;
        $new_order->jumlah = $request->get('jumlah');
        $new_order->waktu_pembayaran = Carbon::now();
        $new_order->user_id = \Auth::user()->id;
        $new_order->id_siswa = $request->get('id_siswa');

        $new_order->save();
        return redirect()->route('orders.create')->with('status', 'Invoice berhasil dibuat');
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
        $order = \App\Order::findOrFail($id);
        $students = \App\Student::pluck('nama', 'id')->toArray();
        return view('oders.edit')->with(compact('order', 'students'));
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
            'status' => 'required',
            'jumlah' => 'required',
        ])->validate();

        $order = \App\Order::findOrFail($id);
        $order->jumlah = $request->get('jumlah');
        $order->status = $request->get('status');
        $order->waktu_pembayaran = Carbon::now();
        $order->user_id = \Auth::user()->id;
        $order->id_siswa = $request->get('id_siswa');

        $order->save();

        return redirect()->route('orders.index')->with('status', 'Invoice berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = \App\Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('status', 'Invoice berhasil dihapus');
    }
}
