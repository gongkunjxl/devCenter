<?php
	/*
	-------------------------------------------------
	*功能: 上传评论内容
	*请求参数: genOrder
	*传递参数: 
	-------------------------------------------------*/
	require_once('config.php');
	header('Content-type: application/json');  //发送报头

	$m_content=$_POST['content'];	
	$m_articleId=$_POST['articleId'];
	$m_userId=$_POST['userId'];
	$m_themeId=$_POST['themeId'];

	// $m_content='All of us have read thrilling stories in which the hero had only a limited and specified time to live.';	
	// $m_articleId='MB15891782498854';
	// $m_userId='Admin';
	// $m_themeId='6';     



  	$returnData=array();		//return data
  	$status = FAILED;

	

	$mysqli = connectSQL();
	$m_commentDate= date("Y-m-d H:i:s", time());  //文章创建时间

	$insert_sql="insert into comment(articleId,userId,commentDate,content,themeId) values('$m_articleId','$m_userId','$m_commentDate','$m_content','$m_themeId') ";	
	if(mysqli_query($mysqli,$insert_sql)){ //执行插入操作
		if(mysqli_affected_rows($mysqli)){  //判断是否执行成功
			$status=SUCCESSED;
		}
	}
	$mysqli->close();  
	$returnData['status'] = $status;
 	echo json_encode($returnData);  //返回数据



	//连接数据库的函数
	function connectSQL()
	{
		// global $err_type;
		$mysqli = new mysqli(DB_HOST, DB_USR, DB_PWD, DB_NM);
		if(mysqli_connect_errno())//检查连接是否被创建 
	    {  
	    	$returnData['status'] = $status;
        	echo json_encode($returnData);
	        exit(0);  
	    }
		mysqli_set_charset ($mysqli,"utf8");
		return $mysqli;
	}
	
?>








