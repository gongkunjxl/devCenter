jQuery(document).ready(function(){

	jQuery('#searchSubmit').click(function(){	 //handle 筛选
		refreshPage();
	});


});

// function checkHandle()
// {
// 	// var  checkboxes=document.getElementsByName("checkName");
// 	// for (var i = 0; i < checkboxes.length; i++) {
// 	// 	// alert("help");
// 	// 	// alert(checkboxes[i].value);
// 	// }
// 	alert("checked!");
// 	// alert("fuck you"); //good work
// }
function checkALLBox()
{
	var  checkboxes=document.getElementsByName("checkName");
	if(jQuery('#allBox').prop('checked')){
		for (var i = 0; i < checkboxes.length; i++) {
			checkboxes[i].checked=true;
		}
	}else{
		for (var i = 0; i < checkboxes.length; i++) {
			checkboxes[i].checked=false;
		}
	}

}

function editHandle(articleId,help)
{
	alert("handle edit");
	alert(articleId);
}

function delHandle(articleId)
{
	alert("handle Delete");
	jQuery.ajax({
	    url: "./php/deleteArticle.php",  
	    type: "POST",
	    data:{
	       	"articleId":articleId
	    },
	    dataType: "json",
	    async: false,
	    error: function(){  
	      	alert('Error delete article'); 
        },  
	    success: function(data){  
	    	if(data['status']=='200'){
	    		alert('delete article sucessed!');
	    		refreshPage();
	    	}else{
	    		alert('delete failed');
	    	}
	    	// alert(data['articleId']);
	    }
	});
	// alert("handle Delete");
}


//刷新页面
function refreshPage(){
	var m_theme=jQuery('#selectTheme').val();
		jQuery('#tbody').html("");
		jQuery('.list-page').html("");
		// alert(m_theme);

		jQuery.ajax({
	    url: "./php/articleList.php",  
	    type: "POST",
	    data:{
	       	"themeId":m_theme
	    },
	    dataType: "json",
	    async: false,
	    error: function(){  
	      	alert('Error request articleList'); 
        },  
	    success: function(data){  
			if(data['status']=='200'){
				var obj=eval(data['data']);
				var i;
			    for (i = 0; i < obj.length; i++) {	
			    	// alert(obj[i].tag);	
			    	var trcode='<tr>';
			    	// trcode=trcode+'<td class="tc"><input id="checkboxId'+i+ '" value="'+i+'" type="checkbox"></td>';
			    	// trcode=trcode+'<td class="tc"><input id="checkboxId" name="checkName" onclick="checkHandle();" value="'+obj[i].articleId+'" type="checkbox"></td>';
			    	trcode=trcode+'<td class="tc"><input id="checkboxId" name="checkName" value="'+obj[i].articleId+'" type="checkbox"></td>';
			    	// trcode=trcode+'<td>	●'+'</td>';  //title
			    	trcode=trcode+'<td>'+obj[i].title+'</td>';  //title
			    	trcode=trcode+'<td>'+obj[i].tag+'</td>';
			    	trcode=trcode+'<td>'+obj[i].author+'</td>';
			    	trcode=trcode+'<td>'+obj[i].theme+'</td>';
			    	trcode=trcode+'<td>'+obj[i].pointNum+'</td>';
			    	trcode=trcode+'<td>'+obj[i].clickNum+'</td>';
			    	trcode=trcode+'<td>'+obj[i].storeNum+'</td>';
			    	trcode=trcode+'<td>'+obj[i].commentNum+'</td>';
			    	trcode=trcode+'<td>'+obj[i].createDate+'</td>';
			    	trcode=trcode+'<td>'+'<img src="images/edit.png" onclick="editHandle(\''+obj[i].articleId+'\');" value="'+obj[i].articleId+'" alt="Edit" /> &nbsp &nbsp <img id="deleteArticle" onclick="delHandle(\''+obj[i].articleId+'\');" value="'+obj[i].articleId+'" src="images/delete.png" alt="Delete" >'+'</td>';
			    	// trcode=trcode+'<td>'+'<a class="link-update" href="#">Edit</a>'+'<a class="link-del" href="#">Delete</a>'+'</td>';

			    	trcode=trcode+'</tr>';
			    	//alert(trcode);
			    	jQuery('#tbody').append(trcode);
			    }
			    if(i==0){
			    	// alert("fujx;kaksd");
			    	var trcode='<p f style="font-size: 18px">We hava no article about this theme!!';
			    	jQuery('.list-page').append(trcode);
		    	}else{
		    		var trcode="2 条 1/1 页";
		    		jQuery('.list-page').append(trcode);
		    	}
		    }

	    }
		});
}



























