
/*JavaScript only for colorConverter*/
var app = angular.module('colorConverterTool', []);

app.controller('colorConverterCtrl', function($scope) {
    $scope.newColor = '#ffffff';

    $scope.toRgb = function() {
        var result;
        if( $scope.hexValue !== null ) {
            var hex = $scope.hexValue.replace('#','');
            if ( hex.length === 3 ) {
                hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
            }
        }

        if( hex.length >= 3 ) {
            var r = parseInt(hex.substring(0,2), 16);
            var g = parseInt(hex.substring(2,4), 16);
            var b = parseInt(hex.substring(4,6), 16);

            result = 'rgb('+r+','+g+','+b+')';
        }

        $scope.rgbValue = result;
        $scope.newColor = result;
    }
});
