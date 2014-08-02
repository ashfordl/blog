<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveBantypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bans', function($table)
            {
                $table->dropForeign('bans_type_foreign');
                $table->dropColumn('type');
            });

        Schema::drop('bantypes');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::create('bantypes', function($table)
            {
                $table->increments('id');
                $table->string('name');
                $table->integer('default_length')->default(5);
            });

		Schema::table('bans', function($table)
            {
                $table->integer('type')->unsigned();
                $table->foreign('type')->references('id')->on('bantypes');
            });
	}

}
