<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Review;

class PostReviewRequest extends FormRequest
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
            'title' => 'max:100',
            'content' => 'required|max:255',
            'star' => 'required|in:'.implode(',', Review::NUMBER_STAR),
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
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
            'title.max' => trans('index.detail.review.errors.title.max'),
            'content.required' => trans('index.detail.review.errors.content.required'),
            'content.max' => trans('index.detail.review.errors.content.max'),
            'star.required' => trans('index.detail.review.errors.star.required'),
            'star.in' => trans('index.detail.review.errors.star.in'),
            'image.image' => trans('index.detail.review.errors.image.image'),
            'image.mimes' => trans('index.detail.review.errors.image.mimes'),
            'image.max' => trans('index.detail.review.errors.image.max'),
        ];
    }
}
