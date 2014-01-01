<?php

class TransactionController extends BaseController 
{
	public function createNewCustomer() 
	{
		$email = Auth::user()->email;

		$result = Braintree_Customer::create(array(
		    "firstName" => $_POST["first_name"],
		    "lastName" => $_POST["last_name"],
		    "email" => $email,
		    "creditCard" => array(
		        "number" => $_POST["number"],
		        "expirationMonth" => $_POST["month"],
		        "expirationYear" => $_POST["year"],
		        "cvv" => $_POST["cvv"],
		        'options' => array(
         			'verifyCard' => true
        		)
		    )
		));
		
		if ($result->success) 
		{
			return $this->createNewSubscription($result->customer->id);		    
		} 
		else 
		{
			$errors = "";

		    
		    foreach (($result->errors->deepAll()) as $error) 
		    {
		        $errors = $errors . "- " . $error->message . "<br/>";
		    }

		    return Response::json(array('errors' => $errors), 500);
		}
	}

	public function createNewSubscription($customer_id)
	{
		try 
		{
		    $customer = Braintree_Customer::find($customer_id);
		    $payment_method_token = $customer->creditCards[0]->token;

		    $result = Braintree_Subscription::create(array(
		        'paymentMethodToken' => $payment_method_token,
		        'planId' => 'cpgm'
		    ));

		    if ($result->success) 
		    {
		        echo("Success! Subscription " . $result->subscription->id . " is " . $result->subscription->status);
		    } 
		    else 
		    {	    	
				$errors = "";

			    foreach (($result->errors->deepAll()) as $error) 
			    {
			    	$errors = $errors . "- " . $error->message . "<br/>";
			    }

			    return Response::json(array('errors' => $errors), 500);
		    }
		} 
		catch (Braintree_Exception_NotFound $e) 
		{
		    echo("Failure: no customer found with ID " . $_GET["customer_id"]);
		}
	}

	public function logout() 
	{
		Auth::logout();
		return Response::json(array('flash' => 'Logged out!'));
	}
	
}