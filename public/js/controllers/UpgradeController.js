app.controller('UpgradeController', function($scope, $location, BT_CSEK) {

	$scope.isDisabled = false;
	$scope.error = "ALO";

    var braintree = Braintree.create(BT_CSEK);

	var ajax_submit = function (e) {

		$scope.isDisabled = true;
		$scope.$apply();

		console.log("submitting new customer");

  		form = $('#braintree-payment-form');
  		e.preventDefault();
  		
		$.ajax({
		  type: "POST",
		  url: "/transactions/createNewCustomer",
		  data: form.serialize(),
		  success: function(msg){
		  	$scope.isDisabled = false;
		  	$scope.$apply(); 

		  	console.log( "Data Saved: " + msg );
		  },
		  error: function(XMLHttpRequest, textStatus, errorThrown) {
		    console.log(XMLHttpRequest.responseText);
		    $scope.error = errorThrown;
		    $scope.isDisabled = false;

		   	$scope.$apply(); 
		  }
		});
	}

    braintree.onSubmitEncryptForm('braintree-payment-form', ajax_submit);

});
