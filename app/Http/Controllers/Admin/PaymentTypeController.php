<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        $payments = PaymentType::simplePaginate(5);
        return view('admin.payments.index', compact('payments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $payment = new PaymentType();
            $payment->type = $request->type;
            $payment->save();
            return redirect()->back()->with(['status' => 'Se ha guardado el tipo de pago con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            //throw $th;
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailsCategory  $detailsCategory
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        try {
            $payment = PaymentType::find($id);
            $payment->type = $request->type;
            $payment->update();
            return redirect()->back()->with(['status' => 'Se ha editado el tipo de pago con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailsCategory  $detailsCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            PaymentType::destroy($id);
            return redirect()->back()->with(['status' => 'Se ha eliminado el tipo de pago con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            //throw $th;
        }
    }
}
