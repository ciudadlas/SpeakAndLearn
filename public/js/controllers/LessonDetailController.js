app.controller("LessonDetailController", function($scope, $location, lesson, $sce) {
	
	console.log(lesson.data);

	$scope.lesson = lesson.data;

	$scope.audioPlaylist = [];

	$scope.mp4Video = $sce.trustAsResourceUrl('http://playground.html5rocks.com/samples/html5_misc/chrome_japan.mp4');

	$scope.mp3 = $sce.trustAsResourceUrl($scope.lesson.audio_file_url);  


});