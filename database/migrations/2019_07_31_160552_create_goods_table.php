<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->text('brand')->comment('型号');
            $table->text('image')->comment('图片');
            $table->text('type')->comment('类型');
            $table->text('model')->comment('型号');
            $table->integer('number')->comment('库存');
            $table->text('unit')->comment('单位');
            $table->text('product_area')->comment('产地');
            $table->decimal('price',8,2)->comment('对接价格');
            $table->decimal('price_a',8,2)->comment('A价格');
            $table->decimal('price_b',8,2)->comment('B价格');
            $table->text('package')->comment('包装');
            $table->text('supplier')->comment('供应商');
            $table->text('repository')->comment('仓库名称');
            $table->text('oil')->comment('油脂');
            $table->text('size')->comment('尺寸规格');
            $table->float('inner_diameter',8,3)->comment('轴承内径');
            $table->float('out_diameter',8,3)->comment('轴承外径');
            $table->float('width',8,3)->comment('轴承宽度');
            $table->float('weight',8,3)->comment('轴承重量');
            $table->text('days')->comment('货期');
            $table->text('comment')->comment('备注')->nullable();
            $table->text('extra1')->comment('备用字段1')->nullable();
            $table->text('extra2')->comment('备用字段2')->nullable();
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
        Schema::dropIfExists('goods');
    }
}
