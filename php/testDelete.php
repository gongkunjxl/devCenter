<?php
	$imgPath='../data/images/';
	$artPath='../data/articles/';
	$m_articleId='MB15891782498800';
	if (is_dir($artPath)) 
	{
		if ($dh = opendir($artPath)) {
			while (($file = readdir($dh)) !== false) 
			{
				if(strlen($file)>16){
					if(substr($file, 0,16)==$m_articleId){
						// echo substr($file, 0,16)."\n";
						//echo $artPath.$file;
						if(unlink($artPath.$file)){
							echo "delete article successed! \n";
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
					if(substr($file, 0,16)==$m_articleId){
						if(unlink($imgPath.$file)){
							echo "delete img successed!\n";
						}
					}
 
				}
			}
			closedir($dh);
		}
	}




?>



