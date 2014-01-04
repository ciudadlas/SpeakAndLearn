<?php

class SubscriptionsController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf_json', array('only' => 'store'));
		//$this->beforeFilter('@hasPermission', ['only' => ['show', 'update', 'destroy']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(SubscriptionPlan::all());	
	}
}