<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storyDetailRequest extends FormRequest
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
            'chapter' =>'required|numeric',
            'chapter_content' =>'required',
            'chapter_name' =>'required'
        ];
    }
    public function messages(){
        return [
            'chapter.required' =>'Không được để trống',
            'chapter_content.required' =>'Không được để trống',
            'chapter_name.required' =>'Không được để trống',
            'chapter.numeric' =>'chỉ được nhập số',
        ];
    }
}
