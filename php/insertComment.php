<?php
	/*
	-------------------------------------------------
	*功能: 插入文章
	*请求参数: genOrder
	*传递参数: userId(购买用户ID) goodsId(购买商品的ID) 
			  payNum(付款流水号) buyNum(购买商品数量)
	-------------------------------------------------*/
	require_once('config.php');
	//测试数据
	$m_content="好茶去浮尘，好书藏内涵，好文字涤心 真是一篇非常不错的好文章";	
	$m_articleId="MB15891782498854";
	$m_userId="CB17894274377967";

	$mysqli = connectSQL();
	//文章ID号
	$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','M', 'W', 'D', 'E','B');
	$ind = rand(0,14);
	$m_commentId = $yCode[$ind] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));

	$m_commentDate= date("Y-m-d H:i:s", time());  //文章创建时间

	$insert_sql="insert into comment(articleId,userId,commentDate,content) values('$m_articleId','$m_userId','$m_commentDate','$m_content') ";
	for($i=0;$i<10;$i++)
	{
		if(mysqli_query($mysqli,$insert_sql)){ //执行插入操作
			if(mysqli_affected_rows($mysqli)){  //判断是否执行成功
				echo "insert into comment successd!!\n";		
			}
		}
		sleep(1);
	}
	$mysqli->close();  

	//连接数据库的函数
	function connectSQL()
	{
		// global $err_type;
		$mysqli = new mysqli(DB_HOST, DB_USR, DB_PWD, DB_NM);
		if(mysqli_connect_errno())//检查连接是否被创建 
	    {  
	    	// $err_type = ERR_SQL_CON;
	        echo "connect mysql error:".mysqli_connect_error();  
	        exit(0);  
	    }
		mysqli_set_charset ($mysqli,"utf8");
		return $mysqli;
	}
	// $returnData['status'] = $err_type;
 	// echo json_encode($returnData,JSON_UNESCAPED_UNICODE);  //返回数据

?>