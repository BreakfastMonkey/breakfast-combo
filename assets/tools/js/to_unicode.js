function toUnicode(rawString) {
  var unicodeString = '';
  for (var i = 0; i < rawString.length; i++) {
      var unicodeChar = rawString.charCodeAt(i).toString(16);
      while(unicodeChar.length < 4){
	  unicodeChar = '0' + unicodeChar;
      }
      unicodeChar = '\\u' + unicodeChar;
      unicodeString = unicodeString + unicodeChar;
  }
  return unicodeString;
}
