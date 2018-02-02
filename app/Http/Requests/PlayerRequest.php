<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:50',
            'description' => 'max:255',
            'avatar' => 'image',
            'birthday' => 'required|digits:4|after:1900|before:2156|integer|date_format:Y',
            'team_id' => 'required|integer|not_in:0',
            'country_id' => 'required|integer|not_in:0',
            'position_id' => 'required|integer|not_in:0',
        ];
    }
}
