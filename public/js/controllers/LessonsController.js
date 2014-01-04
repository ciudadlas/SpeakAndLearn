app.controller("LessonsController", function($scope, $location, lessons, $state) {
	
	$scope.lessons = lessons.data;

});