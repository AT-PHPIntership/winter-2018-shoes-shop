<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class GetReviewRequest extends FormRequest
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
            'productId' => 'required|exists:products,id',
            'page' => 'required|numeric',
            'sort' => 'required|in:0,1',
            'isBuy' => 'required|in:0,1',
            'star' => 'required|in:0,1,2,3,4,5',
        ];
    }
}
