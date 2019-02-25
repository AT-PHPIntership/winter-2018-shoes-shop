<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Profile;

class PostUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
            'name' => 'required',
            'gender' => 'nullable|in:'.Profile::OTHER.','.Profile::MALE.','.Profile::FEMALE.'',
            'address' => 'max:255',
            'phonenumber' => 'nullable|numeric|min:10',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role_id' => 'required|exists:m_roles,id'
        ];
    }
}
