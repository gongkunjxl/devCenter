<?php
	/*
	 -------------------------------------------------
	 *功能: 普通用户进行登陆
	 *请求参数：login
	 *传递参数：username.password
	 *返回: 见接口表
	 -------------------------------------------------
	*/
	require_once('config.php');
  	header('Content-type: application/json');  //发送报头
    $data=array();
    $data["username"]=$_POST['username'];    
    $data["password"]=$_POST['password']; 
    $status = FAILED;
     //echo json_encode($data);

 	//获取参数
	$m_data = array();		//构造返回数组
	$mysqli = new mysqli(DB_HOST, DB_USR, DB_PWD, DB_NM);
	if(mysqli_connect_errno())//检查连接是否被创建 
	{  
	    //$err_type = ERR_SQL_CON;
	    exit(0);  
	}
	mysqli_set_charset ($mysqli,"utf8");

	$m_user = $data["username"]; 
	$m_pwd = $data["password"];

	$account_sql = "SELECT username FROM account where username='$m_user' and password='$m_pwd' "; 	
	if($account_result=mysqli_query($mysqli,$account_sql))
	{
		if($account_obj=mysqli_fetch_object($account_result))  
		{
			$status = SUCCESSED;
			$m_data["username"]=$account_obj->username;
			mysqli_free_result($account_result);
		}
	}	
	$m_data['status'] = $status;
	echo json_encode($m_data);
?>
























