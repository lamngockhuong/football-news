<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CountryRequest extends FormRequest    
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
                    'name' => 'required|string|max:50|unique:countries,name',
                ];
            case 'PUT':
                return [
                    'name' => 'required|string|max:50|unique:countries,name,' . $request->get('id'),
                ];
        }
    }
}
