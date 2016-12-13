<?php
	/*
	 -------------------------------------------------
	 *功能: 获取数据库中所有的文章
	 *请求参数：无
	 *传递参数：theme(文章主题)
	 *返回: 见接口表
	 -------------------------------------------------
	*/
	require_once('config.php');
  	header('Content-type: application/json');  //发送报头

  	$m_theme=$_POST['themeId'];
  	 // $m_theme="100";

  	$returnData=array();	//return data
  	$status = FAILED;

  	//获取参数
  	$m_data=array();
	$mysqli = connectSQL();

	/* 查询theme数据表和article数据表 */
	$index=0;
	if($m_theme=="100"){
		$comment_sql = "SELECT id,articleId,userId,commentDate,content FROM comment "; 

	}else{
		$comment_sql = "SELECT id,articleId,userId,commentDate,content FROM comment  where themeId='$m_theme' "; 
	}
	if($comment_result=mysqli_query($mysqli,$comment_sql))
	{
		$status = SUCCESSED;
		while($comment_obj=mysqli_fetch_object($comment_result))  
		{
			//寻找theme名称
			// $status = SUCCESSED;
		    $data=array();
   			$data['id']=$comment_obj->id;	
			// $data['title']=$comment_obj->title;
			$m_articleId=$comment_obj->articleId;
			$data['user']=$comment_obj->userId;
			$data['content']=$comment_obj->content;
			$data['commentDate']=$comment_obj->commentDate;

			$theme_sql="SELECT title FROM article WHERE articleId='$m_articleId' ";
			if($article_result=mysqli_query($mysqli,$theme_sql)){
				if($article_obj=mysqli_fetch_object($article_result)){
					$data['title']=$article_obj->title;
				}
				mysqli_free_result($article_result);
			}
			$m_data[$index]=$data;
			$index++;
		}
		mysqli_free_result($comment_result);
	}	
	$mysqli->close();
	$returnData['status'] = $status;
	$returnData['data'] = $m_data;
	echo json_encode($returnData);

  	//连接数据库的函数
	function connectSQL()
	{
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
























