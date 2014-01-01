// There is a grunt task that can handle modifying your code to add these dependencies pre-minification, so you don't have to do it manually
// It is caled ngmin, github.com/btford/ngmin

// Can do a hybrid between normal and spa app. Login just redirect to your spa.

// window.scope = $scope -> to inspect in console

var app = angular.module("app", ['ui.router', 'ngSanitize']);

app.config(function($stateProvider, $urlRouterProvider) {
  //
  // For any unmatched url, redirect to /people
  $urlRouterProvider.otherwise("/profile/lessons");
  $urlRouterProvider.when('/people/:profileID', '/people/:profileID/journal');

  //
  // Now set up the states
  $stateProvider
    .state('login', {
      url: "/login",
      templateUrl: "/templates/login.html",
      controller: 'LoginController'
    })
    
    .state('profile', {
      url: "/profile",
      templateUrl: '/templates/profile.html',
      controller: 'ProfileController'
    })
    .state('profile.lessons', {
      url: "/lessons",
      templateUrl: '/templates/profile.lessons.html',
      controller: 'LessonsController',
      resolve: { 
        lessons: function(LessonsService) {
          return LessonsService.get();
        }
      }
    })

    .state('preferences', {
      url: "/preferences",
      templateUrl: '/templates/preferences.html'
    })
    .state('preferences.account-summary', {
      url: "/account-summary",
      templateUrl: '/templates/preferences.account-summary.html'
    })
    .state('preferences.schedule', {
      url: "/schedule",
      templateUrl: '/templates/preferences.schedule.html',
      controller: 'UpgradeController'
    })
});


app.config(function($httpProvider) {

  var logsOutUserOn401 = function($location, $q, SessionService, FlashService) {
    var success = function(response) {
      return response;
    };

    var error = function(response) {
      if(response.status === 401) {
        SessionService.unset('authenticated');
        $location.path('/login');
        FlashService.show(response.data.flash);
      }
      return $q.reject(response);
    };

    return function(promise) {
      return promise.then(success, error);
    };
  };

  $httpProvider.responseInterceptors.push(logsOutUserOn401);

});

app.run(function($rootScope, $location, AuthenticationService, FlashService, $state, $stateParams) {

	$rootScope.$state = $state;
  $rootScope.$stateParams = $stateParams;

  // Other options: http://momentjs.com/,
  // https://github.com/urish/angular-moment
  // https://npmjs.org/package/angular-momentjs
  $rootScope.getDateObject = function(dateString){
      return new Date(dateString);
  }

	var routesThatRequireAuth = ['/people'];

	$rootScope.$on('$routeChangeStart', function(event, next, current) {
		if (_(routesThatRequireAuth).contains($location.path()) && !AuthenticationService.isLoggedIn()) {
			$location.path('/login');
			FlashService.show("Please log in to continue");
		}
	});
});