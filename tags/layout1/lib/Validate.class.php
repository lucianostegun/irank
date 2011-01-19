<?php

class Validate {
    
	public static function validateDateTime( $dateTime ){

		$dateTime = explode(' ', $dateTime);
		$validateDate = true;
		$validateTime = true;
		
		if( count( $dateTime ) >= 1 ){
		
			$validateDate = self::validateDate( $dateTime[0] );
			if( count( $dateTime ) == 2 )
				$validateTime = self::validateTime( $dateTime[1] );
			else
				$validateTime = false;

			return $validateDate && $validateTime;
		}else{
			return false;
		}
	}
    
	public static function validateDate( $date ){

		$date  = explode( '/', $date );
		if( !is_array( $date ) || count( $date ) < 3 )			
			return false;

		$day   = $date[0];
		$month = $date[1];
		$year  = $date[2];
		
		if( !is_numeric( $day ) || !is_numeric( $month ) || !is_numeric( $year ) )			
			return false;
		
		return checkdate($month, $day, $year);
	}
    
	public static function validateTime( $time ){

		
		$timeArray = explode( ':', $time );
		
		if( is_array( $timeArray ) && count( $timeArray ) ==2 ){
			
			$time .= ':00';
		}elseif( !is_array( $timeArray ) || count( $timeArray ) < 3 ){
			
			return false;
		}
		list( $hour, $minute, $second ) = explode( ':', $time );
		
		if( !is_numeric( $hour ) || !is_numeric( $minute ) || !is_numeric( $second ) ){
			
			return false;
		}
		
		if( $hour < 0 || $minute < 0 || $second < 0 || $hour > 23 || $minute > 59 || $second > 59 ){
			
			return false;
		}
		
		return true;
	}
    
	public static function validateMonthYear( $date ){

		$date  = explode( '/', $date );
		if( !is_array( $date ) || count( $date ) < 2 ){
			
			return false;
		}
		$day   = 1;
		$month = $date[0];
		$year  = $date[1];
		
		if( !is_numeric( $month ) || !is_numeric( $year ) ){
			
			return false;
		}
		
		return checkdate($month, $day, $year);
	}
	
	public static function validateCNPJCPF( $docNumber ){
		
    	if( strlen( $docNumber )==14 ){
    		
    		return self::validateCPF( $docNumber );
    	}else{
    		
    		$docNumber = str_replace( '.', '', $docNumber );
    		$docNumber = str_replace( '-', '', $docNumber );
    		$docNumber = str_replace( '/', '', $docNumber );
    		$docNumber = substr( $docNumber, 1, 19 );
    		return self::validateCNPJ( $docNumber );
    	}
	}
    
	public static function validateCPF($cpf) {
		
		/* Retira todos os caracteres que nao sejam 0-9 */
		$cpf = ereg_replace('[^0-9]', '', $cpf);
		$sum = 0;
		
		if (strlen($cpf) <> 11)
		   return false;
		   
		if ( $cpf == '00000000000')
		   return false;
		  
		$nullList = array('12345678909','11111111111','22222222222','33333333333',
						   '44444444444','55555555555','66666666666','77777777777',
						   '88888888888','99999999999','00000000000');

		/*Retorna falso se houver letras no cpf */
		if (!(ereg('[0-9]',$cpf)))
		    return false;
		
		/* Retorna falso se o cpf for nulo */
		if( in_array($cpf, $nullList) )
		    return false;
		
		/*Calcula o penúltimo dígito verificador*/
		$acum=0;
		for($i=0; $i<9; $i++)
			$acum+= $cpf[$i]*(10-$i);
		
		$x=$acum % 11;
		$acum = ($x>1) ? (11 - $x) : 0;
		
		/* Retorna falso se o digito calculado eh diferente do passado na string */
		if ($acum != $cpf[9])
			return false;
		  
		/*Calcula o último dígito verificador*/
		$acum=0;
		for ($i=0; $i<10; $i++)
			$acum+= $cpf[$i]*(11-$i);
		
		$x=$acum % 11;
		$acum = ($x > 1) ? (11-$x) : 0;
		/* Retorna falso se o digito calculado eh diferente do passado na string */
		if ( $acum != $cpf[10])
			return false;
		  
		/* Retorna verdadeiro se o cpf eh valido */
		return true;
   }
   
	public static function validateCNPJ($cnpj) {

		if( strlen( $cnpj )==18 || strlen( $cnpj )==14 )
			$cnpj = '0'.$cnpj;

		if( strlen( $cnpj )==19 )
			$cnpj = substr( $cnpj, 1, 19 );
		
		
		
		$s='';
		for ($x=1; $x<=strlen($cnpj); $x=$x+1){
			
			$ch=substr($cnpj,$x-1,1);
			if (ord($ch)>=48 && ord($ch)<=57){
			 
				$s=$s.$ch;
			}
		}
		
		$cnpj=$s;
		if (strlen($cnpj)!=14){
	     
			return false;
		}elseif ($cnpj=='00000000000000' || $cnpj=='000000000000000'){
	 		
			return false;
		}else{
    
			$number[1]=intval(substr($cnpj,1-1,1));
			$number[2]=intval(substr($cnpj,2-1,1));
			$number[3]=intval(substr($cnpj,3-1,1));
			$number[4]=intval(substr($cnpj,4-1,1));
			$number[5]=intval(substr($cnpj,5-1,1));
			$number[6]=intval(substr($cnpj,6-1,1));
			$number[7]=intval(substr($cnpj,7-1,1));
			$number[8]=intval(substr($cnpj,8-1,1));
			$number[9]=intval(substr($cnpj,9-1,1));
			$number[10]=intval(substr($cnpj,10-1,1));
			$number[11]=intval(substr($cnpj,11-1,1));
			$number[12]=intval(substr($cnpj,12-1,1));
			$number[13]=intval(substr($cnpj,13-1,1));
			$number[14]=intval(substr($cnpj,14-1,1));
	
			$sum=$number[1]*5+$number[2]*4+$number[3]*3+$number[4]*2+$number[5]*9+$number[6]*8+$number[7]*7+
			$number[8]*6+$number[9]*5+$number[10]*4+$number[11]*3+$number[12]*2;
			
			$sum=$sum-(11*(intval($sum/11)));
	
			if ($sum==0 || $sum==1){
	  
	  			$result1=0;
	  		}else{
	 
				$result1=11-$sum;
			}
			
			if ($result1==$number[13]){
	 
				$sum=$number[1]*6+$number[2]*5+$number[3]*4+$number[4]*3+$number[5]*2+$number[6]*9+$number[7]*8+$number[8]*7+$number[9]*6+$number[10]*5+$number[11]*4+$number[12]*3+$number[13]*2;
				$sum=$sum-(11*(intval($sum/11)));
	 
	 			if ($sum==0 || $sum==1){
	  
	  				$result2=0;
				}else{
	
					$result2=11-$sum;
				}
	
				if ($result2==$number[14]){
	 
	 				return true;
				}else{
	
					return false;
				}
			}else{
	
				return false;
			}
		}
	}
   
	public static function validatePhoneNoDdd( $phoneNumber ){
   	
	   	return ereg('[0-9]{4}\-[0-9]{4}', $phoneNumber);
	}
	
	public static function isInteger($value){
		
		if( !is_numeric($value) )
			return false;
		else
			return is_integer($value*1);
	}
	
	public static function isFloat($value){
		
		$value = str_replace(',', '.', $value);
		
		if( !is_numeric($value) )
			return false;
		else
			return is_float($value*1.0);
	}
}
?>