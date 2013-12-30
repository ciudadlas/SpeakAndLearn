app.controller("LessonsController", function($scope, $location, lessons) {
	
	$scope.lessons = lessons.data;

});