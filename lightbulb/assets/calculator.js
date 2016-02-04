/* JavaScript Document */
/*create an enclosure of an anonymous function, to declear angular application for html*/
(function(){

	var app = angular.module('myCalculator',[]);/*declear variable app to be the name of myCalculator*/
	/*add scope service*/
	app.controller('CalculatorController',['$scope','$interval', function($scope, $interval){
		$scope.format = 'M/d/yy h:mm:ss a';
		$scope.lumen_options = [375, 600, 900, 1125, 1600];
		$scope.current_lumens = 600;
		$scope.current_cost = 12;
		$scope.current_hours = 3;
		$scope.total_days = 365;

		$scope.inc_conversion = .0625;
		$scope.hal_conversion = .0450;
		$scope.cfl_conversion = .0146;
		$scope.led_conversion = .0125;

		$scope.calculate = function(){
			
			$scope.inc_wattage = ($scope.current_lumens * $scope.inc_conversion).toFixed(1); //1 decimal points
			$scope.hal_wattage = ($scope.current_lumens * $scope.hal_conversion).toFixed(1); 
			$scope.cfl_wattage = ($scope.current_lumens * $scope.cfl_conversion).toFixed(1); 
			$scope.led_wattage = ($scope.current_lumens * $scope.led_conversion).toFixed(1); 

			if ( $scope.current_hours > 24 ) { $scope.current_hours = 24 };
			if ( $scope.current_cost < 0 ) { $scope.current_cost = 0 };


			$scope.inc_yearlyCost = ($scope.current_cost * $scope.current_hours * $scope.inc_wattage * $scope.total_days / 100000).toFixed(2);
			$scope.hal_yearlyCost = ($scope.current_cost * $scope.current_hours * $scope.hal_wattage * $scope.total_days / 100000).toFixed(2);
			$scope.cfl_yearlyCost = ($scope.current_cost * $scope.current_hours * $scope.cfl_wattage * $scope.total_days / 100000).toFixed(2);
			$scope.led_yearlyCost = ($scope.current_cost * $scope.current_hours * $scope.led_wattage * $scope.total_days / 100000).toFixed(2);

		}

		$scope.calculate();

	}]);

	app.directive('myCurrentTime', ['$interval', 'dateFilter',
      function($interval, dateFilter) {
        // return the directive link function. (compile function not needed)
        return function(scope, element, attrs) {
          var format,  // date format
              stopTime; // so that we can cancel the time updates

          // used to update the UI
          function updateTime() {
            element.text(dateFilter(new Date(), format));
          }

          // watch the expression, and update the UI on change.
          scope.$watch(attrs.myCurrentTime, function(value) {
            format = value;
            updateTime();
          });

          stopTime = $interval(updateTime, 1000);

          // listen on DOM destroy (removal) event, and cancel the next UI update
          // to prevent updating time after the DOM element was removed.
          element.on('$destroy', function() {
            $interval.cancel(stopTime);
          });
        }
      }]);

})();


