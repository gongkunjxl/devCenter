三个访问接口

* 请求用户的主题文章列表(目前15个主题)
- method: GET

- url: http://serverIP:PORT/getArticle.php?uid=[userID]&themeIndex=[themeOffset]

	uid对应用户登录后分配的唯一ID号(暂时没用)
	其中，themeOffset是针对当前timestamp下主题的偏移，例如获取上个主题时，themeOffset=-1

return: JSON
{
	themeName: XXXXX,	//主题名
	themeId: XXXXXX,	//主题发ID号 1，2，3,,,,15
	img: http://XXXX.jpg,    //theme img's absolute path in server, e.g. www/1.jpg 
	abort: "XXXX",			//200标识成功返回 100标识请求失败(最好用status)
	maxThemeNum: XXXX, 		//有多少主题(目前15个)
	ainfos:
	[
		{
			articleId:	XXXXX,	//文章ID号
			title: XXXXX,		//文章标题
			author: XXXXX,		//作者
			img: http://XXX.jpg,//图片
			text: string,		//文章关键字
			timestamp: datatime,	//创建时间
			readingNum: XXX,		//阅读量	
			supportNum: XXXXX,		//点赞数
			commentNum: iXXXX		//评论数
		},
		{
			articleId:	XXXXX,	//文章ID号
			title: XXXXX,		//文章标题
			author: XXXXX,		//作者
			img: http://XXX.jpg,//图片
			text: string,		//文章关键字
			timestamp: datatime,	//创建时间
			readingNum: XXX,		//阅读量	
			supportNum: XXXXX,		//点赞数
			commentNum: iXXXX		//评论数
		},

	]
}


* 获取文章内容
* method: GET
* http://serverIP:PORT/getFile.php?filename=[articleId]	//传入文章ID号
return: 数据流


* 对文章评论
* method POST
* http://serverIP:PORT/postComment.php

{	
	articleId:	XXX,	//评论文章的ID
	userId:		XXXXX,	//评论用户的ID(暂时用用户名)
	themeId：	XXXX,	//评论主题ID
	content：	XXXX,	//评论内容

}
return :JSON
{
	status: 100/200		//200表示评论成功，100表示评论失败
}




















