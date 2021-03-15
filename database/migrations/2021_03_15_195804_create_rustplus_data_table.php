<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRustplusDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rustplus_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('team_id')->index();
            $table->bigInteger('user_id')->index();
            $table->longText('map_data')->nullable();
            $table->text('server_token')->nullable();
            $table->dateTime('map_downloaded_at')->nullable();
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
        Schema::dropIfExists('rustplus_data');
    }
}
