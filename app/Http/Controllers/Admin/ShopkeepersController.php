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

class UsersController extends Controller
{
    private $user;
    private $form_data;

    private static $prefixRoute = 'admin.users.';
    private static $prefixView = 'dashboard.pages.admin.';

    public function __construct()
    {
        $this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * Find the User or App Abort 404.
     */
    public function findUser(Route $route)
    {
        $this->user = User::findOrFail($route->getParameter('users'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form', array $vars = array())
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'user' => $this->user] + $vars);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::paginate(20);
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST'];

        return $this->getFormView('users', ['users' => $users]);
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
            'route' => [self::$prefixRoute.'update', $this->user->id],
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
        $this->user->fill($request->all());
        $this->user->save();

        Flash::info('Tendero '.$this->user->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute . 'index', $this->user->id);
    }
}
