<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamAchievementRequest extends FormRequest
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
            'name' => 'required|string|max:150',
            'team_id' => 'required|integer|not_in:0',
            'match_id' => 'required|integer|not_in:0',
        ];
    }
}
