<?php

namespace Tenderos\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Database\QueryException;
use Tenderos\Http\Controllers\Controller;
use Tenderos\Http\Requests\Shopkeepers\CreateRequest;
use Tenderos\Http\Requests\Shopkeepers\EditRequest;
use Tenderos\Entities\User;
use Flash;

class ShopkeepersController extends Controller
{
    private $shopkeeper;
    private $form_data;

    private static $prefixRoute = 'shopkeepers.';
    private static $prefixView = 'dashboard.pages.companies.users.shopkeepers.';

    public function __construct()
    {
        $this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }


    /**
     * Find the User or App Abort 404.
     */
    public function findUser(Route $route)
    {
        $this->shopkeeper = User::findOrFail($route->getParameter('shopkeepers'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form')
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'shopkeeper' => $this->shopkeeper]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view()->make(self::$prefixView.'list');
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
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->shopkeeper->id], 'method' => 'PUT', 'files' => true];

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

        Flash::info('Tender '.$this->shopkeeper->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute.'index');
    }
}
