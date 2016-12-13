<?php
	/*
	 -------------------------------------------------
	 *功能: 获取数据库中所有的文章
	 *请求参数：无
	 *返回: 见接口表
	 -------------------------------------------------
	*/
	require_once('config.php');
  	header('Content-type: application/json');  //发送报头

  	$m_articleId=$_GET['filename'];
  	$data="";

  	$artPath='../data/articles/';
	if (is_dir($artPath)) 
	{
		if ($dh = opendir($artPath)) {
			while (($file = readdir($dh)) !== false) 
			{
				if(strlen($file)>16){
					if(substr($file, 0,16)==$m_articleId){
						$file_url=$artPath.$file;
						$data= file_get_contents($file_url);
					}
				}
			}
			closedir($dh);
		}
	}
	echo $data;

?>

























	