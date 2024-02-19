<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価を入力してください',
            'rating.integer' => '評価は整数で入力してください',
            'rating.between' => '評価は1から5の間の数字で入力してください',
            'comment.required' => 'コメントを入力してください',
            'comment.string' => 'コメントを文字列で入力してください',
            'comment.max' => 'コメントを255文字以下で入力してください',
        ];
    }
}
