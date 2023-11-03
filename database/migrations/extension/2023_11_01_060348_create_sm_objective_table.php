<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmObjectiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_objectives', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('text');
            $table->enum('term_type', ['FIRST', 'SECOND', 'THIRD']);
            $table->tinyInteger('active_status')->default(1);
            $table->unsignedInteger('section_id');
            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('academic_id');
            $table->unsignedInteger('school_id')->nullable()->default(1);

            // Define foreign key constraints
            $table->foreign('subject_id')->references('id')->on('sm_subjects')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sm_sections')->onDelete('cascade');
            $table->foreign('academic_id')->references('id')->on('sm_academic_years')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('sm_schools')->onDelete('cascade');

            // Add indexes to specific columns
            $table->index('subject_id');
            $table->index('section_id');
            $table->index('academic_id');
            $table->index('school_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_objectives');
    }
}
