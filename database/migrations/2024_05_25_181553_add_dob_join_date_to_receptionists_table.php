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
        Schema::table('receptionists', function (Blueprint $table) {
            $table->string('slug')->after('last_name');
            $table->string('join_date')->after('gender');
            $table->string('dob')->after('join_date');
            $table->string('blood_group')->nullable()->after('dob');
            $table->text('address')->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receptionists', function (Blueprint $table) {
            //
        });
    }
};
