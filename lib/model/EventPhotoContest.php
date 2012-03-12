<?php

/**
 * Subclasse de representação de objetos da tabela 'event_photo_contest'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPhotoContest extends BaseEventPhotoContest
{
	
	public static function getPhotoPair($eventPhotoIdList=array()){
		
		$lockKey = MyTools::getCookie('eventPhotoContestKey');
		
		if( $lockKey )
			$eventPhotoContestObj = EventPhotoContestPeer::retriveByLockKey($lockKey);
		
		if( $lockKey && is_object($eventPhotoContestObj) ){
			
			return $eventPhotoContestObj;
		}else{
			
			$eventPhotoIdList[] = '0';
			
			$eventPhotoIdLeft  = Util::executeOne('SELECT id FROM event_photo WHERE is_shared AND NOT deleted AND width > 365 AND id NOT IN ('.implode(',', $eventPhotoIdList).') ORDER BY RANDOM() LIMIT 1');
			$eventPhotoIdRight = Util::executeOne('SELECT id FROM event_photo WHERE is_shared AND NOT deleted AND width > 365 AND id NOT IN ('.implode(',', $eventPhotoIdList).') AND id <> '.$eventPhotoIdLeft.' ORDER BY RANDOM() LIMIT 1');
			
			$lockKey = 'iRankPhotoContest'.$eventPhotoIdLeft.'x'.$eventPhotoIdRight.'-'.microtime();
			$lockKey = md5($lockKey);
			
			$ipAddress = $_SERVER['REMOTE_ADDR'];
			
			MyTools::setCookie('eventPhotoContestKey', $lockKey, (time()+(86400*15)), '/');
			
			
			$eventPhotoContestObj = new EventPhotoContest();
			$eventPhotoContestObj->setEventPhotoIdLeft($eventPhotoIdLeft);
			$eventPhotoContestObj->setEventPhotoIdRight($eventPhotoIdRight);
			$eventPhotoContestObj->setIpAddress($ipAddress);
			$eventPhotoContestObj->setLockKey($lockKey);
			$eventPhotoContestObj->save();
			
			return $eventPhotoContestObj;
		}
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['eventPhotoIdLeft']  = $this->getEventPhotoIdLeft();
		$infoList['eventPhotoIdRight'] = $this->getEventPhotoIdRight();
		$infoList['lockKey']           = $this->getLockKey();
		
		return $infoList;
	}
}
