<?php

use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriptions', function($table)
		{
    		$table->increments('id');
    		$table->string('user_id')->unique();
    		$table->integer('plan_id');
    		$table->enum('plan_status', array('active', 'suspended', 'canceled'));
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
		Schema::drop('subscriptions');
	}

}