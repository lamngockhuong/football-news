<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BetRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'match_id' => 'required|integer|not_in:0',
                    'team1_goal' => 'required|integer',
                    'team2_goal' => 'required|integer',
                    'coin' => 'required|integer|not_in:0',
                ];
            case 'PUT':
                return [
                    'team1_goal' => 'required|integer',
                    'team2_goal' => 'required|integer',
                    'coin' => 'required|integer|not_in:0',
                ];
        }
    }
}
