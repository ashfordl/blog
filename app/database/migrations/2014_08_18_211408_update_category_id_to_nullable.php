<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategoryIdToNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("ALTER TABLE `blogposts` MODIFY `category_id` INT(10) UNSIGNED DEFAULT NULL");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        // Ensure that there are no null values
        $id = Category::first()->id;
		foreach (Blogpost::whereNull('category_id')->get() as $post) 
        {
            $post->category_id = $id;
        }

        Schema::table('blogposts', function($table) 
            {
                // Drop the foreign key constraint
                DB::statement("ALTER TABLE `blogposts` DROP FOREIGN KEY `blogposts_category_id_foreign`");

                // Set to not null
                DB::statement("ALTER TABLE `blogposts` MODIFY `category_id` INT(10) UNSIGNED NOT NULL");

                // Re-add the foreign key
                $table->foreign('category_id')->references('id')->on('categories');
            });
	}

}
