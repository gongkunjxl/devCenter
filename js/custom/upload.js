jQuery(document).ready(function(){

 	function ajaxFileUpload()
    {
    	alert("start upload");
        //loading();//动态加载小图标
        var gtpfile=['upload-picture','upload-article'];
        var str={
        	theme:jQuery('#selectTheme').val(),
        	title:jQuery('#title').val(),
        	author:jQuery('#author').val(),
        	tag:jQuery('#article-tag').val(),
        	gtpfile:gtpfile
        };

        $.ajaxFileUpload ({
	         url:'./php/upload.php',
	         type:"post",
	         data:str,
	         secureuri:false,
	         fileElementId: gtpfile,
	         dataType: 'json',
	         success: function(data, status) {
				if (typeof(data.error) != 'undefined') {
					if (data.error != '') {
                       	swal("Sorry: ", data.error, "error");
					} else {
                        swal("Good job!", data.msg, "success");
					}
				}
			},
			error: function(data, status, e) {
                swal("Sorry: ", e, "error");
			}
         }); 
        return false;
    }

	jQuery('#uploadSub').click(function(){	 //handle 筛选
		var m_theme=jQuery('#selectTheme').val();
		var m_title=jQuery('#title').val();
		if(m_title==""){

			alert("Please input title!");	
			return;
		}
		var m_author=jQuery('#author').val();
		if(m_author==""){
			alert("Please input author!");	
			return;
		}	
		// alert("come here");
		var image_path=jQuery('#upload-picture').val();
		if(image_path==""){
			alert("Please select theme picture!");
			return;
		}

		var m_tag=jQuery('#article-tag').val();
		if(m_tag==""){
			alert("Please input article Keywords!");	
			return;
		}


		var article_path=jQuery('#upload-article').val();
		// var content=jQuery('#content').val();

		if(article_path==""){
			alert("Please select an article file!");
			return;
		}
		// if((article_path!="")&&(content!="")){
		// 	alert("You can only choose one method to upload articles!");
		// 	return;
		// }
		//upload image 
	 	ajaxFileUpload();


	});

	//test get file
	// jQuery('#getArticle').click(function(){	 //handle 筛选
	// 	getFile();
	// });


});
// function getFile(){
// 	alert("get file");
// 	var articleId="DB15936361387012";
// 	jQuery.ajax({
// 	    url: "./php/getFile.php",  
// 	    type: "POST",
// 	    data:{
// 	       	"articleId":articleId
// 	    },
// 	    dataType: "json",
// 	    async: false,
// 	    error: function(){  
// 	      	alert('Error delete article'); 
//         },  
// 	    success: function(data){  
// 	    	if(data['status']=='200'){
// 	    		alert(data['articleId']);
// 	    		//alert('delete article sucessed!');
// 	    	}else{
// 	    		alert('delete failed');
// 	    	}
// 	    	// alert(data['articleId']);
// 	    }
// 	});
	
// }















