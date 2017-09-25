<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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

    function rules()
    {
        switch($this->method()) {
            case "POST":
                return [
                    'fullname'=>'required',
                    'email' => 'required|unique:users',
                    'password'=>'required|min:6|confirmed',
                ];
            break;
            case "PUT":
                return [
                    'fullname'=>'required',
                    'password'=>'required|min:6|confirmed',
                ];
            break;
        }
    }
}
