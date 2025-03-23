<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLendingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this->all());  // 送信された全てのデータを表示
        return [
            'name'        => 'required|string|max:255',
            'item_name'   => 'required|string|max:255',
            'lend_date'   => 'required|date|date_format:Y-m-d',
            'return_date' => 'nullable|date|date_format:Y-m-d|after_or_equal:lend_date',//返却日が貸出日と同じor後
        ];
    }

    public function attributes(): array
    {
        return [
            'name'        => '名前',
            'item_name'   => '品名',
            'lend_date'   => '貸出日',
            'return_date' => '返却日',
        ];
    }

    /**
     * カスタムエラーメッセージ
     */
    // public function messages(): array
    // {
    //     return [
    //         'name.required' => '名前を入力してください。',
    //         'item_name.max' => 'パソコンの名称は255文字以内で入力してください。',
    //         'lend_date.required' => '貸出日を入力してください。',
    //         'lend_date.date_format' => '貸出日は YYYY-MM-DD 形式で入力してください。',
    //         'return_date.date_format' => '返却日は YYYY-MM-DD 形式で入力してください。',
    //         'return_date.after_or_equal' => '返却日は貸出日と同じか、それ以降の日付を指定してください。',
    //     ];
    // }
}
