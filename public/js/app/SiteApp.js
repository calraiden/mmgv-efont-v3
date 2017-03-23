var SiteApp = angular.module('SiteApp', ['ngSanitize','ngStorage','angular-loading-bar']);
/* Config */
SiteApp.config(function($locationProvider) { 
	$locationProvider.html5Mode(false); 
});
SiteApp.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
}]);

SiteApp.config(function($sceDelegateProvider) {
	$sceDelegateProvider.resourceUrlWhitelist(['self','http://media.w3.org/**']);
});
/* Run */
SiteApp.run(function($rootScope, $timeout) {
	//Loading
	$rootScope.$on('$stateChangeStart',function(){
		isSpinnerBar(true);
	});
	$rootScope.$on('$stateChangeSuccess',function(){
		isSpinnerBar(false);
	});	
});