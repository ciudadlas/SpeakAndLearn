app.factory("AccountService", function($http, $sanitize, CSRF_TOKEN) {

	return {
		// Returns all people that belongs to the logged in user
		get: function() {
		  return $http.get('/account');
		}
	};
});