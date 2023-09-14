<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $disciplines = Discipline::simplePaginate(3);
        return view('admin.disciplines.index', compact('disciplines'));
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
        //
        $campos = [
            'discipline' => 'required|string|max:100',
            'description' => 'required|string|max:500',          
            'image' => 'required|max:10000|mimes:jpeg,png,jpg,ico',
        ];

        $mensaje = ["required" => 'El :attribute es requerido store'];
        $this->validate($request, $campos, $mensaje);

        $discipline =  new  Discipline();
        if ($request->hasFile('image')) {
            $discipline->image = $request->file('image')->store('uploads', 'public');
        }
        $discipline->discipline = $request->discipline;       
        $discipline->description = $request->description;              
        $discipline->save();

        return redirect('/disciplines')->with(['status' => 'Se ha guardado la disciplina con éxito','icon' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        return view('admin.disciplines.add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $discipline = Discipline::findOrfail($id);
        return view('admin.disciplines.edit', compact('discipline'));
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
        $campos = [
            'discipline' => 'required|string|max:100',
            'description' => 'required|string|max:500',          
            'image' => 'required|max:10000|mimes:jpeg,png,jpg,ico',
        ];

        $mensaje = ["required" => 'El :attribute es requerido store'];
        $this->validate($request, $campos, $mensaje);
        if ($request->hasFile('image')) {
            $discipline = Discipline::findOrfail($id);

            Storage::delete('public/' . $discipline->image);

            $image = $request->file('image')->store('uploads', 'public');

            $discipline->discipline = $request->discipline;       
            $discipline->description = $request->description;            
            $discipline->image = $image;
          
            $discipline->update();

            return redirect('/disciplines')->with(['status' => 'Se ha editado la disciplina con éxito','icon' => 'success']);
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
        $discipline = Discipline::findOrfail($id);
        $discipline_name = $discipline->discipline;
        if (
            Storage::delete('public/' . $discipline->image)

        ) {
            Discipline::destroy($id);
        }
        Discipline::destroy($id);
        return redirect()->back()->with(['status' => $discipline_name . ' se ha borrado la disciplina con éxito','icon'=>'success']);
    }
}
