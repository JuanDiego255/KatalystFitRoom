<?php

namespace App\Http\Controllers\Admin;

use App\Models\MetaTags;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetaTagsController extends Controller
{
    public function index(Request $request)
    {
        $metatags = MetaTags::simplePaginate(3);
        return view('admin.metatags.index', compact('metatags'));
    }
    /**

     *get all the events, and redirects to add activity view.

     */
    public function agregar()
    {

        return view('admin.metatags.add');
    }
    /**

     *Insert the form data into the respective table

     *

     * @param Request $request


     */
    public function store(Request $request)
    {
        
        $campos = [
            'title' => 'required|string|max:100',
            'meta_description' => 'required|string|max:10000',
            'meta_keywords' => 'required|string|max:500',
            'meta_og_description' => 'required|string|max:10000',
            'meta_og_title' => 'required|string|max:100',
            'url_canonical' => 'required|string|max:100',
            'meta_type' => 'required|string|max:100'
        ];

        $mensaje = ["required" => 'El :attribute es requerido'];
        $this->validate($request, $campos, $mensaje);

        $tag = new MetaTags();
        $tag->section = $request->section;
        $tag->title = $request->title;
        $tag->meta_keywords = $request->meta_keywords;
        $tag->meta_description = $request->meta_description;
        $tag->meta_og_title = $request->meta_og_title;
        $tag->meta_og_description = $request->meta_og_description;
        $tag->url_canonical = $request->url_canonical;
        $tag->url_image_og = $request->url_image_og;
        $tag->meta_type = $request->meta_type;

        $tag->save();

        return redirect('meta-tags/indexadmin')->with(['status' => 'Se ha guardado el servicio con éxito','icon' => 'success']);
    }
    /**

     * Redirects to add event view.

     *

     * @param $id


     */
    public function edit($id)
    {
        $metatag = MetaTags::findOrfail($id);
        return view('admin.metatags.edit', compact('metatag'));
    }
    /**

     *Update the form data into the respective table

     *

     * @param Request $request

     * @param $id


     */
    public function update(Request $request, $id)
    {
        $campos = [
            'title' => 'required|string|max:100',
            'meta_description' => 'required|string|max:10000',
            'meta_keywords' => 'required|string|max:500',
            'meta_og_description' => 'required|string|max:10000',
            'meta_og_title' => 'required|string|max:100',
            'url_canonical' => 'required|string|max:100',
            'meta_type' => 'required|string|max:100'
        ];

        $mensaje = ["required" => 'El :attribute es requerido'];
        $this->validate($request, $campos, $mensaje);

        $tag = MetaTags::find($id);
        $tag->section = $request->section;
        $tag->title = $request->title;
        $tag->meta_keywords = $request->meta_keywords;
        $tag->meta_description = $request->meta_description;
        $tag->meta_og_title = $request->meta_og_title;
        $tag->meta_og_description = $request->meta_og_description;
        $tag->url_canonical = $request->url_canonical;
        $tag->url_image_og = $request->url_image_og;
        $tag->meta_type = $request->meta_type;

        $tag->save();
        return redirect('meta-tags/indexadmin')->with(['status' => 'Se ha editado el metatag con éxito','icon' => 'success']);
    }
    /**

     * delete the data from the respective table.

     *

     * @param $id


     */
    public function destroy($id)
    {        
        MetaTags::destroy($id);
        return redirect()->back()->with(['status' => 'Se ha eliminado el metatag con éxito','icon' => 'success']);
    }
}
