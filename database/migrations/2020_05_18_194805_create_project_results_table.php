<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_results', function (Blueprint $table) {
            $table->id();
            $table->string('file');
            $table->text('message');
            $table->enum('type', ['result', 'revision']);
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('agent_id');
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
        Schema::dropIfExists('project_results');
    }
}
