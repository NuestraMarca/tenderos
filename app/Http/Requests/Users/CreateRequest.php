<?php

namespace Tenderos\Http\Requests\Users;

use Tenderos\Http\Requests\Request;
use Tenderos\Http\Controllers\Auth\AuthController;

class CreateRequest extends Request
{
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
        return AuthController::getRules();
    }
}
