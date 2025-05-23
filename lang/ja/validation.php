<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    // TODO:このファイル内にあるバリデーションメッセージを、必要に応じて各自で編集してください。

    'accepted'        => ':attributeを承認してください。',
    'active_url'      => ':attributeは、有効なURLではありません。',
    'after'           => ':attributeには、:dateより後の日付を指定してください。',
    'after_or_equal'  => ':attributeには、:date以降の日付を指定してください。',
    // 'after_or_equal'  => ':date以降の日付を指定してください。',
    'alpha'           => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash'      => ":attributeには、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
    'alpha_num'       => ":attributeには、英数字('A-Z','a-z','0-9')が使用できます。",
    'array'           => ':attributeには、配列を指定してください。',
    'before'          => ':attributeには、:dateより前の日付を指定してください。',
    'before_or_equal' => ':attributeには、:date以前の日付を指定してください。',
    'between'         => [
        'numeric' => ':attributeには、:minから、:maxまでの数字を指定してください。',
        'file'    => ':attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'string'  => ':attributeは、:min文字から:max文字にしてください。',
        'array'   => ':attributeの項目は、:min個から:max個にしてください。',
    ],
    'boolean'        => ":attributeには、'true'か'false'を指定してください。",
    'confirmed'      => ':attributeと:attribute確認が一致しません。',
    'date'           => ':attributeは、正しい日付ではありません。',
    'date_equals'    => ':attributeは:dateに等しい日付でなければなりません。',
    // 'date_format'    => ":attributeの形式は、':format'と合いません。",
    'date_format'    => "2025-01-01の形式にしてください。",
    'valid_date'     => ':attribute は無効な日付形式です。年、月、日が正しくない可能性があります。',
    'valid_date'     => ':attribute は無効な日付です。',
    'different'      => ':attributeと:otherには、異なるものを指定してください。',
    'digits'         => ':attributeは、:digits桁にしてください。',
    'max_digits'     => ':attributeは最大:max文字以下で入力してください。',
    'digits_between' => ':attributeは半角数字:min～:max桁で入力してください。',
    'dimensions'     => ':attributeの画像サイズが無効です',
    'distinct'       => ':attributeの値が重複しています。',
    'email'          => ':attributeは、有効なメールアドレス形式で指定してください。',
    'ends_with'      => ':attributeは、次のうちのいずれかで終わらなければなりません。: :values',
    'exists'         => '選択された:attributeは、有効ではありません。',
    'file'           => ':attributeはファイルでなければいけません。',
    'filled'         => ':attributeは必須です。',
    'gt'             => [
        'numeric' => ':attributeは、:valueより大きくなければなりません。',
        'file'    => ':attributeは、:value KBより大きくなければなりません。',
        'string'  => ':attributeは、:value文字より大きくなければなりません。',
        'array'   => ':attributeの項目数は、:value個より大きくなければなりません。',
    ],
    'gte' => [
        'numeric' => ':attributeは、:value以上でなければなりません。',
        'file'    => ':attributeは、:value KB以上でなければなりません。',
        'string'  => ':attributeは、:value文字以上でなければなりません。',
        'array'   => ':attributeの項目数は、:value個以上でなければなりません。',
    ],
    'image'    => ':attributeには、画像を指定してください。',
    'in'       => '選択された:attributeは、有効ではありません。',
    'in_array' => ':attributeが:otherに存在しません。',
    'integer'  => ':attributeは半角数字の整数で入力してください。',
    'ip'       => ':attributeには、有効なIPアドレスを指定してください。',
    'ipv4'     => ':attributeはIPv4アドレスを指定してください。',
    'ipv6'     => ':attributeはIPv6アドレスを指定してください。',
    'json'     => ':attributeには、有効なJSON文字列を指定してください。',
    'lt'       => [
        'numeric' => ':attributeは、:valueより小さくなければなりません。',
        'file'    => ':attributeは、:value KBより小さくなければなりません。',
        'string'  => ':attributeは、:value文字より小さくなければなりません。',
        'array'   => ':attributeの項目数は、:value個より小さくなければなりません。',
    ],
    'lte' => [
        'numeric' => ':attributeは、:value以下でなければなりません。',
        'file'    => ':attributeは、:value KB以下でなければなりません。',
        'string'  => ':attributeは、:value文字以下でなければなりません。',
        'array'   => ':attributeの項目数は、:value個以下でなければなりません。',
    ],
    'max' => [
        'numeric' => ':attributeは半角数字:max以下で入力してください。',
        'file'    => ':attributeには、:max KB以下のファイルを指定してください。',
        'string'  => ':attributeは、:max文字以下で入力してください。',
        'array'   => ':attributeの項目は、:max個以下にしてください。',
    ],
    'mimes'     => ':attributeには、:valuesタイプのファイルを指定してください。',
    'mimetypes' => ':attributeには、:valuesタイプのファイルを指定してください。',
    'min'       => [
        'numeric' => ':attributeには、:min以上の数字を指定してください。',
        'file'    => ':attributeには、:min KB以上のファイルを指定してください。',
        'string'  => ':attributeは、:min文字以上にしてください。',
        'array'   => ':attributeの項目は、:min個以上にしてください。',
    ],
    'not_in'                => '選択された:attributeは、有効ではありません。',
    'not_regex'             => ':attributeの形式が無効です。',
    'numeric'               => ':attributeは半角数字で入力してください。',
    'password'              => 'パスワードが正しくありません。',
    'present'               => ':attributeが存在している必要があります。',
    'regex'                 => ':attributeには、有効な正規表現を指定してください。',
    'tel.regex'             => ':attributeはハイフンを含めた最大13文字で入力してください。',
    'fax.regex'             => ':attributeはハイフンを含めた最大13文字で入力してください。',
    'required'              => ':attributeを入力してください。',
    'required_select'       => ':attributeを選択してください。',
    'required_if'           => ':otherが:valueの場合、:attributeを指定してください。',
    'required_unless'       => ':otherが:values以外の場合、:attributeを指定してください。',
    'required_with'         => ':valuesが指定されている場合、:attributeも指定してください。',
    'required_with_all'     => ':valuesが全て指定されている場合、:attributeも指定してください。',
    'required_without'      => ':valuesが指定されていない場合、:attributeを指定してください。',
    'required_without_all'  => ':valuesが全て指定されていない場合、:attributeを指定してください。',
    'same'                  => ':attributeと:otherが一致しません。',
    'size'                  => [
        'numeric' => ':attributeには、:sizeを指定してください。',
        'file'    => ':attributeには、:size KBのファイルを指定してください。',
        'string'  => ':attributeは、:size文字にしてください。',
        'array'   => ':attributeの項目は、:size個にしてください。',
    ],
    'starts_with' => ':attributeは、次のいずれかで始まる必要があります。:values',
    'string'      => ':attributeは文字列を入力してください。',
    'timezone'    => ':attributeには、有効なタイムゾーンを指定してください。',
    'unique'      => ':attributeは既に登録されています。',
    'uploaded'    => ':attributeのアップロードに失敗しました。',
    'url'         => ':attributeは、有効なURL形式で指定してください。',
    'uuid'        => ':attributeは、有効なUUIDでなければなりません。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'name' => [
            // 'required' => 'ユーザー名は必須です。',
            'string' => '名前は文字列で入力してください。',
            'max' => '名前は:max文字以内で入力してください。',
        ],
        'email' => [
            'required' => 'メールアドレスは必須です。',
            'email' => '有効なメールアドレス形式で入力してください。',
            'unique' => 'このメールアドレスは既に登録されています。',
        ],
        'password' => [
            'required' => 'パスワードは必須です。',
            'confirmed' => 'パスワード確認が一致しません。',
            'min' => 'パスワードは:min文字以上で入力してください。',
        ],
        'password_confirmation' => [
            'required' => 'パスワード確認は必須です。',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],
];
