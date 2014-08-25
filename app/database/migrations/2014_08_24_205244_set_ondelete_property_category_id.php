<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetOndeletePropertyCategoryId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blogposts', function($table) 
            {
                // Drop the foreign key so we can change it
                $table->dropForeign('blogposts_category_id_foreign');

                // Add the on delete property
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
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
                // Drop the foreign key so we can change it
                $table->dropForeign('blogposts_category_id_foreign');

                // Re-add the foreign key, without the property
                $table->foreign('category_id')->references('id')->on('categories');
            });
	}

}
