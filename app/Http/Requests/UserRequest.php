<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:50',
                    'coin' => 'required|integer',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'password' => 'required|string|min:6',
                    'image' => 'image',
                    'is_actived' => 'required|integer|between:0,1',
                    'is_admin' => 'required|integer|between:0,1',
                ];
            case 'PUT':
                if ($request->provider) {
                    $email = 'nullable|unique:users,email,' . $request->id;
                    $password = 'nullable';
                } else {
                    $email = 'required|string|email|max:255|unique:users,email,' . $request->id;
                    $password = 'required|string|min:6';
                }

                return [
                    'name' => 'required|string|max:50',
                    'coin' => 'required|integer',
                    'email' => $email,
                    'password' => $password,
                    'image' => 'image',
                    'is_actived' => 'required|integer|between:0,1',
                    'is_admin' => 'required|integer|between:0,1',
                ];
        }
    }
}
