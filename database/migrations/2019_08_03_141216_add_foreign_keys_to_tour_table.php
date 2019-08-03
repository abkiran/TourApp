<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTourTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tour', function(Blueprint $table)
		{
			$table->foreign('location_id', 'fk_tour_1')->references('id')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tour', function(Blueprint $table)
		{
			$table->dropForeign('fk_tour_1');
		});
	}

}
