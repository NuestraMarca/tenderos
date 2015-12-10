<?php

namespace Tenderos\Http\Controllers\Admin;

use Illuminate\Routing\Route;
use Tenderos\Http\Controllers\Controller;
use Tenderos\Http\Requests\Categories\Products\CreateRequest;
use Tenderos\Http\Requests\Categories\Products\EditRequest;
use Tenderos\Entities\Category;
use Tenderos\Entities\Product;
use Flash;

class CategoriesProductsController extends Controller
{
    private $category;
    private $product;
    private $form_data;

    private static $prefixRoute = 'admin.categories.products.';
    private static $prefixView = 'dashboard.pages.admin.';

    public function __construct()
    {
        $this->beforeFilter('@newProduct', ['only' => ['index', 'store']]);
        $this->beforeFilter('@findCategory');
        $this->beforeFilter('@findProduct', ['only' => ['show', 'edit', 'update']]);
    }

    /**
     * Create a new Category.
     */
    public function newProduct()
    {
        $this->product = new Product();
    }

    /**
     * Find the Category or App Abort 404.
     */
    public function findCategory(Route $route)
    {
        $this->category = Category::findOrFail($route->getParameter('categories'));
    }

    /**
     * Find the Product of Category or App Abort 404.
     */
    public function findProduct(Route $route)
    {
        $this->product = $this->category->products()->findOrFail($route->getParameter('products'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form', array $vars = array())
    {
        return view(self::$prefixView . $viewName)
            ->with(['form_data' => $this->form_data, 'category' => $this->category, 'product' => $this->product] + $vars);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($category_id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->category->id], 'method' => 'POST'];
        $products = $this->category->products()->paginate(20);

        return $this->getFormView('category', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request, $category_id)
    {
        $this->product->fill($request->all());
        $this->category->products()->save($this->product);

        Flash::info('Producto '.$this->product->name.' Guardado correctamente');

        return redirect()->route(self::$prefixRoute.'index', $this->category->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $category_id
     * @param int $product_id
     *
     * @return Response
     */
    public function show($category_id, $product_id)
    {
        return redirect()->route(self::$prefixRoute . 'edit', [$category_id, $product_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($category_id, $product_id)
    {
        $this->form_data = [
            'route' => [self::$prefixRoute.'update', $this->category->id, $this->product->id],
            'method' => 'PUT'
        ];

        return $this->getFormView('product');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(EditRequest $request, $category_id, $product_id)
    {
        $this->product->fill($request->all());
        $this->product->save();

        Flash::info('Producto '.$this->product->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute.'index', $this->category->id);
    }
}
