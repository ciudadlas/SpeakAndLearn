// There is a grunt task that can handle modifying your code to add these dependencies pre-minification, so you don't have to do it manually
// It is caled ngmin, github.com/btford/ngmin

// Can do a hybrid between normal and spa app. Login just redirect to your spa.

// window.scope = $scope -> to inspect in console

var app = angular.module("app", ['ui.router', 'ngSanitize', 'ui.bootstrap', 'audioPlayer']);

app.config(function($stateProvider, $urlRouterProvider) {
  //
  // For any unmatched url, redirect to /people
  $urlRouterProvider.otherwise("/lessons");
  $urlRouterProvider.when('/people/:profileID', '/people/:profileID/journal');

  //
  // Now set up the states
  $stateProvider
    .state('login', {
      url: "/login",
      templateUrl: "/templates/login/login.html",
      controller: 'LoginController'
    })

    // Profile
    .state('profile', {
      abstract: true,
      templateUrl: '/templates/profile/profile.html',
      controller: 'ProfileController'
    })
    .state('profile.lessons', {
      url: "/lessons",
      templateUrl: '/templates/profile/profile.lessons.html',
      controller: 'LessonsController',
      resolve: { 
        lessons: function(LessonsService) {
          return LessonsService.get();
        }
      }
    })
    .state('profile.lesson-detail', {
      url: "/lessons/:lessonID",
      templateUrl: '/templates/profile/profile.lesson-detail.html',
      controller: 'LessonDetailController',
      resolve: { 
        lesson: function(LessonsService, $stateParams) {
          return LessonsService.get($stateParams.lessonID);
        }
      }
    })

    // Account Settings
    .state('account-settings', {
      abstract: true,
      url: "/account-settings",
      templateUrl: '/templates/account-settings/account-settings.html'
    })
    .state('account-settings.account-summary', {
      url: "/account-summary",
      templateUrl: '/templates/account-settings/account-settings.account-summary.html',
      controller: 'AccountSummaryController'
    })
    .state('account-settings.billing-info', {
      url: "/billing-info",
      templateUrl: '/templates/account-settings/account-settings.billing-info.html'      
    })
    .state('account-settings.upgrade', {  
      url: "/upgrade",    
      templateUrl: '/templates/account-settings/account-settings.upgrade.html',
      controller: 'UpgradeController',
      resolve: { 
        subscriptions: function(SubscriptionService) {
          return SubscriptionService.get();
        }
      }
    })

    // Help
    .state('help', {
      abstract: true,
      url: "/help",
      templateUrl: '/templates/help/help.html'
    })
    .state('help.faq', {
      url: "/faq",
      templateUrl: '/templates/help/help.faq.html'
    })
    .state('help.contact', {
      url: "/contact",
      templateUrl: '/templates/help/help.contact.html'      
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