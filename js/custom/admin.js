jQuery(document).ready(function(){

	var username = $.cookie('username');
	jQuery('#username').text(username);		//设置值
	
	jQuery('.menu_article').click(function(){	
		jQuery('.main-wrap').html("");
		var iframecode=' <iframe class="result-wrap" name="iframe_article" width="100%" height="100%" src="articleTable.html" frameborder="0" scrolling="auto"></iframe> ';
		jQuery('.main-wrap').append(iframecode);
	});
	jQuery('.menu_upload').click(function(){	
		jQuery('.main-wrap').html("");
		var iframecode='<iframe class="result-wrap" name="iframe1" width="100%" height="100%" src="upload.html" frameborder="0" ></iframe>';
		jQuery('.main-wrap').append(iframecode);
	});
	jQuery('.menu_comments').click(function(){	
		jQuery('.main-wrap').html("");
		var iframecode='<iframe class="result-wrap" name="iframe_comment" width="100%" height="100%" src="comment.html" frameborder="0" ></iframe>';
		jQuery('.main-wrap').append(iframecode);
	});	
});














