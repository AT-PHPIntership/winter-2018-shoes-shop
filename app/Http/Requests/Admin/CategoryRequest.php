<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        switch($this->method()) {
            case 'POST':
                $id = '';
                break;
            case 'PUT':
                $id = $this->category->id;
                break;
        }
        return [
            'name' => 'required|unique:categories,name,' . $id,
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => trans('category.request.required'),
            'name.unique' => trans('category.request.unique'),
        ];
    }
}
