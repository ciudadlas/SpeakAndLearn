app.factory("JournalService", function($http, $sanitize, CSRF_TOKEN) {

	var sanitizeInput = function(entry) {
		return {
			title: $sanitize(entry.title),
			body: $sanitize(entry.body),
			city: $sanitize(entry.city),
			state: $sanitize(entry.state),
			country: $sanitize(entry.country),
			event_date: $sanitize(entry.event_date),
			person_id: $sanitize(entry.person_id),
			csrf_token: CSRF_TOKEN
		};
	};

	return {
		// Returns all entries that belongs to the person
		get: function(profileID) {
			return $http.get('/entries?personId=' + profileID);
		},

		// Posts new user
		post: function(entry) {

			var post = $http.post('/entries', sanitizeInput(entry));
			return post;
		}
	};
});