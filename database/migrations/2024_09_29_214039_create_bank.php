<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        // Tabela Production_line
        Schema::create('production_lines', function (Blueprint $table) {
            $table->id(); // id INT PrimaryKey
            $table->unsignedBigInteger('admin_id'); // admin_id INT PrimaryKey
            $table->text('description');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('admin_id')->references('id')->on('user');
        });

        // Tabela Machine
        Schema::create('machines', function (Blueprint $table) {
            $table->id(); // id INT Primary Key
            $table->unsignedBigInteger('line_id'); // line_id Foreign Key
            $table->text('description');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('line_id')->references('id')->on('production_lines');
        });

        // Tabela User_machine
        Schema::create('user_machine', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // user_id INT Foreign Key
            $table->unsignedBigInteger('machine_id'); // machine_id INT Foreign Key
            $table->boolean('machineAdmin');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('machine_id')->references('id')->on('machines');
        });

        // Tabela Course
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // id INT PrimaryKey
            $table->unsignedBigInteger('machine_id'); // machine_id INT Foreign Key
            $table->text('description');
            $table->integer('min_vid_percentage');
            $table->integer('min_activity_percentage');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('machine_id')->references('id')->on('machines');
        });

        // Tabela User_course
        Schema::create('user_course', function (Blueprint $table) {
            $table->id(); // id INT PrimaryKey
            $table->unsignedBigInteger('course_id'); // course_id INT Foreign Key
            $table->text('description');
            $table->integer('watched_percentage');
            $table->integer('activity_percentage');
            $table->boolean('boolean_activity');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('course_id')->references('id')->on('courses');
        });

        // Tabela Video
        Schema::create('videos', function (Blueprint $table) {
            $table->id(); // id INT PrimaryKey
            $table->unsignedBigInteger('course_id'); // course_id INT Foreign Key
            $table->text('description');
            $table->binary('video'); // video - Blob
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('course_id')->references('id')->on('courses');
        });

        // Tabela Activity
        Schema::create('activities', function (Blueprint $table) {
            $table->id(); // id INT PrimaryKey
            $table->unsignedBigInteger('course_id'); // course_id INT Foreign Key
            $table->text('activity_description');
            $table->text('answer');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('course_id')->references('id')->on('courses');
        });

        // Tabela Option
        Schema::create('options', function (Blueprint $table) {
            $table->id(); // id INT PrimaryKey
            $table->unsignedBigInteger('activity_id'); // activity_id INT Foreign Key
            $table->string('description');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('activity_id')->references('id')->on('activities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank');
    }
};
