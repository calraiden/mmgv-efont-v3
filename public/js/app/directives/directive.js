SiteApp.directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        return parseFloat(value, 10);
      });
    }
  };
});

SiteApp.directive('compileHtml', function ($compile) {
	return function (scope, element, attrs) {
		scope.$watch(
				function(scope) {
					return scope.$eval(attrs.compileHtml);
				},
				function(value) {
					element.html(value);
					$compile(element.contents())(scope);
				}
		);
	};
});

SiteApp.directive('myMaxlength', function($compile, $log) {
	return {
		restrict: 'A',
		require: 'ngModel',
		link: function (scope, elem, attrs, ctrl) {
			attrs.$set("ngTrim", "false");
            var maxlength = parseInt(attrs.myMaxlength, 10);
            ctrl.$parsers.push(function (value) {
                //$log.info("In parser function value = [" + value + "].");
                if (value.length > maxlength)
                {
                    //$log.info("The value [" + value + "] is too long!");
                    value = value.substr(0, maxlength);
                    ctrl.$setViewValue(value);
                    ctrl.$render();
                    //$log.info("The value is now truncated as [" + value + "].");
                }
                return value;
            });
		}
	};
});

SiteApp.filter('stripslashes', function () {
    return function (data) {
    	if(data != null && data.length > 1){
    		return stripslashes(data);
    	}else{
    		return (data != 'null')?data:'';
    	}
    };
});

SiteApp.filter('comma2decimal', function () {
	return function(input) {
		return input.toLocaleString('de-DE');
	};
});

SiteApp.filter('userimage', function () {
    return function (data) {
    	if(data != null && data.length > 1){
    		return data;
    	}else{
    		return '/img/logo.png';
    	}
    };
});

SiteApp.filter('dateFormat', function($filter){
	return function(input){
		if(input == null){ 
			return ""; 
		} 
		var _date = $filter('date')(new Date(input), 'dd/MM/yyyy HH:mm:ss');
		return _date.toUpperCase();
	};
});

SiteApp.filter('dateFormatWithouHours', function($filter){
	return function(input){
		if(input == null){ 
			return ""; 
		} 
		var _date = $filter('date')(new Date(input), 'dd/MM/yyyy');
		return _date.toUpperCase();
	};
});

SiteApp.filter('trustUrl', function ($sce) {
	return function(url) {
		return $sce.trustAsResourceUrl(url);
	};
});