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
            'reservation_date'=>['required', 'after:tomorrow'],
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '日付を入力してください',
            'reservation_date.after' => '日付は翌日以降を指定してください',
        ];
    }
}
