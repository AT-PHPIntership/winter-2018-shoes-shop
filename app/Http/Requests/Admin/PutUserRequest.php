<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Profile;

class PutUserRequest extends FormRequest
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
            'name' => 'required',
            'gender' => 'in:'.Profile::OTHER.','.Profile::MALE.','.Profile::FEMALE.'',
            'address' => 'required|max:255',
            'phonenumber' => 'required|numeric|min:10',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role_id' => 'required|exists:m_roles,id'
        ];
    }
}