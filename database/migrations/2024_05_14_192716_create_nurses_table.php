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
        Schema::create('nurses', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->date('dob');
            $table->string('gender');
            $table->string('qualification');
            $table->string('experience');
            $table->date('join_date')->nullable();
            $table->string('blood_group')->nullable();
            $table->text('address');
            $table->boolean('is_active')->default(true)->comment('1 for available, 0 for unavailable');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurses');
    }
};
