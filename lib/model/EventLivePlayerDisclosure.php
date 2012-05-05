<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live_player_disclosure'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePlayerDisclosure extends BaseEventLivePlayerDisclosure
{
	
	public function getEmailLog(){
		
		$emailLogObj = EmailLogPeer::retrieveByPK($this->getEmailLogId());
		
		if( !is_object($emailLogObj) )
			$emailLogObj = new EmailLog();
		
		return $emailLogObj;
	}
}
