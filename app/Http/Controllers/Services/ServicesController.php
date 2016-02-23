<?php

namespace Tenderos\Http\Controllers\Services;

use Illuminate\Http\Request;

use Tenderos\Http\Requests;
use Tenderos\Http\Controllers\Controller;

use Tenderos\Entities\Product;
use Tenderos\Entities\User;
use Tenderos\Entities\ShoppingInterest;
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
        //$products = $this->getFormatSelect2(Auth::user()->shoppingInterestsLists());
        $products = $this->getFormatSelect2(Product::allLists());

        return response()->json($products);
    }

    /**
     * Display a listing of the Products.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductionProducts(Request $request)
    {           
        // $products = $this->getFormatSelect2(Auth::user()->productionProductsLists());
        $products = $this->getFormatSelect2(Product::getAllWithProductionLists());

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
        $communes       = $request->get('communes');

        $shopkeepers  = User::searchShopkeepers($productId, $communes); 

        return response()->json(['success' => true, 'shopkeepers' => $shopkeepers]);
    }

    public function getCommuneStatistics()
    {
        $communes = User::notAdmins()
            ->select('commune', 'type', \DB::raw('COUNT(*) as total'))
            ->groupBy('commune', 'type')
            ->orderBy('commune', 'asc')
            ->get()
            ->groupBy('commune');
        
        $stat = [
            'content' => [
                ['label' => 'Número de tenderos', 'data' => [] ],
                ['label' => 'Número de productores', 'data' => [] ]
            ],
            'names' => []
        ];

        $count = 0;

        foreach ($communes as $commune => $types) {
            foreach ($types as $type) {
                if($type->type == 'shopkeeper') {
                    array_push($stat['content'][0]['data'], [$count + 1, $type->total]);
                }
                else {
                    array_push($stat['content'][1]['data'], [$count + 2, $type->total]);    
                }
            }

            if($types->count() < 2) {
                if($types->first()->type == 'producer') {
                    array_push($stat['content'][0]['data'], [$count + 1, 1]);
                }
                else {
                    array_push($stat['content'][1]['data'], [$count + 2, 1]);    
                }
            }

            if($commune > 0) {
                array_push($stat['names'], [$count + 2, 'Comuna ' . $commune]);    
            }
            else{
                array_push($stat['names'], [$count + 2, 'Fuera de Villavicencio']);
            }

            $count += 2.5;
        }

        return $stat;
    }

    public function getCommuneShoppingStatistics()
    {
        $products = ShoppingInterest::select('commune', 'product_id', 'products.name', \DB::raw('SUM(amount) as total'))
            ->join('users', 'users.id', '=', 'user_id')
            ->join('products', 'products.id', '=', 'product_id')
            ->whereUnit('kg')
            ->orderBy('product_id', 'asc')
            ->orderBy('commune', 'asc')
            ->groupBy('product_id', 'commune')
            ->get()
            ->groupBy('name');

        $stat = [
            'content' => [
                ['label' => 'Fuera de Villavicencio', 'data' => [] ],
                ['label' => 'Comuna 1', 'data' => [] ],
                ['label' => 'Comuna 2', 'data' => [] ],
                ['label' => 'Comuna 3', 'data' => [] ],
                ['label' => 'Comuna 4', 'data' => [] ],
                ['label' => 'Comuna 5', 'data' => [] ],
                ['label' => 'Comuna 6', 'data' => [] ],
                ['label' => 'Comuna 7', 'data' => [] ],
                ['label' => 'Comuna 8', 'data' => [] ]
            ],
            'names' => []
        ];

        $count = 0;

        foreach ($products as $product => $communes) {
            foreach ($communes as $commune) {
                array_push($stat['content'][$commune->commune]['data'], [$count + $commune->commune + 1, $commune->total]);    
            }

            array_push($stat['names'], [$count + 5, $product]);

            $count += 10;
        }

        return $stat;
    }

    public function getCommuneAvgShoppingStatistics()
    {
        $products = ShoppingInterest::select('commune', 'product_id', 'products.name', \DB::raw('AVG(amount) as total'))
            ->join('users', 'users.id', '=', 'user_id')
            ->join('products', 'products.id', '=', 'product_id')
            ->whereUnit('kg')
            ->orderBy('product_id', 'asc')
            ->orderBy('commune', 'asc')
            ->groupBy('product_id', 'commune')
            ->get()
            ->groupBy('name');

        $stat = [
            'content' => [
                ['label' => 'Fuera de Villavicencio', 'data' => [] ],
                ['label' => 'Comuna 1', 'data' => [] ],
                ['label' => 'Comuna 2', 'data' => [] ],
                ['label' => 'Comuna 3', 'data' => [] ],
                ['label' => 'Comuna 4', 'data' => [] ],
                ['label' => 'Comuna 5', 'data' => [] ],
                ['label' => 'Comuna 6', 'data' => [] ],
                ['label' => 'Comuna 7', 'data' => [] ],
                ['label' => 'Comuna 8', 'data' => [] ]
            ],
            'names' => []
        ];

        $count = 0;

        foreach ($products as $product => $communes) {
            foreach ($communes as $commune) {
                array_push($stat['content'][$commune->commune]['data'], [$count + $commune->commune + 1, $commune->total]);    
            }

            array_push($stat['names'], [$count + 5, $product]);

            $count += 10;
        }

        return $stat;
    }

    public function getCommuneCountShoppingStatistics()
    {
        $products = ShoppingInterest::select('commune', 'product_id', 'products.name', \DB::raw('count(distinct user_id) as total'))
            ->join('users', 'users.id', '=', 'user_id')
            ->join('products', 'products.id', '=', 'product_id')
            ->where('amount', '>', 0)
            ->orderBy('product_id', 'asc')
            ->orderBy('commune', 'asc')
            ->groupBy('product_id', 'commune')
            ->get()
            ->groupBy('name');

        $stat = [
            'content' => [
                ['label' => 'Fuera de Villavicencio', 'data' => [] ],
                ['label' => 'Comuna 1', 'data' => [] ],
                ['label' => 'Comuna 2', 'data' => [] ],
                ['label' => 'Comuna 3', 'data' => [] ],
                ['label' => 'Comuna 4', 'data' => [] ],
                ['label' => 'Comuna 5', 'data' => [] ],
                ['label' => 'Comuna 6', 'data' => [] ],
                ['label' => 'Comuna 7', 'data' => [] ],
                ['label' => 'Comuna 8', 'data' => [] ]
            ],
            'names' => []
        ];

        $count = 0;

        foreach ($products as $product => $communes) {
            foreach ($communes as $commune) {
                array_push($stat['content'][$commune->commune]['data'], [$count + $commune->commune + 1, $commune->total]);    
            }

            array_push($stat['names'], [$count + 6, $product]);

            $count += 12;
        }

        return $stat;
    }

    public function getCommunesStatistics(Request $request)
    {
        $commune = ($request->get('commune')) ? $request->get('commune') : 1;

        $products = ShoppingInterest::select('product_id', 'products.name', \DB::raw('SUM(amount) as total'))
            ->join('users', 'users.id', '=', 'user_id')
            ->join('products', 'products.id', '=', 'product_id')
            ->whereUnit('kg')
            ->whereCommune($commune)
            ->orderBy('product_id', 'asc')
            ->groupBy('product_id')
            ->get();

        $stat = [
            'content' => [
                ['label' => 'Compra de Producto en KG', 'data' => [] ],
            ],
            'names' => []
        ];

        $count = 0;

        foreach ($products as $product) {
            array_push($stat['content'][0]['data'], [$count, $product->total]);    
            array_push($stat['names'], [$count + 0.5, $product->name . ' (' . $product->total . ') ']);

            $count += 1.5;
        }

        return $stat;
    }

}
