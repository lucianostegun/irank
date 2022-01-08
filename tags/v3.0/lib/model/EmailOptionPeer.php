<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'email_option'.
 *
 * 
 *
 * @package lib.model
 */ 
class EmailOptionPeer extends BaseEmailOptionPeer
{
	
	public static function retrieveByPK($emailAddress, $emailTemplateId, $con=null){
		
		$emailOptionObj = parent::retrieveByPK($emailAddress, $emailTemplateId, $con);
		
		if( !is_object($emailOptionObj) ){
			
			$emailOptionObj = new EmailOption();
			$emailOptionObj->setEmailAddress($emailAddress);
			$emailOptionObj->setEmailTemplateId($emailTemplateId);
		}
		
		return $emailOptionObj;
	}
}
