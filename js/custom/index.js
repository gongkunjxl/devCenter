jQuery(document).ready(function(){
								
	/// TRANSFORM CHECKBOX /////							
	//jQuery('input:checkbox').uniform();
	
	// LOGIN FORM SUBMIT /////
	jQuery('#login').submit(function(){	
		if(jQuery('#username').val() == '' || jQuery('#password').val() == '') {
			jQuery('.nousername').fadeIn();
			//jQuery('.nopassword').hide();
			return false;	
		}
		// if(jQuery('#username').val() != '' && jQuery('#password').val() == '') {
		// 	jQuery('.nopassword').fadeIn().find('.userlogged h4, .userlogged a span').text(jQuery('#username').val());
		// 	jQuery('.nousername,.username').hide();
		// 	return false;;
		// }
		var flag=false;
		jQuery.ajax({
	    	url: "./php/login.php",  
	        type: "POST",
	        data:{
	        	"username":jQuery('#username').val(),
	         	"password":jQuery('#password').val()
	         },
	        dataType: "json",
	        async: false,
	        error: function(){  
	        	alert('Error login'); 
	         },  
	        success: function(data){  
	        	//alert("fucsjkasjdaksdjasd");
	       		//var obj = eval(data);
	            //alert(data['status']);
	            if(data['status']=='200'){
	            	$.cookie('username',data['username']);	// 传值
	            	flag=true;
	            }
	        }
	    });
	    if(!flag){
	    	jQuery('.nousername').fadeIn();
	    }
	    return flag;
	});
	
	///// ADD PLACEHOLDER /////
	jQuery('#username').attr('placeholder','Username');
	jQuery('#password').attr('placeholder','Password');
});














