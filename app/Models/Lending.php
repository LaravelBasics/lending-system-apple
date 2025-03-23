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
    ];

    // テーブル名を明示的に指定
    protected $table = 'lendings';
}
