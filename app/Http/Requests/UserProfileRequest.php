<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserProfileRequest extends FormRequest
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
        if ($request->provider) {
            $email = 'nullable|unique:users,email,' . $request->id;
        } else {
            $email = 'required|string|email|max:255|unique:users,email,' . $request->id;
        }

        return [
            'name' => 'required|string|max:50',
            'email' => $email,
            'image' => 'image',
        ];
    }
}
