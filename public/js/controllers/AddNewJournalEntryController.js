app.controller('AddNewJournalEntryController', function($scope, $location, $state, JournalService) {

	$scope.entry = { title: "", body: "", event_date: "", city: "", state: "", country: "", person_id: $scope.person.id };

	$scope.submitNewEntry = function() {
		JournalService.post($scope.entry).success(function() {

			$state.go('^');

		});
	};
});