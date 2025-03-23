<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();//主キー
            $table->string('name');// 貸出者の名前（手動入力）
            $table->string('item_name'); // 品名（手動入力）
            $table->date('lend_date');// 貸出日
            $table->date('return_date')->nullable();// 返却日（NULL許容）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};
