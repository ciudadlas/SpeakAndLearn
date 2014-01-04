<?php

class TransactionController extends BaseController 
{
	public function createNewCustomer() 
	{
		$email = Auth::user()->email;

		$result = Braintree_Customer::create(array(
		    "firstName" => Input::get("first_name"),
		    "lastName" => Input::get("last_name"),
		    "email" => $email,
		    "creditCard" => array(
		        "number" => Input::get("number"),
		        "expirationMonth" => Input::get("month"),
		        "expirationYear" => Input::get("year"),
		        "cvv" => Input::get("cvv"),
		        'options' => array(
         			'verifyCard' => true
        		)
		    )
		));
		
		if ($result->success) 
		{
			// Save BT customer id in our system
			$customerData = new CustomerData;
			$customerData->user_id = Auth::user()->id;
			$customerData->bt_customer_id = $result->customer->id;
			$customerData->save();

			return $this->createNewSubscription($result->customer->id, Input::get("plan_id"), Auth::user()->id);
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

	public function createNewSubscription($bt_customer_id, $plan_id, $user_id)
	{

		$plan = SubscriptionPlan::find($plan_id);

		try 
		{
		    $customer = Braintree_Customer::find($bt_customer_id);
		    $payment_method_token = $customer->creditCards[0]->token;

		    $result = Braintree_Subscription::create(array(
		        'paymentMethodToken' => $payment_method_token,
		        'planId' => $plan->bt_plan_id
		    ));

		    if ($result->success) 
		    {
		    	// Create new subscription record in our DB
		    	$subscription = new Subscription;
		    	$subscription->user_id = $user_id;
				$subscription->plan_id = $plan_id;
				$subscription->plan_status = 'active';
				$subscription->save();

		    	// Respons with success
		    	Response::json(array('subscription_id' => $result->subscription->id, 'subscription_status' => $result->subscription->status));     
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