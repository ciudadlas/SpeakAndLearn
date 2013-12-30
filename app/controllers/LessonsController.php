<?php

class LessonsController extends \BaseController {

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
		$user = Auth::user();

		if ($user != null)
		{
			$lessons = $user->lessons->toArray();			
			return Response::json($lessons);
		}
		else
		{
			return Response::json(array(), 500);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = Auth::user();

		$name = Input::get('name');
		$notes = Input::get('notes');
		$gender = Input::get('gender');

		$person = new Person;
		$person->name = $name;
		$person->notes = $notes;
		$person->gender = $gender;
		$person->profile_image_url = "https://s3.amazonaws.com/uifaces/faces/twitter/cyndymessah/128.jpg";
		$person->user()->associate($user);

		$person->save();
		
		return Response::json($person);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$lesson = Lesson::find($id);

		if ($lesson != null && $lesson->user == Auth::user())
		{
			return Response::json($lesson);	
		}
		else
		{
			return Response::json(array('flash' => 'Not permitted'), 401);
		}	
   	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}