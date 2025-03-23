<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env ( 'APP_ENV' ) === 'production') {
            URL :: forceScheme ( 'https' );
        }

         // カスタムバリデーションの定義
         Validator::extend('valid_date', function ($attribute, $value, $parameters, $validator) {
            // 年（例: 2020）
            if (preg_match('/^\d{4}$/', $value)) {
                return true;
            }

            // 年と月 (例: 2020-01)
            if (preg_match('/^\d{4}-(0[1-9]|1[0-2])$/', $value)) {
                return true;
            }

            // 完全な日付 (例: 2020-02-29)
            if (preg_match('/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/', $value)) {
                // 日付として有効かどうかをチェック
                $date = \DateTime::createFromFormat('Y-m-d', $value);

                // 日付が無効な場合
                if ($date === false) {
                    return false; // 無効な日付
                }

                // 有効な日付の場合
                return $date->format('Y-m-d') === $value; // 日付のフォーマットが一致するかを確認
            }

            return false;
        });

        // カスタムメッセージの定義
        // Validator::replacer('valid_date', function ($message, $attribute, $rule, $parameters) {
        //     return ":attribute は無効な日付です。";
        // });
    }
}
