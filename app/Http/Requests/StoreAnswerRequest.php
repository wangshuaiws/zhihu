<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
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
    public function messages()
    {
        return [
            'body.required' => '答案不能为空.',
            'body.min' => '答案最少为20个字符',
        ];
    }

    public function rules()
    {
        return [
            'body' => 'required|min:27',
        ];
    }

}
