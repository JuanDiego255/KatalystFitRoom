<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Details;
use App\Models\DetailsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $Nombre = $request->get('searchfor');

        $categories = DetailsCategory::get();
        $products = Details::Where('details.product', 'like', "%$Nombre%")
            ->join('details_categories', 'details.category_id', 'details_categories.id')
            ->select(
                'details.id as id',
                'details.product as product',
                'details.description as description',
                'details.price as price',
                'details.stock as stock',
                'details.status as status',
                'details.image as image',
                'details_categories.id as category_id',
                'details_categories.category as category'
            )
            ->simplePaginate(5);
        return view('admin.products.index', compact('categories', 'products'));
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


        $products =  new  Details();
        if ($request->hasFile('image')) {
            $products->image = $request->file('image')->store('uploads', 'public');
        }

        $products->category_id = $request->category_id;
        $products->product = $request->product;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->stock = $request->stock;
        $products->status = 1;
        $products->save();

        return redirect('/products')->with(['status' => 'Se ha guardado el producto con éxito', 'icon' => 'success']);
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
        $products = Details::findOrfail($id);

        if ($request->hasFile('image')) {
          
            Storage::delete('public/' . $products->image);
            $image = $request->file('image')->store('uploads', 'public');           
            $products->image = $image;            
        }       

        $products->category_id = $request->category_id;
        $products->product = $request->product;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->stock = $request->stock;

        $products->update();
        return redirect('/products')->with(['status' => 'Se ha editado el producto con éxito', 'icon' => 'success']);
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
        $products = Details::findOrfail($id);
        $prod_name = $products->product;
        if (
            Storage::delete('public/' . $products->image)

        ) {
            Details::destroy($id);
        }
        Details::destroy($id);
        return redirect()->back()->with(['status' => $prod_name . ' se ha borrado el producto con éxito', 'icon' => 'success']);
    }
}
