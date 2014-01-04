<?php

use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription_plans', function($table)
		{
    		$table->increments('id');
    		$table->string('bt_plan_id')->unique()->nullable();
    		$table->float('price_in_usd');
   			$table->string('name')->unique();
   			$table->longtext('description');
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
		Schema::drop('subscription_plans');
	}

}