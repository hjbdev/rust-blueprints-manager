<?php

namespace App\Http\Requests\Blueprints;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ResearchBlueprintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'blueprint' => [
                'string',
                'required',
                'exists:blueprints,name'
            ],
            'user' => [
                'numeric',
                'required',
                'exists:users,id',
                function($attribute, $value, $fail) {
                    $user = User::find($value);

                    if(!$user) {
                        $fail('This user does not exist.');
                    }

                    if(!auth()->user()->currentTeam->hasUser(User::find($value))) {
                        $fail('This user is not in your team');
                    }
                }
            ]
        ];
    }
}
