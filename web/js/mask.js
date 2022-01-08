function maskPhone( evt ) {

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;
    
    var value = obj.value;
    value = replaceChar( value, '(', '' );
    value = replaceChar( value, ')', '' );
    value = replaceChar( value, '-', '' );
    value = replaceChar( value, ' ', '' );
    
    if( value.length==10 && isInteger(value) ){

    	obj.value = '('+value.substring( 0,2 )+') '+value.substring( 2,6 )+'-'+value.substring( 6,10 );
    	return false;
    }

	if( evt.keyCode == 8 || evt.keyCode == 9 ){
		
		obj.focus();
		return false;
	}
    
    qtd = obj.value.length;

    if( qtd == 2 )
    	obj.value = "("+obj.value+") ";
    
    if( qtd == 7 )
    	obj.value = obj.value+"-";
    
    if( qtd == 13 && evt.keyCode == 8 ){

	    character = replaceChar(obj.value, "-");
        obj.value = character.substring( 0, 8 )+"-"+character.substring( 8, 13 );
    }
    
    if( qtd == 14 ){

	    character = obj.value.replace('-', '');
    	obj.value = character.substring( 0, 9 )+"-"+character.substring( 9, 13 );
	}
	
    obj.value = obj.value.replace( '--', '-' );
}

function maskPhoneNoDDD( evt ) {

	var obj;
    
    if( navigator.appName.indexOf('Netscape') != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;
    
    var value = obj.value;
    value = replaceChar( value, '(', '' );
    value = replaceChar( value, ')', '' );
    value = replaceChar( value, '-', '' );
    value = replaceChar( value, ' ', '' );
    
	if( evt.keyCode == 8 || evt.keyCode == 9 ){
	
		obj.focus();
		return false;
	}
    
	var phoneNumber = obj.value.replace(/[^0-9]/g, '');
    var length      = phoneNumber.length;

    if( length >= 9 && evt.keyCode == 8 )
	    phoneNumber = phoneNumber.substring( 0, 8 )+'-'+phoneNumber.substring( 8, 13 );
    else if( length == 8 )
    	phoneNumber = phoneNumber.substring(0, 4)+'-'+phoneNumber.substring( 4, 8 );
    else if( length == 9 )
    	phoneNumber = phoneNumber.substring(0, 5)+'-'+phoneNumber.substring( 5, 9 );
    else if( length >= 4 )
    	phoneNumber = phoneNumber.substring(0, 4)+'-'+phoneNumber.substring( 4, length );
	
    obj.value = phoneNumber;
}

function maskFreePhone( evt ) {

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;

	if( evt.keyCode == 8 || evt.keyCode == 9 ){
	
		obj.focus();
		return false;
	}
    
    var value = obj.value;
    value = replaceChar( value, '.', '' );
    value = replaceChar( value, '-', '' );
    value = replaceChar( value, ' ', '' );
    
    if( value.length>=10 && isInteger(value) ){

    	obj.value = value.substring( 0,4 )+'-'+value.substring( 4,7 )+'-'+value.substring( 7,11 );
    	return false;
    }
    
    qtd = obj.value.length;

    if( qtd == 4 || qtd == 8 )
    	obj.value = obj.value+"-";
    
    obj.value = obj.value.replace( '--', '-' );
}

function maskZipcode( evt ) {

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;

	if( evt.keyCode == 8 || evt.keyCode == 9 ){
	
		obj.focus();
		return false;
	}
    
    var value = obj.value;
    value = replaceChar( value, '.', '' );
    value = replaceChar( value, '-', '' );
    value = replaceChar( value, ' ', '' );
    
    if( value.length==8 && isInteger(value) ){

    	obj.value = value.substring( 0,5 )+'-'+value.substring( 5,8 );
    	return false;
    }
    
    qtd = obj.value.length;

    if( qtd == 5 && obj.value.replace('-')==obj.value )
    	obj.value = obj.value+"-";
    
    obj.value = obj.value.replace( '--', '-' );
}

function maskCpf( evt ) {

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;
    
    var value = obj.value;
    value = replaceChar( value, '.', '' );
    value = replaceChar( value, '-', '' );
    
    if( value.length==11 && isInteger(value) ){

    	obj.value = value.substring( 0,3 )+'.'+value.substring( 3,6 )+'.'+value.substring( 6,9 )+'-'+value.substring( 9,11 );
    	return false;
    }

	if( evt.keyCode == 8 || evt.keyCode == 9 ){
	
		obj.focus();
		return false;
	}

    qtd = obj.value.length;

    if( qtd == 3 || qtd == 7 )
    	obj.value = obj.value+".";
    
    if( qtd == 11 )
    	obj.value = obj.value+"-";
    
    obj.value = obj.value.replace( '..', '.' );
    obj.value = obj.value.replace( '--', '-' );
}

function maskCnpj( evt ) {

	if( evt.keyCode>=36 && evt.keyCode<=39 )
		return true;

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;
	
	if( obj.length==18 )
		maskCnpj18( evt )
	else
		maskCnpj17( evt )
}

function maskCnpj17( evt ) {

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;
    
    var value = obj.value;
    value = replaceChar( value, '.', '' );
    value = replaceChar( value, '-', '' );
    value = replaceChar( value, '/', '' );
    
    if( value.length>=14 && isInteger(value) ){

    	obj.value = value.substring( 0,3 )+'.'+value.substring( 3,6 )+'.'+value.substring( 6,9 )+'/'+value.substring( 9,13 )+'-'+value.substring( 13,15 );
    	return false;
    }

	if( evt.keyCode == 8 || evt.keyCode == 9 ){
	
		obj.focus();
		return false;
	}
    
    qtd = obj.value.length;

    if( qtd == 2 || qtd == 6 )
    	obj.value = obj.value+".";
    
    if( qtd == 10 )
    	obj.value = obj.value+"/";
    
    if( qtd == 15 )
    	obj.value = obj.value+"-";
    
    obj.value = obj.value.replace( '..', '.' );
    obj.value = obj.value.replace( '//', '/' );
    obj.value = obj.value.replace( '--', '-' );
}

function maskCnpj18( evt ) {

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;
    
    var value = obj.value;
    value = replaceChar( value, '.', '' );
    value = replaceChar( value, '-', '' );
    value = replaceChar( value, '/', '' );
    
    if( value.length>=14 && isInteger(value) ){

    	obj.value = value.substring( 0,3 )+'.'+value.substring( 3,6 )+'.'+value.substring( 6,9 )+'/'+value.substring( 9,13 )+'-'+value.substring( 13,15 );
    	return false;
    }

	if( evt.keyCode == 8 || evt.keyCode == 9 ){
	
		obj.focus();
		return false;
	}
    
    qtd = obj.value.length;

    if( qtd == 3 || qtd == 7 )
    	obj.value = obj.value+".";
    
    if( qtd == 11 )
    	obj.value = obj.value+"/";
    
    if( qtd == 16 )
    	obj.value = obj.value+"-";
    
    obj.value = obj.value.replace( '..', '.' );
    obj.value = obj.value.replace( '//', '/' );
    obj.value = obj.value.replace( '--', '-' );
}

function maskDate( evt ) {

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;

	if( evt.keyCode == 8 || evt.keyCode == 9 ){

		obj.focus();
		return false;
	}
    
    var value = obj.value;
    value = replaceChar( value, '/', '' );
    
    qtd = obj.value.length;

    if( (qtd == 2 || qtd == 5) && obj.value.replace('-')==obj.value )
    	obj.value = obj.value+"/";
    
    obj.value = obj.value.replace( '\\', '/' );
    obj.value = obj.value.replace( '//', '/' );
}

function maskTimeFull( evt  ) {
	
	maskTime( evt, false );
}

function maskTime( evt, withoutSecond ) {

	if( typeof(withoutSecond)=='undefined' )
		withoutSecond = true;

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;

	if( evt.keyCode == 8 || evt.keyCode == 9 ){

		obj.focus();
		return false;
	}
    
    var value = obj.value;
    value = replaceChar( value, ':', '' );
    
    qtd = obj.value.length;

    if( (qtd == 2 || (qtd == 5 && !withoutSecond )) )
    	obj.value = obj.value+":";
    
    
    obj.value = obj.value.replace( '::', ':' );
}

function maskDateTime( evt ) {

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;

	if( evt.keyCode == 8 || evt.keyCode == 9 ){

		obj.focus();
		return false;
	}
    
    var value = obj.value;
    value = replaceChar( value, '/', '' );
    value = replaceChar( value, ':', '' );
    
    qtd = obj.value.length;

    if( (qtd == 2 || qtd == 5) && obj.value.replace('-')==obj.value )
    	obj.value = obj.value+"/";
    
    if( (qtd == 13) && obj.value.replace(':')==obj.value )
    	obj.value = obj.value+":";
    
    if( qtd == 10 )    
    	obj.value = obj.value+" ";
    
    obj.value = obj.value.replace( '\\', '/' );
    obj.value = obj.value.replace( '//', '/' );
    obj.value = obj.value.replace( '::', ':' );
    obj.value = obj.value.replace( '  ', ' ' );
}

function maskCurrency( evt ) {

	var obj;
    
    if( navigator.appName.indexOf("Netscape") != -1 )
    	obj = evt.target;
    else
    	obj = evt.srcElement;

	if( evt.keyCode == 8 || evt.keyCode == 9 ){

		obj.focus();
		return false;
	}
    
    var value = obj.value.replace(/[^0-9]/ig, '');

    if( value.length > 2)
    	obj.value = value.substring(0, value.length-2)+','+value.substring(value.length-2, value.length);
}