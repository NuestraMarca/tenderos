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

class ProducersController extends Controller
{
    private $producer;
    private $form_data;

    private static $prefixRoute = 'admin.productores.';
    private static $prefixView = 'dashboard.pages.admin.producers.';

    public function __construct()
    {
        $this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * Find the User or App Abort 404.
     */
    public function findUser(Route $route)
    {
        $this->producer = User::findOrFail($route->getParameter('productores'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form', array $vars = array())
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'producer' => $this->producer] + $vars);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $producers = User::notAdmins()->orderBy('name')->paginate(20);
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST'];

        return $this->getFormView('lists', ['producers' => $producers]);
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
            'route' => [self::$prefixRoute.'update', $this->producer->id],
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
        $this->producer->fill($request->all());
        $this->producer->save();

        Flash::info('Productor '.$this->producer->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute . 'index');
    }

    public function shopping($id)
    {
        return view(self::$prefixView . 'shopping')
             ->with('user', $this->producer); 
    }
}
