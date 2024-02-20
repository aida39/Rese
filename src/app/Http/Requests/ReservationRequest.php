<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'reservation_date'=>['required', 'after:today'],
            'reservation_time' => ['required', 'date_format:H:i:s'],
            'member_count' => ['required', 'integer', 'between:1,5'],
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '日付を指定してください',
            'reservation_date.after' => '日付は翌日以降を指定してください',
            'reservation_time.required' => '時間を指定してください',
            'reservation_time.date_format' => '正しい時間を指定してください',
            'member_count.required' => '人数を指定してください',
            'member_count.integer' => '人数は整数で指定してください',
            'member_count.between' => '人数は1から5の間の数字で指定してください',
        ];
    }
}
