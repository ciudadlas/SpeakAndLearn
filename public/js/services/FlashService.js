app.factory("FlashService", function($rootScope) {
	return {
		show: function(message) {
			$rootScope.flash = message;
		},

		clear: function(message) {
			$rootScope.flash = "";
		}
	};
});