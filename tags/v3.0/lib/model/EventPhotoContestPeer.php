<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_photo_contest'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPhotoContestPeer extends BaseEventPhotoContestPeer
{
	
	public static function retriveByLockKey($lockKey){
		
		if( $lockKey && strlen($lockKey) != 32 ){
			
			$lockKeyObj = json_decode($lockKey);
			$lockKey = $lockKeyObj->eventPhotoContestKey;
		}
		
		$criteria = new Criteria();
		$criteria->add( EventPhotoContestPeer::LOCK_KEY, $lockKey );
		$criteria->add( EventPhotoContestPeer::EVENT_PHOTO_ID_WINNER, null );
		
		return EventPhotoContestPeer::doSelectOne($criteria);
	}
}
