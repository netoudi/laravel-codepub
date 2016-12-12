<?php

namespace CodePub\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('book') ? $this->route('book')->user_id == $this->user()->id : true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'subtitle' => 'required|max:255',
            'price' => 'required|numeric',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ];
    }

    public function messages()
    {
        $result = [];
        $categories = $this->get('categories', []);
        $count = count($categories);

        if (is_array($categories) && $count > 0) {
            foreach (range(0, $count - 1) as $value) {
                $field = Lang::get('validation.attributes.categories_*', ['num' => $value + 1]);
                $message = Lang::get('validation.exists', ['attribute' => $field]);
                $result["categories.{$value}.exists"] = $message;
            }
        }

        return $result;
    }
}
