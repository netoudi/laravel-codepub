<?php

namespace Modules\CodeUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (($this->getMethod() === 'DELETE' || $this->getMethod() === 'PUT') && Auth::user()->isAdmin()) {
            return $this->route('role')->name !== config('codeuser.acl.role_admin');
        }

        return Auth::user()->isAdmin();
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
                'name' => 'required|max:255|unique:roles,name,' . (int) $this->route('role')->id,
                'description' => 'max:255',
            ];
        }

        return [
            'name' => 'required|max:255|unique:roles',
            'description' => 'max:255',
        ];
    }
}
