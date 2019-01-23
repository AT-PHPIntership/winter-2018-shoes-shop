<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PutProductRequest extends FormRequest
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
        $data = $this->request->all();
        if (!isset($data['color_id'])) {
            return [
                'name' => 'required|unique:products,name',
                'category_id' => 'exists:categories,id|nullable',
                'original_price' => 'required|numeric',
            ];
        }
        return [
            'name' => 'required|unique:products,name',
            'category_id' => 'exists:categories,id|nullable',
            'original_price' => 'required|numeric',
            'color_id.*' => 'exists:colors,id',
            'size_id.*' => 'exists:colors,id',
            'quantity_type.*' => 'required|numeric',
        ];
    }
}
