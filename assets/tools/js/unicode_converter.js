/*JavaScript only for Unicode Converter*/
var app = angular.module('unicodeConverterTool', []);

app.controller('unicodeConverterCtrl', function($scope) {
    var unicodeString = '';
    $scope.toUnicode = function() {
      unicodeString = '';
      for (var i = 0; i < $scope.yourText.length; i++) {

      var unicodeChar = $scope.yourText.charCodeAt(i).toString(16);
      while(unicodeChar.length < 4){
        unicodeChar = '0' + unicodeChar;
      }
      unicodeChar = '\\u' + unicodeChar;
      unicodeString = unicodeString + unicodeChar;
    }
    $scope.unicodeText = unicodeString;
    }
});

var copyTextareaBtn = document.querySelector('.textareacopybtn');

  copyTextareaBtn.addEventListener('click', function(event) {
    var copyTextarea = document.querySelector('.copytextarea');
    copyTextarea.select();

    try {
      var successful = document.execCommand('copy');
      
    } catch (err) {
      alert("Your browser does not support this function,\nplease select and copy manually instead.");
    }
  });