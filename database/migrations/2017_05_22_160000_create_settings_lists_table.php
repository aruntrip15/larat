<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateSettingsListsTable
 */
class CreateSettingsListsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('settings__lists', function (Blueprint $table)
		{
			$table->increments('id');
			$table->string('setting_key')->index()->unique();
			$table->binary('setting_value')->nullable();
			$table->enum('setting_type', array('dev','prod'))->default('dev');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('settings__lists');
	}

}
