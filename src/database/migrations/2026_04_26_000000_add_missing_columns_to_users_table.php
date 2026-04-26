<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * UserController / PasswordController / User::boot で参照されているが
     * 元の users テーブル定義に存在しなかったカラムを追加する。
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('plan_id')->nullable()->after('id');
            $table->string('company')->nullable()->after('email');
            $table->string('password_token')->nullable()->after('password');
            $table->boolean('password_updated')->default(false)->after('password_token');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['plan_id', 'company', 'password_token', 'password_updated']);
        });
    }
};
