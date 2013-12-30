app.factory("ProfileService", function($http, $sanitize, CSRF_TOKEN) {

	return {
		// Returns all people that belongs to the logged in user
		get: function() {
		  return $http.get('/people');
		},

		// Posts new user
		post: function(person) {
			var post = $http.post('/people', sanitizeInput(person));
			return post;
		}
	};
});