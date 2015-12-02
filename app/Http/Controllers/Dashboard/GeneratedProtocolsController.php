<?php

namespace Tenderos\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Tenderos\Http\Requests;
use Tenderos\Http\Requests\ProtocolGenerator\FormRequest;
use Tenderos\Http\Controllers\Controller;
use Tenderos\Entities\GeneratedProtocol;
use Auth, Flash, App;

class GeneratedProtocolsController extends Controller
{
    private $generatedProtocol;
    private $form_data;

    private static $prefixRoute = 'generated-protocols.';
    private static $prefixView = 'dashboard.pages.companies.users.protocols.generator.';

    public function __construct()
    {
        $this->beforeFilter('@newGeneratedProtocol', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findGeneratedProtocol', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * Create a new GeneratedProtocol.
     */
    public function newGeneratedProtocol()
    {
        $this->generatedProtocol = new GeneratedProtocol();
    }

    /**
     * Find the GeneratedProtocol or App Abort 404.
     */
    public function findGeneratedProtocol(Route $route)
    {
        $this->generatedProtocol = GeneratedProtocol::findOrFail($route->getParameter('generated_protocols'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form')
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'generatedProtocol' => $this->generatedProtocol]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view()->make(self::$prefixView.'list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST'];

        return $this->getFormView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Tenderos\Http\Requests\ProtocolGenerator\FormRequest
     * @return \Illuminate\Http\Response
     */
    public function store(FormRequest $request)
    {
        $this->generatedProtocol->fill($request->all());
        Auth::user()->generatedProtocols()->save($this->generatedProtocol);
        $this->generatedProtocol->questions()->sync($request->get('questions'));

        Flash::info('Protocolo generado correctamente');
        return redirect()->route(self::$prefixRoute.'index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->generatedProtocol->load(['user', 'questions' => function ($query) {
            $query->orderBy('order', 'asc');    
        }]);

        $view = view()->make(self::$prefixView.'download')
            ->with(['generatedProtocol' => $this->generatedProtocol])
            ->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->save('storage/generatedProtocols/' . $this->generatedProtocol->id . '.pdf');

        return $pdf->stream('generatedProtocol.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->generatedProtocol->id], 'method' => 'PUT'];

        return $this->getFormView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Tenderos\Http\Requests\ProtocolGenerator\FormRequest
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormRequest $request, $id)
    {
        $this->generatedProtocol->fill($request->all());
        $this->generatedProtocol->save();
        $this->generatedProtocol->questions()->sync($request->get('questions'));

        Flash::info('Protocolo generado correctamente');
        return redirect()->route(self::$prefixRoute.'index');
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
