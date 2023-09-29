<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DetailsCategory;
use Illuminate\Http\Request;

class DetailsCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $categories = DetailsCategory::simplePaginate(3);
            return view('admin.detail-categories.index', compact('categories'));
        } catch (\Exception $th) {
            //throw $th;
        }
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
            $category = new DetailsCategory();
            $category->category = $request->category;
            $category->save();
            return redirect()->back()->with(['status' => 'Se ha guardado la categoría con éxito', 'icon' => 'success']);
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
        try {
            $category = DetailsCategory::find($id);
            $category->category = $request->category;
            $category->update();
            return redirect()->back()->with(['status' => 'Se ha editado la categoría con éxito', 'icon' => 'success']);
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
            DetailsCategory::destroy($id);
            return redirect()->back()->with(['status' => 'Se ha eliminado la categoría con éxito', 'icon' => 'success']);
        } catch (\Exception $th) {
            //throw $th;
        }
    }
}
