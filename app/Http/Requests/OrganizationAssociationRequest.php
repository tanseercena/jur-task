<?php

namespace App\Http\Requests;

use App\Rules\MaxWordsRule;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationAssociationRequest extends FormRequest
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
            'name' => 'required',
            'associated_as' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'date|nullable',
            'description' => ['required', new MaxWordsRule(100)],   // Created custom rule for word count
        ];
    }
}
