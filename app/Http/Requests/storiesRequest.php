<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storiesRequest extends FormRequest
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
            'story_name'=>'required',
            'author_id'=>'required',
            'story_type'=>'required',
            'story_intro'=>'required',
            'story_rating'=>'required',
            'story_view'=>'required|numeric',
            'story_sum_chapter'=>'required|numeric',
            'story_source'=>'required',
            'story_status'=>'required',
            'story_price'=>'required'
        ];
    }
    public function messages(){
        return [
            'type_name.required' =>'Không được để trống',
            'story_name.required' =>'Không được để trống',
            'author_id.required' =>'xin hãy lựa chọn',
            'story_type.required' =>'xin hãy lựa chọn',
            'story_intro.required' =>'xin hãy viết mô tả cho truyện',
            'story_rating.required' =>'xin hãy lựa chọn',
            'story_view.required' =>'Không được để trống',
            'story_sum_chapter.required' =>'Không được để trống',
            'story_source.required' =>'Không được để trống',
            'story_status.required' =>'xin hãy lựa chọn',
            'story_price.required' =>'xin hãy lựa chọn',
            'story_sum_chapter.numeric' =>'chỉ được nhập số',
            'story_view.numeric' =>'chỉ được nhập số',
        ];
    }
}
