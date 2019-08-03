<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTourTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tour', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title', 100)->nullable()->index('index3');
			$table->string('url', 50)->nullable()->unique('index2');
			$table->text('description', 65535)->nullable();
			$table->integer('location_id')->nullable()->index('fk_tour_1_idx');
			$table->time('duration')->nullable();
			$table->boolean('is_live')->nullable()->default(0);
			$table->boolean('is_promoted')->nullable()->default(0);
			$table->string('seo_id', 45)->nullable();
			$table->integer('booking_count')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tour');
	}

}
