<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranReport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Veritrans_Config;
use Veritrans_Snap;
use Veritrans_Notification;
use Excel;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $request;


    public function __construct(Request $request)
    {
        $this->request = $request;

        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function submitOrder()
    {
        \DB::transaction(function () {
            // Save donasi ke database
            $new_order = \App\Order::create([
                'waktu_pembayaran' => Carbon::now(),
                'user_id' => \Auth::user()->name,
                'amount' => floatval($this->request->amount),
                'id_siswa' => implode(',', $this->request->input('id_siswa')),
                'type' => $this->request->type
            ]);

            // Buat transaksi ke midtrans kemudian save snap tokennya.
            $payload = [
                'transaction_details' => [
                    'order_id'      => $new_order->id,
                    'gross_amount'  => $new_order->amount,
                ],
                'customer_details' => [
                    'first_name'    => \Auth::user()->name,
                    'email'         => \Auth::user()->email,
                ],
                'item_details' => [
                    [
                        'id'       => $new_order->type,
                        'price'    => $new_order->amount,
                        'quantity' => 1,
                        'name'     => ucwords(str_replace('_', ' ', $new_order->type))
                    ]
                ]
            ];
            $snapToken = Veritrans_Snap::getSnapToken($payload);
            $new_order->snap_token = $snapToken;
            $new_order->save();

            // Beri response snap token
            $this->response['snap_token'] = $snapToken;
        });

        return response()->json($this->response);
    }

    public function notificationHandler(Request $request)
    {
        $notif = new Veritrans_Notification();
        \DB::transaction(function () use ($notif) {

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraud = $notif->fraud_status;
            $new_order = \App\Order::findOrFail($orderId);

            if ($transaction == 'capture') {

                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                if ($type == 'credit_card') {

                    if ($fraud == 'challenge') {
                        // TODO set payment status in merchant's database to 'Challenge by FDS'
                        // TODO merchant should decide whether this transaction is authorized or not in MAP
                        // $new_order->addUpdate("Transaction order_id: " . $orderId ." is challenged by FDS");
                        $new_order->setPending();
                    } else {
                        // TODO set payment status in merchant's database to 'Success'
                        // $new_order->addUpdate("Transaction order_id: " . $orderId ." successfully captured using " . $type);
                        $new_order->setSuccess();
                    }
                }
            } elseif ($transaction == 'settlement') {

                // TODO set payment status in merchant's database to 'Settlement'
                // $new_order->addUpdate("Transaction order_id: " . $orderId ." successfully transfered using " . $type);
                $new_order->setSuccess();
            } elseif ($transaction == 'pending') {

                // TODO set payment status in merchant's database to 'Pending'
                // $new_order->addUpdate("Waiting customer to finish transaction order_id: " . $orderId . " using " . $type);
                $new_order->setPending();
            } elseif ($transaction == 'deny') {

                // TODO set payment status in merchant's database to 'Failed'
                // $new_order->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is Failed.");
                $new_order->setFailed();
            } elseif ($transaction == 'expire') {

                // TODO set payment status in merchant's database to 'expire'
                // $new_order->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is expired.");
                $new_order->setExpired();
            } elseif ($transaction == 'cancel') {

                // TODO set payment status in merchant's database to 'Failed'
                // $new_order->addUpdate("Payment using " . $type . " for transaction order_id: " . $orderId . " is canceled.");
                $new_order->setFailed();
            }
        });

        return;
    }

    public function index()
    {
        $orders = \App\Order::with('students')->paginate(10);
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // \Validator::make($request->all(), [
        //     'amount' => 'required'
        // ])->validate();

        // $new_order = new \App\Order;
        // $new_order->amount = $request->get('amount');
        // $new_order->waktu_pembayaran = Carbon::now();
        // $new_order->user_id = \Auth::user()->id;
        // $new_order->id_siswa = $request->get('id_siswa');

        // $new_order->save();
        // return redirect()->route('orders.create')->with('status', 'Invoice berhasil dibuat');
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
        // $order = \App\Order::findOrFail($id);
        // $students = \App\Student::pluck('nama', 'id')->toArray();
        // return view('oders.edit')->with(compact('order', 'students'));
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
        // \Validator::make($request->all(), [
        //     'status' => 'required',
        //     'amount' => 'required',
        // ])->validate();

        // $order = \App\Order::findOrFail($id);
        // $order->amount = $request->get('amount');
        // $order->status = $request->get('status');
        // $order->waktu_pembayaran = Carbon::now();
        // $order->user_id = \Auth::user()->id;
        // $order->id_siswa = $request->get('id_siswa');

        // $order->save();

        // return redirect()->route('orders.index')->with('status', 'Invoice berhasil diupdate');
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

    public function ajaxSearchName(Request $request)
    {
        $keyword = $request->get('q');

        $students = \App\Student::where("nama", "LIKE", "%$keyword%")->get();

        return $students;
    }

    public function exportExcel()
    {
        $nama_file = 'Data Pembayaran ' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new PembayaranReport, $nama_file);
    }
}
