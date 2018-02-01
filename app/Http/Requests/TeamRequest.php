<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TeamRequest extends FormRequest
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
                'name' => 'required|string|max:100|unique:teams,name',
                'description' => 'max:255',
                'image' => 'image',
                'country_id' => 'required|integer|not_in:0',
            ];
        case 'PUT':
            return [
                'name' => 'required|string|max:100|unique:teams,name,' . $request->get('id'),
                'description' => 'max:255',
                'image' => 'image',
                'country_id' => 'required|integer|not_in:0',
            ];
        }
    }
}
