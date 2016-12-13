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
  	$returnData=array();	//return data
  	$status = FAILED;

  	//get the request data
  	$user_id=$_GET['uid'];
  	$theme_index=$_GET['themeIndex'];

  	$mysqli = connectSQL();
  	$m_ind=intval($theme_index);
  	$m_theme="";
  	$themeName="";
  	$m_count=0;
  	$theme_sql="SELECT theme,themeId FROM theme ORDER BY themetime desc";

	if($theme_result=mysqli_query($mysqli,$theme_sql)){
		while($theme_obj=mysqli_fetch_object($theme_result)){
			// echo $m_theme."  ".$themeName."\n";
			$m_ind++;	$m_count++;
			if($m_ind==1){
				$m_theme=$theme_obj->themeId;
				$themeName=$theme_obj->theme;
			}
		}
		mysqli_free_result($theme_result);
	}
	
	if($m_ind<1){
		$returnData['abort']=$status;
		echo json_encode($returnData);
		exit(0);
	}

	$returnData['themeName']=$themeName;
	$returnData['themeId']=$m_theme;
	$returnData['img']=HOST_URL.'/data/theme/'.$m_theme.'.jpg';
	$returnData['maxThemeNum']=$m_count;

	$m_data=array();
	$article_sql = "SELECT title,author,themeId,pointNum,clickNum,storeNum,commentNum,createDate,articleId,keyTag FROM article where themeId='$m_theme' "; 
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
			$data['supportNum']=$article_obj->pointNum;
			$data['readingNum']=$article_obj->clickNum;
			//$data['storeNum']=$article_obj->storeNum;
			$data['commentNum']=$article_obj->commentNum;
			$data['timestamp']=$article_obj->createDate;
			$data['articleId']=$article_obj->articleId;
			$data['text']=$article_obj->keyTag;
			// $mm_theme=$article_obj->themeId;
			$data['img']=HOST_URL.'/data/images/'.$data['articleId'].'jpg';

			$m_data[$index]=$data;
			$index++;
		}
		mysqli_free_result($article_result);
	}	

	$mysqli->close();
	$returnData['abort']=$status;
	$returnData['ainfos']=$m_data;
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
























