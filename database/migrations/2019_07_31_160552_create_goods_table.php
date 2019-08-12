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
            $table->text('name')->comment('商品名')->nullable();
            $table->text('brand')->comment('型号')->nullable();
            $table->text('image')->comment('图片')->nullable();
            $table->text('type')->comment('类型')->nullable();
            $table->text('model')->comment('型号')->nullable();
            $table->integer('number')->comment('库存')->nullable();
            $table->text('unit')->comment('单位')->nullable();
            $table->text('product_area')->comment('产地')->nullable();
            $table->decimal('price',8,2)->comment('对接价格')->nullable();
            $table->decimal('price_a',8,2)->comment('A价格')->nullable();
            $table->decimal('price_b',8,2)->comment('B价格')->nullable();
            $table->text('package')->comment('包装')->nullable();
            $table->text('supplier')->comment('供应商')->nullable();
            $table->text('repository')->comment('仓库名称')->nullable();
            $table->text('oil')->comment('油脂')->nullable();
            $table->text('size')->comment('尺寸规格')->nullable();
            $table->float('inner_diameter',8,3)->comment('轴承内径')->nullable();
            $table->float('out_diameter',8,3)->comment('轴承外径')->nullable();
            $table->float('width',8,3)->comment('轴承宽度')->nullable();
            $table->float('weight',8,3)->comment('轴承重量')->nullable();
            $table->text('days')->comment('货期')->nullable();
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
