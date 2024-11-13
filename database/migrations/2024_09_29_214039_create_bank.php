<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::create('production_lines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->text('description');
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('user')->onDelete('cascade');
            ;
        });

        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('line_id');
            $table->text('description');
            $table->timestamps();

            $table->foreign('line_id')->references('id')->on('production_lines')->onDelete('cascade');
        });

        Schema::create('user_machine', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('machine_id');
            $table->boolean('machineAdmin');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('machine_id')
                ->references('id')->on('machines')
                ->onDelete('cascade');
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machine_id');
            $table->text('description');
            $table->integer('min_vid_percentage');
            $table->integer('min_activity_percentage');
            $table->boolean("activity");
            $table->timestamps();

            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
        });

        Schema::create('user_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->integer('watched_percentage');
            $table->integer('activity_percentage');
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user');
        });

        Schema::create('capitulo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->text('description');
            $table->text('name');
            $table->timestamps();

            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('capitulo_id');
            $table->text('description');
            $table->binary('video');
            $table->timestamps();

            $table->foreign('capitulo_id')
                ->references('id')->on('capitulo')
                ->onDelete('cascade');
        });

        // Tabela Activity
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('capitulo_id');
            $table->text('activity_description');
            $table->text('answer');
            $table->timestamps();

            $table->foreign('capitulo_id')
                ->references('id')->on('capitulo')
                ->onDelete('cascade');
        });

        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->string('description');
            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('activities');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank');
    }
};
