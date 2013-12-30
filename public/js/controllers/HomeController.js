app.controller('HomeController', function($scope, $location, AuthenticationService) {

	$scope.title = "Goal";
	$scope.message = "Mouse over these images to see a directive at work";

	$scope.logout = function() {
		AuthenticationService.logout($scope.credentials).success(function() {
			$location.path('/login');
		});
	};
});