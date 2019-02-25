<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PutCategoryRequest extends FormRequest
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
        $id = $this->category->id;
        return [
            'name' => 'required|unique:categories,name,' . $id,
            'parent_id' => 'nullable|exists:categories,id',
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
            'parent_id.exists' => trans('category.request.category_exists'),
        ];
    }
}
