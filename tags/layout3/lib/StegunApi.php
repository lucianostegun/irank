<?php

class StegunApi {
	
	const API_URL         = 'http://api.stegun.com';   
	const DOMAIN_ID       = 5;   
	const DOMAIN_NAME     = 'irank.com.br';
	const REQUEST_TIMEOUT = 20;
	
	var $parameters = array();
	
	public function __construct(){
		
		$this->addParameter('domainID', self::DOMAIN_ID);
		$this->addParameter('domain', self::DOMAIN_NAME);
	}
	
	public function call($service){
		
		$url = self::API_URL."/{$service}.php";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $this->parameters);
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
		
		return $result;
	}
	
	public function updateEmailRedirect($mailbox, $emailAddressList){
		
		$this->addParameter('action', 'update');
		$this->addParameter('mailbox', $mailbox);
		$this->addParameter('emailAddressList', implode(';', $emailAddressList));
						 
		return self::call('mailbox');
	}
	
	public function deleteEmailRedirect($mailbox){
		
		$this->addParameter('action', 'delete');
		$this->addParameter('mailbox', $mailbox);
						 
		return self::call('mailbox');
	}
	
	private function addParameter($parameterName, $parameterValue){
		
		$this->parameters[$parameterName] = $parameterValue;
	}
}

class StegunApiException extends Exception {
	
//	public function __construct($errorMessage){
//		
//		$this->message = "Call execution error:\n$errorMessage";
//	}
}
?>