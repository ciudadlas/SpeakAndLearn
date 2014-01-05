<!doctype html>
<html lang="en" ng-app="app">

	<head>
	    <meta name="viewport" content="width=device-width">
		<meta charset="UTF-8">
		<title> Speak & Learn </title>
		<link rel="stylesheet" href="/css/app.css">

		<!-- Angular.js -->
		<!--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.2/angular.min.js"> </script> -->
		<script src="/js/lib/angular.min.js"> </script> 

		<!-- Angular.js Route -->
		<!--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.2/angular-route.min.js"> </script> -->
		<!--<script src="js/lib/angular-route.min.js"> </script> -->

		<!-- AngularUI Router -->
		<script src="/js/lib/angular-ui-router.min.js"> </script>

		<!-- Angular.js Sanitize -->	
		<!--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.2/angular-sanitize.min.js"> </script>-->
		<script src="/js/lib/angular-sanitize.min.js"> </script> 

		<script src="/js/lib/angular-audio-player.min.js"> </script>

		<!-- Underscore.js -->	 
		<!--<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"> </script>	-->
		<script src="/js/lib/underscore-min.js"> </script> 

    	<!--<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootswatch/3.0.0/simplex/bootstrap.min.css">-->
    	<link rel="stylesheet" href="/css/bootstrap.min.css">

    	<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->
    	<script src="/js/lib/jquery.min.js"> </script> 

    	<!--<script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>-->
    	<script src="/js/lib/bootstrap.min.js"> </script>    	

    	<script src="/js/lib/ui-bootstrap-tpls-0.9.0.min.js"> </script>

		<script src="/js/lib/mediaelement/mediaelement-and-player.min.js"></script>
		<link rel="stylesheet" href="/js/lib/mediaelement/mediaelementplayer.css" />


    	<script type="text/javascript" src="https://js.braintreegateway.com/v1/braintree.js"></script>

			
		<script src="/js/app.js"> </script>
		<!-- Controllers -->
		<script src="/js/controllers/HomeController.js"> </script>
		<script src="/js/controllers/LoginController.js"> </script>
		<script src="/js/controllers/LessonsController.js"> </script>
		<script src="/js/controllers/LessonDetailController.js"> </script>

		
		<script src="/js/controllers/ProfileController.js"> </script>
		<script src="/js/controllers/ProfileJournalController.js"> </script>
		<script src="/js/controllers/UpgradeController.js"> </script>
		<script src="/js/controllers/AccountSummaryController.js"> </script>


		<!-- Services -->
		<script src="/js/services/AuthenticationService.js"> </script>
		<script src="/js/services/FlashService.js"> </script>
		<script src="/js/services/SessionService.js"> </script>
		<script src="/js/services/LessonsService.js"> </script>
		<script src="/js/services/ProfileService.js"> </script>
		<script src="/js/services/JournalService.js"> </script>
		<script src="/js/services/SubscriptionService.js"> </script>
		<script src="/js/services/AccountService.js"> </script>


		<!-- Directives -->
		<script src="/js/directives/ShowsMessageWhenHovered.js"> </script>
		<script src="/js/directives/MediaElement.js"> </script>

		

		<script>
	 	   angular.module("app").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');
	 	   angular.module("app").constant("BT_CSEK", '<?php echo Config::get("laravel-braintree::braintree.clientSideEncryptionKey"); ?>');
	 	   
		</script>
	</head>

	<body>
		<div class="navbar navbar-default">
		    <div class="container">
		        <div class="navbar-header">
		            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		                <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
		            </button><a href="#" class="navbar-brand"><b>Speak & Learn</b></a>
		        </div>

                <ul class="nav pull-right">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, User <b class="caret"></b></a>
                        <ul class="dropdown-menu">                        	
                            <li><a ui-sref='account-settings.account-summary'><i class="glyphicon glyphicon-cog"></i> Account Settings </a></li>
                            <li><a ui-sref='help.faq'><i class="glyphicon glyphicon-question-sign"></i> Help </a></li>
                            <li class="divider"></li>
                            <li><a href="/auth/logout"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
		    </div>
		</div>
		
		<div id="flash" ng-show="flash">
			{{ flash }}
		</div>

		<div id="view" ui-view></div>
	</body>

</html>