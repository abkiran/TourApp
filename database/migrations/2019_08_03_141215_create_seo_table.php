<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seo', function(Blueprint $table)
		{
			$table->integer('id')->primary();
			$table->string('title', 75)->nullable();
			$table->string('description', 160)->nullable();
			$table->string('keywords', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seo');
	}

}
