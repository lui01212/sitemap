<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storyAuthorRequest extends FormRequest
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
            'author_name' =>'required|max:100'
        ];
    }
    public function messages(){
        return [
            'author_name.required' =>'Không được để trống'
        ];
    }
}
