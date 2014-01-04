<?php

use Illuminate\Database\Migrations\Migration;

class CreateCustomerDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_data', function($table)
		{
    		$table->increments('id');
    		$table->integer('user_id')->unique();
    		$table->string('bt_customer_id')->unique();
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
		Schema::drop('customer_data');
	}

}