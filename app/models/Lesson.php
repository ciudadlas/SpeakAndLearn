<?php

class Lesson extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	protected $table = 'lessons';
  	public $timestamps = true;

	//const CREATED_AT = 'createdAt';
	//const UPDATED_AT = 'updatedAt';
	//const DELETED_AT = 'deletedAt';

	public function user()
	{
    	return $this->belongsTo('User', 'owner_user_id');
	}
}
