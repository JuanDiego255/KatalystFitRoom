<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercises;
use App\Models\ExercisesCategory;
use App\Models\GeneralCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExercisesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $Nombre = $request->get('searchfor');

        $categories = GeneralCategory::get();
        $exercises = Exercises::Where('general_categories.category', 'like', "%$Nombre%")
            ->join('general_categories', 'exercises.general_category_id', 'general_categories.id')
            ->select(
                'exercises.id as id',
                'exercises.exercise as exercise',
                'exercises.image as image',
                'general_categories.id as gen_category_id',
                'general_categories.category as gen_category'
            )
            ->simplePaginate(5);
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
            //throw $th;
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
            //throw $th;
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
