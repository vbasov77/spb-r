<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Archive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('archive', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('no_in')->nullable();
            $table->string('no_out')->nullable();
            $table->string('payment_term')->nullable();
            $table->text('more_book');
            $table->string('otz')->nullable();
            $table->string('user_info')->nullable();
            $table->integer('total')->nullable();
            $table->integer('pay')->nullable();
            $table->string('info_pay')->nullable();
            $table->integer('confirmed')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('archive');
    }
}
