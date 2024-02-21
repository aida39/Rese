<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'shop_area_id' => ['required'],
            'shop_genre_id' => ['required'],
            'shop_name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:5120'],
            'shop_description' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'shop_area_id.required' => 'エリアを指定してください',
            'shop_genre_id.required' => 'ジャンルを指定してください',
            'shop_name.required' => '店名を入力してください',
            'shop_name.string' => '店名を文字列で入力してください',
            'shop_name.max' => '店名を255文字以下で入力してください',
            'image.required' => '画像を選択してください',
            'image.image' => '画像形式のファイルを選択してください',
            'image.max' => '5MB以内の画像を選択してください。',
            'shop_description.required' => '説明を入力してください',
            'shop_description.string' => '説明を文字列で入力してください',
            'shop_description.max' => '説明を255文字以下で入力してください',
        ];
    }
}
