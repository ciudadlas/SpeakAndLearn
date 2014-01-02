app.controller('UpgradeController', function($scope, $location, BT_CSEK) {

	$scope.accountTypeIsFree = true;

	$scope.alerts = [];

	$scope.colors = [
    	{ name:'Basic', shade:'$80 / month' },
    	{ name:'Gold', shade:'$150 / month' },
    	{ name:'Master', shade:'$200 / month' }   	
  	];

  	$scope.color = $scope.colors[0]; // basic

  	var addAlert = function(message, type) {
    	$scope.alerts.push({ type: type, msg: message });
	};

  	$scope.closeAlert = function(index) {
    	$scope.alerts.splice(index, 1);
  	};

	$scope.isDisabled = false;

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

			$scope.alerts = [];
		  	addAlert("Your have successfuly enrolled.", "success");

		  	$scope.isDisabled = false;
		  	$scope.accountTypeIsFree = false;
		  	$scope.$apply();
			
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    console.log(xhr.responseText);

		    $scope.alerts = [];
		    addAlert("Your card was declined.", "danger");

		    $scope.isDisabled = false;
		   	$scope.$apply(); 
		  }
		});
	}

    braintree.onSubmitEncryptForm('braintree-payment-form', ajax_submit);

});
