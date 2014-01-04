app.controller('AccountSummaryController', function($scope, $location, SessionService) {

	$scope.accountLevel = SessionService.get('subscription_level'); 

});