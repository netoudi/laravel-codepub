<?php

namespace Modules\CodeUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->getMethod() === 'DELETE') {
            return $this->route('user')->id !== Auth::user()->id;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->getMethod() === 'DELETE') {
            return [];
        }

        if ($this->getMethod() === 'PUT') {
            return [
                'name' => 'required|max:255',
                'email' => 'required|max:255|email|unique:users,email,' . (int) $this->route('user')->id,
            ];
        }

        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required|confirmed|min:6|max:15',
        ];
    }
}
