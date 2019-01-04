<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:5|max:255|',
                    'confirm_password' => 'required|same:password',
                    'name' => 'required',
                    'gender' => 'numeric|max:2',
                    'address' => 'required|max:255',
                    'phonenumber' => 'required|numeric|min:10',
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'role_id' => 'required'
                ];
            default:
                break;
        }
    }
}
