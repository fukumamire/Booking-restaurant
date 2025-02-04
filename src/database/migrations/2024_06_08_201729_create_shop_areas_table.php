<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopAreasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop_areas', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('shop_id');
			$table->unsignedBigInteger('area_id');
			$table->timestamps();

			// 外部キー制約
			$table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
			$table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('shop_areas');
	}
}
