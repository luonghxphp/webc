<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('cardseri');
            $table->string('cardcode');
            $table->string('cardtype');
            $table->integer('cardvalue')->default(0);
            $table->integer('realvalue')->default(0);
            $table->integer('receivedvalue')->default(0);
            $table->integer('moneyearn')->default(0);
            $table->integer('rate')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->integer('status');
            $table->string('refcode');
            $table->string('partner_transaction_id');
            $table->string('note');
            $table->string('callback_http_code');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('cards');
        Schema::dropIfExists('users');
    }
}
