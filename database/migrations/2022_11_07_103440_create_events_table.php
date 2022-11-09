<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->string('type')->nullable();
            $table->date('event_date')->nullable();
            $table->text('link')->nullable();
            $table->longText('description')->nullable();
            $table->string('difficulty')->nullable();
            $table->string('language')->default('en');
            $table->text('venue')->nullable();
            $table->text('location')->nullable();
            $table->float('fees')->nullable();
            $table->longText('objectives')->nullable();
            $table->longText('details')->nullable();
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
        Schema::dropIfExists('events');
    }
};
