CKEDITOR.plugins.add('linkbrowser', {
	"init": function (editor) {
		if (typeof(editor.config.linkBrowser_listUrl) === 'undefined' || editor.config.linkBrowser_listUrl === null) {
			return;
		}
		
		var url = editor.plugins.linkbrowser.path + "browser/browser.html?listUrl=" + encodeURIComponent(editor.config.linkBrowser_listUrl);
		if (editor.config.baseHref) {
			url += "&baseHref=" + encodeURIComponent(editor.config.baseHref);
		}
		
		editor.config.filebrowserBrowseUrl = url;
	}
});
