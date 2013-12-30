app.controller('AddNewPersonController', function($scope, $location, PeopleService) {

	$scope.person = { name: "", gender: "", notes: ""};

	$scope.submitNewUser = function() {
		PeopleService.post($scope.person).success(function() {
			$location.path('/people');
		});
	};
});