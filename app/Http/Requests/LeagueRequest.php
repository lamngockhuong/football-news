<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LeagueRequest extends FormRequest
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
                    'name' => 'required|string|max:100|unique:leagues,name,year',
                    'description' => 'max:255',
                    'year' => 'required|digits:4|after:1900|before:2156|integer|date_format:Y',
                ];
            case 'PUT':
                return [
                    'name' => 'required|string|max:100|unique:leagues,name,' . $request->get('id'),
                    'description' => 'max:255',
                    'year' => 'required|digits:4|after:1900|before:2156|integer|date_format:Y',
                ];
        }
    }
}
