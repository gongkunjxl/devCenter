<?php
	/*
	 -------------------------------------------------
	 *功能: 获取数据库中所有的文章
	 *请求参数：articleId
	 *传递参数：articleId
	 *返回: 见接口表
	 -------------------------------------------------
	*/
	require_once('config.php');
  	header('Content-type: application/json');  //发送报头

  	$m_articleId=$_POST['articleId'];
  	$returnData=array();	//return data
  	$status = FAILED;
  	// $returnData['articleId']=$m_articleId;

  	 $mysqli = connectSQL();
  	 $delete_sql="DELETE FROM article WHERE articleId='$m_articleId' ";
  	 if(mysqli_query($mysqli,$delete_sql)){ 
        if(mysqli_affected_rows($mysqli)){   //判断是否执行成功 
        	if(deleteFile($m_articleId)){	//delete
        		$status=SUCCESSED;  
        	} 
        }   
      }
    $mysqli->close();  //close 

  	$returnData['status']=$status;
	echo json_encode($returnData);

  	//连接数据库的函数
	function connectSQL()
	{
		$mysqli = new mysqli(DB_HOST, DB_USR, DB_PWD, DB_NM);
		if(mysqli_connect_errno())//检查连接是否被创建 
	    {  
	        // echo "connect mysql error:".mysqli_connect_error();  
	        $returnData['status'] = $status;
        	echo json_encode($returnData);
	        exit(0);  
	    }
		mysqli_set_charset ($mysqli,"utf8");
		return $mysqli;
	}

	//delete article and image
	function deleteFile($articleId){
		$flag1=false;	$flag2=false;
		$imgPath='../data/images/';
		$artPath='../data/articles/';
		$mm_articleId=$articleId;
		if (is_dir($artPath)) 
		{
			if ($dh = opendir($artPath)) {
				while (($file = readdir($dh)) !== false) 
				{
					if(strlen($file)>16){
						if(substr($file, 0,16)==$mm_articleId){
							// echo substr($file, 0,16)."\n";
							if(unlink($artPath.$file)){
								$flag1=true;
								// echo "delete article successed! \n";
							} 
						}
					}
			// echo "filename: $file : filetype: " . filetype($artPath . $file) . "\n";
				}
				closedir($dh);
			}
		}
		if (is_dir($imgPath)) 
		{
			if ($dh = opendir($imgPath)) {
				while (($file = readdir($dh)) !== false) 
				{
					if(strlen($file)>16){
						if(substr($file, 0,16)==$mm_articleId){
							if(unlink($imgPath.$file)){
								$flag2=true;
								// echo "delete img successed!\n";
							}
						}
	 
					}
				}
				closedir($dh);
			}
		}
		if($flag1 && $flag2){
			return true;
		}else{
			return false;
		}

	}


?>
























