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
          return redirect()->back()->with(['status' => 'Módulo en desarrollo...', 'icon' => 'warning']);
        //return view('frontend.asist');
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
            return redirect()->back()->with(['status' => 'Módulo en desarrollo...', 'icon' => 'warning']);
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
}
