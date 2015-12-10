<?php

namespace Tenderos\Http\Controllers\Shopkeeper;

use Illuminate\Http\Request;

use Tenderos\Http\Requests;
use Tenderos\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Log, Auth;
use Tenderos\Entities\Product;
use Tenderos\Entities\ShoppingInterest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postIndex(Request $request)
    {
        $product    = Product::findOrFail($request->get('product'));

        $shoppingInterest = ShoppingInterest::firstOrNew([
            'user_id'       => Auth::user()->id,
            'product_id'    => $product->id
        ]);
        
        if(!$shoppingInterest->exists) {
            $shoppingInterest->amount   = $request->get('amount');
            $shoppingInterest->unit     = $request->get('unit');
            $shoppingInterest->save();
            $msg = 'Producto ' . $product->name . ' agreagdo';
            
            return response()->json(['msg' => $msg, 'product' => $product, 'shoppingInterest' => $shoppingInterest]);
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
            $shoppingInterest = ShoppingInterest::findOrFail($request->get('pk'));
            $shoppingInterest->fill([$request->name => $request->value]);
            $shoppingInterest->save();
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
        $shoppingInterest = ShoppingInterest::findOrFail($id);
        $shoppingInterest->delete();

        return response()->json(['success' => true, 'message' => 'Compra eliminada correctamente']);
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
