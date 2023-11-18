<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Booking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('phone');
            $table->string('email');
            $table->string('date_book');
            $table->string('no_in');
            $table->string('no_out');
            $table->string('payment_term')->nullable();
            $table->text('more_book');
            $table->string('user_info')->nullable();
            $table->integer('total');
            $table->integer('pay')->default(0);
            $table->string('info_pay')->default(0);
            $table->integer('confirmed')->default(0);
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
        Schema::dropIfExists('booking');
    }
}
