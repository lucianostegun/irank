<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live_player_disclosure_sms'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePlayerDisclosureSms extends BaseEventLivePlayerDisclosureSms
{
	
	public function getSmsLog(){
		
		$smsLogObj = SmsLogPeer::retrieveByPK($this->getSmsLogId());
		
		if( !is_object($smsLogObj) )
			$smsLogObj = new SmsLog();
		
		return $smsLogObj;
	}
}
