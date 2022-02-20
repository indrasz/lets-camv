<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destinations_id')->nullable()->index('fk_transactions_to_destinations');
            $table->foreignId('camvs_id')->nullable()->index('fk_transactions_to_camvs');
            $table->foreignId('users_id')->nullable()->index('fk_transactions_to_users');
            $table->integer('transaction_total')->default()->nullable();
            $table->string('transaction_status')->default('PENDING');
            $table->date('booking_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
