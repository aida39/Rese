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
            'rating' => ['required'],
            'comment' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価を入力してください',
            'comment.required' => 'コメントを入力してください',
            'comment.max' => 'コメントを255文字以下で入力してください',
        ];
    }
}
