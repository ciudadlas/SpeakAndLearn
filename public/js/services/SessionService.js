app.factory("SessionService", function() {

	// html5 session storage. (Alternatives: cookies, localstorage)
	// need check with modernizer to polyfill

	return {
		get: function(key) {
			return sessionStorage.getItem(key);
		},

		set: function(key, val) {
			return sessionStorage.setItem(key, val);
		},

		unset: function(key) {
			return sessionStorage.removeItem(key);
		}
	};
});