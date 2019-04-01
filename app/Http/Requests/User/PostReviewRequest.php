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
            'content' => 'required|between:50,255',
            'star' => 'required|in:'.implode(',', Review::NUMBER_STAR),
            'images' => 'max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_id' => 'required|exists:products,id',
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
            'content.between' => trans('index.detail.review.errors.content.between'),
            'star.required' => trans('index.detail.review.errors.star.required'),
            'star.in' => trans('index.detail.review.errors.star.in'),
            'images.*.image' => trans('index.detail.review.errors.image.image'),
            'images.*.mimes' => trans('index.detail.review.errors.image.mimes'),
            'images.*.max' => trans('index.detail.review.errors.image.max'),
        ];
    }
}
