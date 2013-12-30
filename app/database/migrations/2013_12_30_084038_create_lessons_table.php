<?php

use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lessons', function($table)
		{
    		$table->increments('id');
    		$table->integer('owner_user_id');
   			$table->longtext('transcription');
   			$table->longtext('feedback');
   			$table->string('audio_file_url', 255);
   			$table->timestamp('lesson_date');
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
		Schema::drop('lessons');
	}

}