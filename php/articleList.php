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
  	// $m_theme="8";

  	$returnData=array();	//return data
  	$status = FAILED;

  	//获取参数
  	$m_data=array();
	$mysqli = connectSQL();

	/* 查询theme数据表和article数据表 */
	$index=0;
	if($m_theme=="100"){
		$article_sql = "SELECT title,author,themeId,pointNum,clickNum,storeNum,commentNum,createDate,articleId,keyTag FROM article "; 

	}else{
		$article_sql = "SELECT title,author,themeId,pointNum,clickNum,storeNum,commentNum,createDate,articleId,keyTag FROM article where themeId='$m_theme' "; 
	}
	if($article_result=mysqli_query($mysqli,$article_sql))
	{
		$status = SUCCESSED;
		while($article_obj=mysqli_fetch_object($article_result))  
		{
			//寻找theme名称
			// $status = SUCCESSED;
		    $data=array();
   			$data['title']=$article_obj->title;	
			$data['author']=$article_obj->author;
			$data['pointNum']=$article_obj->pointNum;
			$data['clickNum']=$article_obj->clickNum;
			$data['storeNum']=$article_obj->storeNum;
			$data['commentNum']=$article_obj->commentNum;
			$data['createDate']=$article_obj->createDate;
			$data['articleId']=$article_obj->articleId;
			$data['tag']=$article_obj->keyTag;
			$mm_theme=$article_obj->themeId;

			$theme_sql="SELECT theme FROM theme WHERE themeId='$mm_theme' ";
			if($theme_result=mysqli_query($mysqli,$theme_sql)){
				if($theme_obj=mysqli_fetch_object($theme_result)){
					$data['theme']=$theme_obj->theme;
				}
				mysqli_free_result($theme_result);
			}
			$m_data[$index]=$data;
			$index++;
		}
		mysqli_free_result($article_result);
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
	    	// $err_type = ERR_SQL_CON;
	        // echo "connect mysql error:".mysqli_connect_error();  
	        $returnData['status'] = $status;
        	echo json_encode($returnData);
	        exit(0);  
	    }
		mysqli_set_charset ($mysqli,"utf8");
		return $mysqli;
	}

?>
























