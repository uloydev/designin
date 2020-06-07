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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('agent_id')->nullable();
            $table->unsignedInteger('package_id');
            $table->enum('status', [
                'unpaid', 'process', 'complaint', 'finished', 'canceled', 'check_result', 'check_revision'
            ]);
            $table->unsignedInteger('progress')->default(0);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->boolean('is_reviewed')->default(false);
            $table->longText('request')->nullable();
            $table->string('attachment')->nullable();
            $table->unsignedInteger('budget');
            $table->unsignedInteger('promo_id')->nullable();
            $table->text('extras')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('max_revision')->default(3);
            $table->unsignedInteger('duration')->nullable();
            $table->unsignedInteger('token_usage')->nullable();
            $table->unsignedInteger('invoice_id')->nullable();
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
