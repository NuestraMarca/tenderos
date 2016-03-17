<?php

namespace Tenderos\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Database\QueryException;
use Tenderos\Http\Controllers\Controller;
use Tenderos\Http\Requests\Users\CreateRequest;
use Tenderos\Http\Requests\Users\EditRequest;
use Tenderos\Entities\User;
use Flash;

class ShopkeepersController extends Controller
{
    private $shopkeeper;
    private $form_data;

    private static $prefixRoute = 'admin.tenderos.';
    private static $prefixView = 'dashboard.pages.admin.shopkeepers.';

    public function __construct()
    {
        $this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy', 'shopping']]);
    }

    /**
     * Find the User or App Abort 404.
     */
    public function findUser(Route $route)
    {
        $this->shopkeeper = User::findOrFail($route->getParameter('tenderos'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form', array $vars = array())
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'shopkeeper' => $this->shopkeeper] + $vars);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $shopkeepers = User::paginate(20);
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST'];

        return $this->getFormView('lists', ['shopkeepers' => $shopkeepers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->form_data = [
            'route' => [self::$prefixRoute.'update', $this->shopkeeper->id],
            'method' => 'PUT'
        ];

        return $this->getFormView();
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
        $this->shopkeeper->fill($request->all());
        $this->shopkeeper->save();

        Flash::info('Tendero '.$this->shopkeeper->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute . 'index', $this->shopkeeper->id);
    }

    public function shopping($id)
    {
        return view(self::$prefixView . 'shopping')
            ->with('user', $this->shopkeeper); 
    }
}
