<?php

class CustomerData extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'customer_data';
  	public $timestamps = true;

	//const CREATED_AT = 'createdAt';
	//const UPDATED_AT = 'updatedAt';
	//const DELETED_AT = 'deletedAt';
}
