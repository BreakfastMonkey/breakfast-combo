/*JavaScript only for colorConverter*/
var app = angular.module('colorConverterTool', []);

app.controller('colorConverterCtrl', function($scope) {
    var result = '';
    $scope.newColor = '#ffffff';

    $scope.toRgb = function() {
        if( $scope.hexValue !== null ) {
            var hex = $scope.hexValue.replace('#','');
            if ( hex.length === 3 ) {
                hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
            }
        }

        result = (hex.length == 3 || hex.length > 4) ? "rgb(" +
          parseInt(hex.substring(0,2), 16) + "," +
          parseInt(hex.substring(2,4), 16) + "," +
          parseInt(hex.substring(4,6), 16) + ")" : '';

        $scope.rgbValue = result;
        $scope.newColor = result;
    }

    $scope.toHex = function() {
         var rgb = $scope.rgbValue.match(/[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
         result = (rgb && rgb.length === 4) ? "#" +
          ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
          ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
          ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';

          $scope.hexValue = result;
          $scope.newColor = result;
    }
});
