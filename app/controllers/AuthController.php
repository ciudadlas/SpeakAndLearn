<?php

class AuthController extends BaseController 
{
	public function login() 
	{
		$credentialsArray = array('email' => Input::json('email'), 
								  'password' => Input::json('password'));

		if (Auth::attempt($credentialsArray))
		{
			return Response::json(Auth::user());
		}
		else
		{
			return Response::json(array('flash' => 'Invalid username or password'), 500);
		}
	}

	public function logout() 
	{
		Auth::logout();
		return Response::json(array('flash' => 'Logged out!'));
	}
	
}