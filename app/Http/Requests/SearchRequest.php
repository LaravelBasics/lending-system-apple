<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
        return [
            // 名前検索は空でもOK（初回アクセス時）
            'name_search' => 'nullable|string|max:255',

            // 品名検索も空でもOK
            'item_name_search' => 'nullable|string|max:255',

            // 貸出日も空でOK
            'lend_date_search' => 'nullable|date|date_format:Y-m-d',

            // 返却日（返却日がある場合のみバリデーションを行う）
            'return_date_search' => 'nullable|date|date_format:Y-m-d|after_or_equal:lend_date_search',

            // 未返却チェックボックス（バリデーションなし）
            'search_checkbox' => 'nullable|in:0,1',
        ];
    }

    public function attributes(): array
    {
        return [
            'name_search'        => '名前',
            'item_name_search'   => '品名',
            'lend_date_search'   => '貸出日',
            'return_date_search' => '返却日',
        ];
    }
}
