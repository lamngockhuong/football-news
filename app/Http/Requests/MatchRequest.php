<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest
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
                    'name' => 'required|string|max:100',
                    'description' => 'max:255',
                    'team1_id' => 'required|integer|not_in:0',
                    'team2_id' => 'required|integer|not_in:0|different:team1_id',
                    'start_time' => 'required|date',
                    'end_time' => 'required|date|after:start_time',
                    'league_id' => 'required|integer|not_in:0',
                ];
        case 'PUT':
            return [
                    'name' => 'required|string|max:100',
                    'description' => 'max:255',
                    'team1_id' => 'required|integer|not_in:0',
                    'team2_id' => 'required|integer|not_in:0|different:team1_id',
                    'team1_goal' => 'integer',
                    'team2_goal' => 'integer',
                    'start_time' => 'required|date',
                    'end_time' => 'required|date|after:start_time',
                    'league_id' => 'required|integer|not_in:0',
                ];
        }
    }
}
