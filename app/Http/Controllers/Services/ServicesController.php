<?php

namespace Tenderos\Http\Controllers\Services;

use Illuminate\Http\Request;

use Tenderos\Http\Requests;
use Tenderos\Http\Controllers\Controller;

use Tenderos\Entities\Product;
use Tenderos\Entities\User;
use Tenderos\Entities\Municipality;
use Tenderos\Entities\Production;
use Log, Auth;

class ServicesController extends Controller
{
    /**
     * Display a listing of the Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducts(Request $request)
    {   
        $productName = $request->get('query');
        
        if(Auth::user()->isProducer()){
            $execptProductIds = Auth::user()->productions->lists('product_id')->all();
        }
        else{
            $execptProductIds = Auth::user()->shoppingInterests->lists('id')->all();
        }
        

        $products = $this->getFormatSelect2(Product::allLists($productName, $execptProductIds));

        return response()->json($products);
    }

    /**
     * Display a listing of the Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShoppingInterests(Request $request)
    {           
        $products = $this->getFormatSelect2(Auth::user()->shoppingInterestsLists());

        return response()->json($products);
    }

    /**
     * Display a listing of the Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductionProducts(Request $request)
    {           
        $products = $this->getFormatSelect2(Auth::user()->productionProductsLists());

        return response()->json($products);
    }

    /**
     * Display a listing of the Units.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUnits()
    {
        $units = ['kg' => 'Kilogramos', 'canastilla' => 'Canastilla'];
        return response()->json($this->getFormatSelect2($units));
    }

    /**
     * Display a listing of the Units.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMonths()
    {
        $months = Production::$months;
        return response()->json($this->getFormatSelect2($months));
    }

    /**
     * Display a listing of the Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProducers(Request $request)
    {   
        $productId = $request->get('product_id');        
        $subregion = $request->get('subregion');
        $months    = $request->get('months');

        $producers  = User::searchProducers($productId, $subregion, $months); 
        
        return response()->json(['success' => true, 'producers' => $producers]);
    }

    /**
     * Display a listing of the Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getShopkeepers(Request $request)
    {   
        $productId      = $request->get('product_id');   
        $municipalities = $request->get('municipalities');

        $shopkeepers  = User::searchShopkeepers($productId, $municipalities); 

        return response()->json(['success' => true, 'shopkeepers' => $shopkeepers]);
    }

}
