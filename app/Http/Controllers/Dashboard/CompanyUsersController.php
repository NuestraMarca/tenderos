<?php

namespace Tenderos\Http\Controllers\Dashboard;

use Illuminate\Routing\Route;
use Tenderos\Http\Controllers\Controller;
use Tenderos\Http\Requests\Companies\Users\CreateRequest;
use Tenderos\Http\Requests\Companies\Users\EditRequest;
use Tenderos\Entities\Company;
use Tenderos\Entities\User;
use Flash;

class CompanyUsersController extends Controller
{
    private $company;
    private $user;
    private $form_data;

    private static $prefixRoute = 'companies.users.';
    private static $prefixView = 'dashboard.pages.companies.users.superadmin.';

    public function __construct()
    {
        $this->beforeFilter('@newUser', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findCompany');
        $this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update']]);
    }

    /**
     * Create a new Company.
     */
    public function newUser()
    {
        $this->user = new User(['type' => 'admin']);
    }

    /**
     * Find the Company or App Abort 404.
     */
    public function findCompany(Route $route)
    {
        $this->company = Company::findOrFail($route->getParameter('companies'));
    }

    /**
     * Find the User of Company or App Abort 404.
     */
    public function findUser(Route $route)
    {
        $this->user = $this->company->users()->findOrFail($route->getParameter('users'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView()
    {
        return view(self::$prefixView.'form')
            ->with(['form_data' => $this->form_data, 'company' => $this->company, 'user' => $this->user]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($company_id)
    {
        $users = $this->company->userAdmins();

        return view()->make(self::$prefixView.'list', compact('users'))
            ->with(['company' => $this->company]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($company_id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'store', $this->company->id], 'method' => 'POST', 'files' => true];

        return $this->getFormView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request, $company_id)
    {
        $this->user->fill($request->all());
        $this->company->users()->save($this->user);
        $this->user->uploadImage($request->file('url_photo'));
        Flash::info('Administrador '.$this->user->name.' Guardado correctamente');

        return redirect()->route(self::$prefixRoute.'index', $this->company->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $company_id
     * @param int $user_id
     *
     * @return Response
     */
    public function show($company_id, $user_id)
    {
        return View::make(self::$prefixView.'.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($company_id, $user_id)
    {
        $this->form_data = [
            'route' => [self::$prefixRoute.'update', $this->company->id, $this->user->id],
            'method' => 'PUT', 'files' => true,
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
    public function update(EditRequest $request, $company_id, $user_id)
    {
        $this->user->fill($request->all());
        $this->user->save();
        $this->user->uploadImage($request->file('url_photo'));
        Flash::info('Administrador '.$this->user->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute.'index', $this->company->id);
    }
}
