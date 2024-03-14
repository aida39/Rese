<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMailRequest extends FormRequest
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
            'mail_subject' => ['required', 'string', 'max:255'],
            'mail_message' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'mail_subject.required' => 'タイトルを入力してください',
            'mail_subject.string' => 'タイトルを文字列で入力してください',
            'mail_subject.max' => 'タイトルを255文字以下で入力してください',
            'mail_message.required' => 'メール本文を入力してください',
            'mail_message.string' => 'メール本文を文字列で入力してください',
            'mail_message.max' => 'メール本文を255文字以下で入力してください',
        ];
    }
}
