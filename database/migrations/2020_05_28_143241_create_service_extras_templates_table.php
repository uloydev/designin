<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceExtrasTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_extras_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedInteger('price');
            $table->unsignedInteger('price_token');
            $table->enum('effect', ['deadline-1']);
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
        Schema::dropIfExists('service_extras_templates');
    }
}
