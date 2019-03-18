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
            'current_password' => 'required_with:password',
            'password' => 'nullable|min:6|confirmed|required_with:current_password',
            'gender' => 'in:'.Profile::OTHER.','.Profile::MALE.','.Profile::FEMALE.'',
            'address' => 'max:255',
            'phonenumber' => 'nullable|numeric|min:10',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role_id' => 'required|exists:m_roles,id'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param \Illuminate\Validation\Validator $validator validator
     *
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!empty($this->current_password) && !\Hash::check($this->current_password, \Auth::user()->password)) {
                $validator->errors()->add('current_password', __('user.wrong_password'));
            }
        });
    }
}
