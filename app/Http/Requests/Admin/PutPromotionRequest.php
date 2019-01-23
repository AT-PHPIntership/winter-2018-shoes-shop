<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PutPromotionRequest extends FormRequest
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
            'name' => 'required|unique:promotions,name,'.$this->promotion->id,
            'product_id' => 'exists:products,id',
            'percent' => 'required|numeric|min:1|max:100',
            'max_sell' => 'required|numeric',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|after:start_date',
        ];
    }
}