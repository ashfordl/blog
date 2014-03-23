<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBlogpostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::dropIfExists("blog");

		Schema::create('blogposts', function($table)
            {
                $table->increments('id');
                $table->string('title')->unique();
                $table->mediumText('content');
                $table->string('tags');
                $table->timestamps();
                $table->boolean('deleted');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::dropIfExists("blogposts");

		Schema::create('blog', function($table)
            {
                $table->increments('id');
                $table->string('title')->unique();
                $table->mediumText('content');
                $table->string('tags');
                $table->timestamps();
                $table->boolean('deleted');
            });
	}

}
