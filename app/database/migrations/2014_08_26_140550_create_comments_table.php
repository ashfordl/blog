<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function ($table)
            {
                $table->increments('id');
                $table->text('text');

                $table->integer('blogpost_id')->unsigned();
                $table->integer('user_id')->unsigned();
                $table->integer('parent_id')->unsigned()->nullable();

                $table->timestamps();
                $table->softDeletes();
            });

        Schema::table('comments', function ($table)
            {
                $table->foreign('blogpost_id')->references('id')->on('blogposts');
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('parent_id')->references('id')->on('comments')->onDelete('set null');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
