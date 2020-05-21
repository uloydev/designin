<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     * unpaid = waiting for user payment
     * waiting = waiting for agent to accept the order
     * process = agent working on project
     * complaint = waiting agent to working on user complaint
     * finished = project/ order finished
     * canceled = order canceled
     * @return void
     */

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('agent_id')->nullable();
            $table->unsignedInteger('package_id');
            $table->enum('status', [
                'unpaid', 'waiting', 'process', 'complaint', 'finished', 'canceled'
            ]);
            $table->unsignedInteger('progress')->default(0);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->boolean('is_reviewed')->nullable();
            $table->text('request')->nullable();
            $table->unsignedInteger('budget');
            $table->unsignedInteger('promo_id')->nullable();
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
