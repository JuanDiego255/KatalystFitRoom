<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = GeneralCategory::simplePaginate(3);
        return view('admin.categories.index', compact('categories'));
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
            'category' => 'required|string|max:100',
            'image' => 'required|max:10000|mimes:jpeg,png,jpg,ico'
        ];

        $mensaje = ["required" => 'El :attribute es requerido store'];
        $this->validate($request, $campos, $mensaje);

        $category =  new  GeneralCategory();
        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('uploads', 'public');
        }

        $category->category = $request->category;
        $category->save();

        return redirect('/categories')->with(['status' => 'Se ha guardado la categoría con éxito', 'icon' => 'success']);
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
        //
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
            'category' => 'required|string|max:100',
            'image' => 'required|max:10000|mimes:jpeg,png,jpg,ico'
        ];

        $mensaje = ["required" => 'El :attribute es requerido ' . $id . ' update'];
        $this->validate($request, $campos, $mensaje);

        if ($request->hasFile('image')) {
            $category = GeneralCategory::findOrfail($id);

            Storage::delete('public/' . $category->image);

            $image = $request->file('image')->store('uploads', 'public');

            $category->category = $category->category;     
                  
            $category->image = $image;
          
            $category->update();

            return redirect('/categories')->with(['status' => 'Se ha editado la categoría con éxito','icon' => 'success']);
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
        $category = GeneralCategory::findOrfail($id);
        $category_name = $category->category;
        if (
            Storage::delete('public/' . $category->image)

        ) {
            GeneralCategory::destroy($id);
        }
        GeneralCategory::destroy($id);
        return redirect()->back()->with(['status' => $category_name . ' se ha borrado la categoría con éxito','icon'=>'success']);
    }
}
