<?php

namespace Tenderos\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Database\QueryException;
use Tenderos\Http\Controllers\Controller;
use Tenderos\Http\Requests\Categories\CreateRequest;
use Tenderos\Http\Requests\Categories\EditRequest;
use Tenderos\Entities\Category;
use Flash;

class CategoriesController extends Controller
{
    private $category;
    private $form_data;

    private static $prefixRoute = 'admin.categories.';
    private static $prefixView = 'dashboard.pages.admin.';

    public function __construct()
    {
        $this->beforeFilter('@newCategory', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findCategory', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * Create a new Category.
     */
    public function newCategory()
    {
        $this->category = new Category();
    }

    /**
     * Find the Category or App Abort 404.
     */
    public function findCategory(Route $route)
    {
        $this->category = Category::findOrFail($route->getParameter('categories'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form', array $vars = array())
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'category' => $this->category] + $vars);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::paginate(20);
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST'];

        return $this->getFormView('categories', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $this->category->fill($request->all());
        $this->category->save();

        Flash::info('Categoria ' . $this->category->name . ' Guardada correctamente');

        return redirect()->route(self::$prefixRoute.'index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return redirect()->route(self::$prefixRoute . 'products.index', $this->category->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(EditRequest $request, $id)
    {
        $this->category->fill($request->all());
        $this->category->save();

        Flash::info('Categoria '.$this->category->name.' Actualizada correctamente');

        return redirect()->route(self::$prefixRoute . 'products.index', $this->category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data = [
            'success' => true,
            'message' => 'Categoria eliminada correctamente'
        ];   

        try {
            $this->category->delete(); 
        } catch (QueryException $e) {
            $data['success'] = false;
            $data['message'] = 'La Categoria no se puede eliminar, ya que contiene almenos un Producto';
        }

        return response()->json($data);
    }
}
