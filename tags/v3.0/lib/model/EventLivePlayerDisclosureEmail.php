<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live_player_disclosure_email'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePlayerDisclosureEmail extends BaseEventLivePlayerDisclosureEmail
{
	
	public function getEmailLog(){
		
		$emailLogObj = EmailLogPeer::retrieveByPK($this->getEmailLogId());
		
		if( !is_object($emailLogObj) )
			$emailLogObj = new EmailLog();
		
		return $emailLogObj;
	}
}
