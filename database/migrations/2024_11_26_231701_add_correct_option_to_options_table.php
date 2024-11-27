<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {

            $table->dropColumn('answer');


            $table->unsignedBigInteger('correct_option_id')->nullable();
            $table->foreign('correct_option_id')
                  ->references('id')
                  ->on('options')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            
            $table->text('answer');

            $table->dropForeign(['correct_option_id']);
            $table->dropColumn('correct_option_id');
        });
    }
};
