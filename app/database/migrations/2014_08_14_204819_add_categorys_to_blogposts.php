<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategorysToBlogposts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blogposts', function($table)
            {
                $table->integer('category_id')->unsigned();
                
                $table->dropColumn('tags');
            });

        Schema::table('blogposts', function($table)
            {
                $table->foreign('category_id')->references('id')->on('categorys');
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('blogposts', function($table)
            {
                $table->dropForeign('blogposts_category_id_foreign');
                $table->dropColumn('category_id');

                $table->string('tags');
            });
	}

}
