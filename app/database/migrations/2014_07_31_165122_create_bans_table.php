<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bans', function($table)
            {
                $table->increments('id');

                $table->integer('user')->unsigned();
                $table->foreign('user')->references('id')->on('users');

                $table->integer('issued_by')->unsigned();
                $table->foreign('issued_by')->references('id')->on('users');

                $table->timestamp('start');
                $table->timestamp('end')->nullable();

                $table->integer('type')->unsigned();
                $table->foreign('type')->references('id')->on('bantypes');
                $table->string('comment')->nullable();
                
                $table->boolean('valid')->default(true);
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bans');
	}

}
