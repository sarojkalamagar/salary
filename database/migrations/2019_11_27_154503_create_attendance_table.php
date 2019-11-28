<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('employee_id');
            $table->date('date');
            $table->time('in_time')->nullable()->default(NULL);
            $table->time('out_time')->nullable()->default(NULL);
            $table->float('no_of_hours_worked')->nullable();
            $table->text('comments')->nullable()->default(NULL);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['employee_id', 'date']);
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance');
    }
}
