<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->default(null);
            $table->string('phone')->default(null);
            $table->string('email')->default(null);
            $table->string('date_tour')->default(null);
            $table->string('time_tour')->default(null);
            $table->string('guests')->default(null);
            $table->string('total')->default(null);
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
