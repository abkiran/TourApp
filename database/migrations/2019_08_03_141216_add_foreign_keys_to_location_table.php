<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('location', function(Blueprint $table)
		{
			$table->foreign('city_id', 'fk_location_1')->references('id')->on('city')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('location', function(Blueprint $table)
		{
			$table->dropForeign('fk_location_1');
		});
	}

}
