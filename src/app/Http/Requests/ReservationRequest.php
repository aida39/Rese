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
            'reservation_date' => ['required', 'after:today'],
            'reservation_time' => ['required'],
            'member_count' => ['required'],
            'course_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '日付を選択してください',
            'reservation_date.after' => '日付は翌日以降を選択してください',
            'reservation_time.required' => '時間を選択してください',
            'member_count.required' => '人数を選択してください',
            'course_id.required' => 'コースを選択してください',
        ];
    }
}
