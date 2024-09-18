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
        Schema::table('takleefs', function (Blueprint $table) {
            $table->string('in_confirmation')->nullable(); // You can specify the column type and make it nullable if needed

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('takleefs', function (Blueprint $table) {
            $table->dropColumn('in_confirmation');
        });
    }
};
