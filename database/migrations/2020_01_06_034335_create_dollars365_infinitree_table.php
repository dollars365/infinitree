<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfinitreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dollars365_infinitree', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->integer('parent_id')->default(0);
            $table->integer('order')->default(0);
            $table->string('title', 50);

            
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
        Schema::dropIfExists('dollars365_infinitree');
    }
}
