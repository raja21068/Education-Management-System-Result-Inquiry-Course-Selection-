function keyTrapping(myfield, event){

	var key;
	var keychar;
	var characterIndex=0;
	if (window.event)
   		key = window.event.keyCode;
	else if (event)
   		key = event.which;
	else
   		return true;
	
	keychar = String.fromCharCode(key);
	// control keys
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
   		return true;
	//selected character only
	else if ((("1234567890").indexOf(keychar) > -1))
   		return true;
	
   		
	else 

   		return false;	 
   		
	


	}
	
	function keyTrappingCapital(myfield, event){

	var key;
	var keychar;
	var characterIndex=0;
	if (window.event)
   		key = window.event.keyCode;
	else if (event)
   		key = event.which;
	else
   		return true;
	
	keychar = String.fromCharCode(key);
	// control keys
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
   		return true;
	//selected character only
	else if ((("ABCDEFGHIJKLMNOPQRSTUVWXYZ").indexOf(keychar) > -1))
   		return true;
	
   		
	else 

   		return false;	 
   		
	


	}
	
function keyTrappingCapitalSmall(myfield, event){

	var key;
	var keychar;
	var characterIndex=0;
	if (window.event)
   		key = window.event.keyCode;
	else if (event)
   		key = event.which;
	else
   		return true;
	
	keychar = String.fromCharCode(key);
	// control keys
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
   		return true;
	//selected character only
	else if ((("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz").indexOf(keychar) > -1))
   		return true;
	
   		
	else 

   		return false;	 
   		
	


	}
	

	
function validatePass(p1, p2) {
    if (p1.value != p2.value || p1.value == '' || p2.value == '') {
        p2.setCustomValidity('Password incorrect');
    } else {
        p2.setCustomValidity('');
    }
}



function validatePass1(p1, p2) {
    if (p1.value != p2.value) {
        p2.setCustomValidity('Password incorrect');
    } else {
        p2.setCustomValidity('');
    }
}


	
	


