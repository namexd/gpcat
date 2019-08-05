<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('对接API名称');
            $table->string('auth_url');
            $table->string('data_url');
            $table->string('auth_params')->nullable();
            $table->string('data_params')->nullable();
            $table->text('translate')->nullable()->comment('字段转换规则');
            $table->timestamps();
        });

        Schema::create('api_data_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('api_id');
            $table->text('data')->nullable();
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
        Schema::dropIfExists('api_datas');
        Schema::dropIfExists('api_data_details');
    }
}
