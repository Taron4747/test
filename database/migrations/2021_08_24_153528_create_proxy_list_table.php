<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProxyListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proxy_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proxy_id');
            $table->string('proxy_name',200);
            $table->foreign('proxy_id')->references('id')->on('proxy')->onDelete('cascade');

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
        Schema::dropIfExists('proxy_list');
    }
}
