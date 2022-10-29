<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
        ];
    }
    public function messages()
    {
        return [
            'name_ar.required' => 'input required in arabic',
            'name_ar.string' => 'input must be string',
            'name_en.string' => 'input must be string',
            'name_en.required' => 'input required in english',
        ];
    }
}
