<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Order;

class PutOrderRequest extends FormRequest
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
            'status' => 'in:'.Order::CONFIRMED_STATUS.','.Order::PROCESSING_STATUS.','.Order::QUALITY_CHECK_STATUS.','.Order::DISPATCHED_ITEM_STATUS.','.Order::DELIVERED_STATUS.','.Order::CANCELED_STATUS.','.Order::PENDING_STATUS.'',
        ];
    }
}
