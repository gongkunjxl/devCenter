<?php
  /*
  -------------------------------------------------
  *功能: 插入文章
  *请求参数: 
  *传递参数:
  *author: Kun Gong
  ------------------------------------------
  *author: Kung gong-------*/

require_once('config.php');
$issuc=true;
$res["error"] = "";//错误信息
$res["msg"] = "";//提示信息

//article数据表需要的信息
$m_title=$_POST['title'];
$m_author=$_POST['author'];
$m_themeId=$_POST['theme'];
$m_pointNum='0';
$m_clickNum='0';
$m_storeNum='0';
$m_commentNum='0';
$m_createDate='';
$m_articleId='';
$m_keyTag=$_POST['tag'];
$m_imgFormat='';
$m_artFormat='';
file_put_contents("test.txt",$m_themeId.'__',FILE_APPEND);
file_put_contents("test.txt",$m_title.'__',FILE_APPEND);
file_put_contents("test.txt",$m_author.'__',FILE_APPEND);
file_put_contents("test.txt",$m_keyTag.'__',FILE_APPEND);

$imgPath="../data/images/";
$artPath="../data/articles/";
$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','M', 'W', 'D', 'E','B');
$ind = rand(0,14);
$m_articleId = $yCode[$ind] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));


$file_list=explode(',',$_POST['gtpfile']);
for($i=0; $i<count($file_list); $i++)
{
    // $upFilePath = "./".time()."_".$i.".".pathinfo($_FILES[$file_list[$i]]['name'],PATHINFO_EXTENSION);
    $upFilePath="";
    if($i<1){
      $upFilePath=$imgPath.$m_articleId.'.'.pathinfo($_FILES[$file_list[$i]]['name'],PATHINFO_EXTENSION);
      $m_imgFormat=pathinfo($_FILES[$file_list[$i]]['name'],PATHINFO_EXTENSION);
      file_put_contents("test.txt",$m_imgFormat.'__',FILE_APPEND);

    }else{
      $upFilePath=$artPath.$m_articleId.'_'.pathinfo($_FILES[$file_list[$i]]['name'],PATHINFO_BASENAME);
      $m_artFormat=pathinfo($_FILES[$file_list[$i]]['name'],PATHINFO_EXTENSION);
      file_put_contents("test.txt",$m_artFormat.'__',FILE_APPEND);
    }
    if(move_uploaded_file($_FILES[$file_list[$i]]['tmp_name'],$upFilePath))
    {
  
      // $file_infor = var_export($_FILES,true);
      // file_put_contents("test.txt",$file_infor,FILE_APPEND);   
      $issuc=true&$issuc;
    }else{
      $issuc=false&$issuc;
    }
}
  if($issuc){
      $res["msg"] = $_POST['gtpname']." Upload successed!";
      //插入数据库
     $m_createDate= date("Y-m-d H:i:s", time());  //文章创建时间
     $mysqli = connectSQL();
     $insert_sql="insert into article(title,author,themeId,pointNum,clickNum,storeNum,commentNum,createDate,articleId,keyTag,imgFormat,artFormat) values('$m_title','$m_author','$m_themeId','$m_pointNum','$m_clickNum','$m_storeNum','$m_commentNum','$m_createDate','$m_articleId','$m_keyTag','$m_imgFormat','$m_artFormat') ";
     if(mysqli_query($mysqli,$insert_sql)){ //执行插入操作
           //     $res["msg"]='';
           // $res["error"]="error";
        if(mysqli_affected_rows($mysqli)){  //判断是否执行成功   
        }else{
           $res["msg"]='';
           $res["error"]="mysql insert error";
        } 
    }else{
        $res["msg"]='';
        $res["error"]="mysql insert error";
    }
    $mysqli->close();  //close 

  }else{
      $res["error"] = "error";
  }

  if(empty($m_themeId) || empty($m_author) || empty($m_title)){
    $res["error"] = "error";
  }
  echo json_encode($res);

//连接数据库的函数
  function connectSQL()
  {
    // global $err_type;
    $mysqli = new mysqli(DB_HOST, DB_USR, DB_PWD, DB_NM);
    if(mysqli_connect_errno())//检查连接是否被创建 
    {  
        // $err_type = ERR_SQL_CON;
          // echo "connect mysql error:".mysqli_connect_error();  
        $res["error"] = "mysql error";
        echo json_encode($res);
         exit(0);  
    }
    mysqli_set_charset ($mysqli,"utf8");
    return $mysqli;
   }

   

?>






















