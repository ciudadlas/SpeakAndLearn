<?php

class Subscription extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'subscriptions';
  	public $timestamps = true;

	//const CREATED_AT = 'createdAt';
	//const UPDATED_AT = 'updatedAt';
	//const DELETED_AT = 'deletedAt';
}
