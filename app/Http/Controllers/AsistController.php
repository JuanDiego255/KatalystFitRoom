<?php

namespace App\Http\Controllers;

use App\Models\Asist;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class AsistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('frontend.asist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $user = User::where('identification', $request->identification)->get();

            date_default_timezone_set('America/Chihuahua');
            $date_today = date("Y-m-d H:i", time());         

            list($fecha, $hora) = explode(' ', $date_today);                    

            foreach ($user as $item) {
                $user_id = $item->id;
            }
            $asist = new Asist();
            $asist->user_id = $user_id;
            $asist->asist = $fecha;
            $asist->asist_time = $hora;
            $asist->save();

             return redirect()->back()->with(['status' => 'Se ha registrado la asistencia con éxito', 'icon' => 'success']);
        } catch (Exception $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asist  $asist
     * @return \Illuminate\Http\Response
     */
    public function show(Asist $asist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asist  $asist
     * @return \Illuminate\Http\Response
     */
    public function edit(Asist $asist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asist  $asist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asist $asist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asist  $asist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asist $asist)
    {
        //
    }
}
