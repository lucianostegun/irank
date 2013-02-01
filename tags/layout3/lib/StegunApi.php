<?php

class StegunApi {
	
	const API_URL         = 'http://api.stegun.com';   
	const DOMAIN_ID       = 5;   
	const DOMAIN_NAME     = 'irank.com.br';
	const REQUEST_TIMEOUT = 20;
	
	public static function updateEmailRedirect($mailbox, $emailAddressList){
		
		$params = array ('domainID'         => self::DOMAIN_ID,
						 'domain'           => self::DOMAIN_NAME,
						 'mailbox'          => $mailbox,
						 'emailAddressList' => implode(';', $emailAddressList));
						 
		$url = self::API_URL.'/mailbox.php';
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_TIMEOUT, self::REQUEST_TIMEOUT);
		$result = curl_exec($curl);
		curl_close($curl);
		
		if( $result=='success' ){
			
			return true;
		}else{
			
			$resultObj = json_decode($result);
			
			if( is_object($resultObj) && property_exists($resultObj, 'errorMessage') )
				throw new StegunApiException($resultObj->errorMessage);
			else
				throw new Exception($result);
		}
	}
}

class StegunApiException extends Exception {
	
//	public function __construct($errorMessage){
//		
//		$this->message = "Call execution error:\n$errorMessage";
//	}
}
?>