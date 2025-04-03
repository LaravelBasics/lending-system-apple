<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'item_name',
        'lend_date',
        'return_date',
        'user_id',  // user_id を追加
    ];

    // テーブル名を明示的に指定
    protected $table = 'lendings';

    // user_idカラムとのリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
