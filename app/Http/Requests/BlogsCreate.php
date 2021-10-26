<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogsCreate extends FormRequest
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
            'title' => 'required|min:2',
            'description' => 'required|min:2',
        ];
    }
     /**
     * @return array
     */
    public function messages()
    {
        return [
            'title.min' => 'Не менее двух букв',
            'title.required' => 'Это поле не может быть пустым',
            'description.min' => 'Не менее двух букв',
            'description.required' => 'Это поле не может быть пустым'
        ];
    }
}
