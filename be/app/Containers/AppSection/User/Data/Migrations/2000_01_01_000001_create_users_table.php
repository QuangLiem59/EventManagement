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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('username', 50)->unique();
            $table->string('phone', 20)->unique()->nullable();
            $table->string('email', 200)->unique()->nullable();
            $table->string('password');
            $table->enum('gender', ['male', 'female', 'unspecified'])->nullable();
            $table->date('birthday')->nullable();
            $table->string('avatar', 250)->nullable();
            $table->string('address', 400)->nullable();
            $table->enum('status', ['enable', 'disable'])->default('enable');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
