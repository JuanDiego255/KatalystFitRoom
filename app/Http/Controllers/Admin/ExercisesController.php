<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercises;
use App\Models\ExercisesCategory;
use App\Models\GeneralCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExercisesController extends Controller
{
    private $alias;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->alias != "") {
                $this->alias = Auth::user()->alias . '_' ?? '';
            }else{
                $this->alias = "";
            }
            // Obtener el alias una vez en el constructor
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $alias = $this->alias;
        if (Auth::user()->alias) {
            $alias = Auth::user()->alias . '_';
        }

        $categories = GeneralCategory::get();
        $exercises = Exercises::join($alias.'general_categories', $alias.'exercises.general_category_id', $alias.'general_categories.id')
            ->select(
                $alias.'exercises.id as id',
                $alias.'exercises.exercise as exercise',
                $alias.'exercises.image as image',
                $alias.'general_categories.id as gen_category_id',
                $alias.'general_categories.category as gen_category'
            )
            ->get();
        return view('admin.exercises.index', compact('categories', 'exercises'));
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
            $campos = [
                'exercise' => 'required|string|max:100'
            ];

            $mensaje = ["required" => 'El :attribute es requerido store'];
            $this->validate($request, $campos, $mensaje);

            $exercise =  new  Exercises();
            if ($request->hasFile('image')) {
                $exercise->image = $request->file('image')->store('uploads', 'public');
            }

            $exercise->general_category_id = $request->general_category_id;
            $exercise->exercise = $request->exercise;
            $exercise->save();

            return redirect('/exercises')->with(['status' => 'Se ha guardado el ejercicio con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            return redirect('/exercises')->with(['status' => 'No se pudo guardar el ejercicio', 'icon' => 'error']);
        }
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
        //
        try {
            $campos = [
                'exercise' => 'required|string|max:100'
            ];

            $mensaje = ["required" => 'El :attribute es requerido ' . $id . ' update'];
            $this->validate($request, $campos, $mensaje);
            $exercise = Exercises::findOrfail($id);

            if ($request->hasFile('image')) {

                Storage::delete('public/' . $exercise->image);
                $image = $request->file('image')->store('uploads', 'public');
                $exercise->image = $image;
            }
            $exercise->general_category_id = $request->general_category_id;
            $exercise->exercise = $request->exercise;
            $exercise->update();

            return redirect('/exercises')->with(['status' => 'Se ha editado el ejercicio con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            return redirect('/exercises')->with(['status' => 'No se pudo guardar el ejercicio', 'icon' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $exercises = Exercises::findOrfail($id);
            $exer_name = $exercises->exercise;
            if (
                Storage::delete('public/' . $exercises->image)

            ) {
                Exercises::destroy($id);
            }
            Exercises::destroy($id);
            return redirect()->back()->with(['status' => $exer_name . ' se ha borrado el ejercicio con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            //throw $th;
        }
    }
}
