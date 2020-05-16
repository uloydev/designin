<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('agent_id')->nullable();
            // unpaid = waiting for user payment
            // waiting = waiting for agent to bid and accpeted by user
            // proccess = agent working on project
            // finished = project/ order finished
            $table->unsignedInteger('package_id');
            $table->enum('status', ['unpaid', 'waiting', 'process', 'complaint', 'finished']);
            $table->unsignedInteger('progress')->default(0);
            $table->datetime('started_at')->nullable();
            $table->datetime('deadline')->nullable();
            $table->text('request')->nullable();
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
        Schema::dropIfExists('orders');
    }
}