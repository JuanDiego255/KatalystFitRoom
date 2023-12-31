<?php

namespace App\Http\Controllers;

use App\Models\Exercises;
use App\Models\GeneralCategory;
use App\Models\RoutineParameter;
use Illuminate\Http\Request;

class RoutineParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parameters = RoutineParameter::join('general_categories', 'routine_parameters.general_category_id', 'general_categories.id')
            ->select(
                'routine_parameters.id as id',
                'routine_parameters.quantity as quantity',
                'routine_parameters.day as day',
                'general_categories.id as gen_category_id',
                'general_categories.category as gen_category'
            )
            ->get();
        $categories = GeneralCategory::get();
        return view('admin.parameters.index', compact('categories', 'parameters'));
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
            $msg_error = null;
            $quant_parameter = 0;
            $routine_parameter = RoutineParameter::where('general_category_id', $request->general_category_id)
            ->get();
            if(!$routine_parameter->isEmpty()){
                foreach($routine_parameter as $param){
                    $quant_parameter = $quant_parameter + $param->quantity;
                }
            }
            $exercise = Exercises::where('general_category_id', $request->general_category_id)->count();
            $total_quantity = $request->quantity + $quant_parameter;
            if ($total_quantity > $exercise) {
                $msg_error = "La cantidad digitada supera los ejercicios creados con esa categoría";
                if($quant_parameter > 0){
                    $msg_error = "La cantidad digitada más la cantidad ya creada con la categoría seleccionada es mayor a los ejercicios creados";
                }
                return redirect('/parameters')->with(['status' => $msg_error, 'icon' => 'warning']);
            }

            $campos = [
                'quantity' => 'required|integer|max:100',
                'day' => 'required|integer|max:100'
            ];

            $mensaje = ["required" => 'El :attribute es requerido store'];
            $this->validate($request, $campos, $mensaje);

            $parameter =  new  RoutineParameter();

            $parameter->general_category_id = $request->general_category_id;
            $parameter->quantity = $request->quantity;
            $parameter->day = $request->day;
            $parameter->save();

            return redirect('/parameters')->with(['status' => 'Se ha guardado el parámetro con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            return redirect('/parameters')->with(['status' => 'No se pudo guardar el parámetro', 'icon' => 'error']);
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

            RoutineParameter::destroy($id);
            return redirect()->back()->with(['status' => 'Se ha borrado el parámetro con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            //throw $th;
        }
    }
}
