<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table)
		{
		    $table->increments('id');
		    $table->integer('user_id')->unsigned()->index();
		    $table->string('title')->nullable();
		    $table->text('md_content');
		    $table->boolean('private')->default(false);
		    $table->boolean('allow_comments')->default(true);
		    $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
