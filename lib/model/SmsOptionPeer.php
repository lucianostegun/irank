<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'sms_option'.
 *
 * 
 *
 * @package lib.model
 */ 
class SmsOptionPeer extends BaseSmsOptionPeer
{
	
	public static function retrieveByPK($peopleId, $smsTemplateId, $con=null){
		
		$smsOptionObj = parent::retrieveByPK($peopleId, $smsTemplateId, $con);
		
		if( !is_object($smsOptionObj) ){
			
			$smsOptionObj = new SmsOption();
			$smsOptionObj->setPeopleId($peopleId);
			$smsOptionObj->setSmsTemplateId($smsTemplateId);
		}
		
		return $smsOptionObj;
	}
}
