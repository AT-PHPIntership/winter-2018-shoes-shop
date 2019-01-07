<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CodeRequest extends FormRequest
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
            'name' => 'required|unique:codes,name',
            'category_id' => 'required|numeric|exists:categories,id',
            'percent' => 'required|numeric|min:1|max:100',
            'times' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}