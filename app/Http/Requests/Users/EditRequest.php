<?php

namespace Tenderos\Http\Requests\Users;

use Tenderos\Http\Requests\Request;
use Illuminate\Routing\Route;

class EditRequest extends Request
{
    /**
     * @var Route
     */
    private $route;
    private $createRequest;

    public function __construct(Route $route)
    {
        $this->route = $route;
        $this->createRequest = new CreateRequest();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route->getParameter('tenderos');

        if(is_null($id)){
            $id = $this->route->getParameter('productores');            
        }

        $rules = $this->createRequest->rules();
        $rules['username'] .= ',username,'. $id .',id';
        $rules['doc'] .= ',doc,'. $id .',id';
        $rules['email'] .= ',email,'. $id .',id';
        $rules['password'] = 'confirmed';
        $rules['terms'] = '';

        return $rules;
    }
}
