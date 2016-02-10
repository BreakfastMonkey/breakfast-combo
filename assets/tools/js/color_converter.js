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

        if (!isNaN(parseInt(hex.substring(), 16))) {
            var r = parseInt(hex.substring(0,2), 16);
            var g = parseInt(hex.substring(2,4), 16);
            var b = parseInt(hex.substring(4,6), 16);

            result = (hex.length == 3 || hex.length > 4) ? "rgb(" + r + "," + g + "," + b + ")" : '';

            var luma = 0.2126 * r + 0.7152 * g + 0.0722 * b; // per ITU-R BT.709

            if (luma < 100) {
                $("input").css({ "color":"#fff", "border-bottom":"#fff solid 1px" });
            } else {
                $("input").css({ "color":"#333", "border-bottom":"#333 solid 1px" });
            }

            $scope.rgbValue = result;
            $scope.newColor = result;
        }
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
