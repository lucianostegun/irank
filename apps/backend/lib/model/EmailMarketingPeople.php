<?php

/**
 * Subclasse de representação de objetos da tabela 'email_marketing_people'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class EmailMarketingPeople extends BaseEmailMarketingPeople
{
	
	public function getEmailLog(){
		
		$emailLogObj = EmailLogPeer::retrieveByPK($this->getEmailLogId());
		
		if( !is_object($emailLogObj) )
			$emailLogObj = new EmailLog();
		
		return $emailLogObj;
	}
}
