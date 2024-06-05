<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvImportRequest extends FormRequest
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
            'csvFile' => 'required|file|mimes:csv,txt',
        ];
    }

    public function messages()
    {
        return [
            'csvFile.required' => 'ファイルを選択してください',
            'csvFile.file' => 'ファイルを選択してください',
            'csvFile.mimes' => 'csv形式のファイルを選択してください',
        ];
    }
}
