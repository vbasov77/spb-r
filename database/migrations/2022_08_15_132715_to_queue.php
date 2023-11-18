<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ToQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('to_queue', function (Blueprint $table) {
            $table->id();
            $table->string('date_in');
            $table->string('date_out');
            $table->integer('count_night');
            $table->string('name');
            $table->string('phone');
            $table->string('messenger');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('to_queue');
    }
}
