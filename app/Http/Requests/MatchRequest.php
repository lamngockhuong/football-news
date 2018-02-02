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
        return [
            'name' => 'required|string|max:100',
            'description' => 'max:255',
            'team1_id' => 'required|integer|not_in:0',
            'team2_id' => 'required|integer|not_in:0',
            'team1_goal' => 'integer',
            'team2_goal' => 'integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'league_id' => 'required|integer|not_in:0',
        ];
    }
}
