<?php

namespace Tenderos\Http\Controllers\Producer;

use Illuminate\Http\Request;

use Tenderos\Http\Requests;
use Tenderos\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Log, Auth;
use Tenderos\Entities\Product;
use Tenderos\Entities\Production;

class ProductionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postIndex(Request $request)
    {
        $product = Product::findOrFail($request->get('product'));

        $production = Production::firstOrNew([
            'user_id'       => Auth::user()->id,
            'product_id'    => $product->id
        ]);
        
        if(!$production->exists) {
            $production->months  = $request->get('months');
            $production->save();
            $production->load('product');

            $msg = 'Producto ' . $product->name . ' agreagdo';
            return response()->json(['msg' => $msg, 'production' => $production]);
        }
        
        return response()->json(['errors' => ['El producto ya fue agregado']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function putIndex(Request $request)
    {
        try {
            $production = Production::findOrFail($request->get('pk'));
            $production->fill([$request->name => $request->value]);
            $production->save();
        } catch (QueryException $e) {
            return response()->json('Este Producto ya se encuentra agregado en otra fila', 500);    
        }
        
        return response()->json(['success' => true]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct(Request $request, $id)
    {
        $production = Production::findOrFail($id);
        $production->delete();

        return response()->json(['success' => true, 'message' => 'Producto eliminado correctamente']);
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
    }
}
