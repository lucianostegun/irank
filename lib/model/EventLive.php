<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLive extends BaseEventLive
{
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
	}
	
	public function quickSave($request){
		
		$clubId           = $request->getParameter('clubId');
		$rankingLiveId    = $request->getParameter('rankingLiveId');
		$eventName        = $request->getParameter('eventName');
		$eventShortName   = $request->getParameter('eventShortName');
		$eventDate        = $request->getParameter('eventDate');
		$startTime        = $request->getParameter('startTime');
		$buyin            = $request->getParameter('buyin');
		$blindTime        = $request->getParameter('blindTime');
		$stackChips       = $request->getParameter('stackChips');
		$allowedRebuys    = $request->getParameter('allowedRebuys');
		$allowedAddons    = $request->getParameter('allowedAddons');
		$isIlimitedRebuys = $request->getParameter('isIlimitedRebuys');
		$description      = $request->getParameter('description');
		
		$eventDateTime = $eventDate.' '.$startTime;
		
		$this->setClubid($clubId);
		$this->setRankingLiveId(($rankingLiveId?$rankingLiveId:null));
		$this->setEventName($eventName);
		$this->setEventShortName(($eventShortName?$eventShortName:null));
		$this->setEventDate(Util::formatDate($eventDate));
		$this->setStartTime($startTime);
		$this->setEventDateTime(Util::formatDateTime($eventDateTime));
		$this->setBuyin(Util::formatFloat($buyin));
		$this->setBlindTime($blindTime);
		$this->setStackChips($stackChips);
		$this->setAllowedRebuys($allowedRebuys);
		$this->setAllowedAddons($allowedAddons);
		$this->setIsIlimitedRebuys(($isIlimitedRebuys?true:false));
		$this->setDescription($description);
		$this->setEnabled(true);
		$this->setVisible(true);
		$this->setDeleted(false);
		$this->save();
	}
	
	public static function getList($clubId=null){
		
		$criteria = new Criteria();
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		
		if( $clubId )
			$criteria->add( EventLivePeer::CLUB_ID, $clubId );

		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventLivePeer::START_TIME );
		
		return EventLivePeer::doSelect($criteria);
	}
	
	public function getRankingLive($con=null){
		
		$rankingLiveObj = parent::getRankingLive($con);
		
		if( !is_object($rankingLiveObj) )
			$rankingLiveObj = new RankingLive();
			
		return $rankingLiveObj;
	}
	
	public function isMyEvent($userAdminId=null){
		
		if( !$userAdminId )
			$userAdminId = MyTools::getAttribute('userAdminId');
		
		$iRankAdmin = MyTools::hasCredential('iRankAdmin');

		if( $iRankAdmin )
			return true;
		
		$criteria = new Criteria();
		$criteria->add( EventLivePeer::ID, $this->getId() );
		$criteria->add( UserAdminPeer::ID, $userAdminId );
		$criteria->addJoin( EventLivePeer::CLUB_ID, UserAdminPeer::CLUB_ID, Criteria::INNER_JOIN );
		
		return (EventLivePeer::doCount($criteria) > 0);
	}
	
	public function getEventPlace(){
		
		return $this->getClub()->getLocation();
	}
	
	public function isPastDate(){
		
		$eventDateTime   = $this->getEventDate('Y-m-d').' '.$this->getStartTime('H:i:s');
		$currentDateTime = time();
		
		return $currentDateTime > strtotime($eventDateTime);
	}
	
	public function getPlayerStatus($peopleId, $boolean=false){
		
		$enabled = Util::executeOne('SELECT enabled FROM event_live_player WHERE event_live_id = '.$this->getId().' AND people_id = '.$peopleId, 'boolean');
		
		if( $boolean )
			return $enabled;
		else
			return ($enabled?'yes':'no');
	}
	
	public function getPlayers($updated=false){
		
		if( $updated )
			return Util::executeOne('SELECT get_event_live_players('.$this->getId().')');
		else
			return parent::getPlayers();
	}
	
	public function getPlayerList(){
		
		$criteria = new Criteria();
		$criteria->add( EventLivePlayerPeer::EVENT_LIVE_ID, $this->getId() );
		$criteria->add( EventLivePlayerPeer::ENABLED, true );
		$criteria->addJoin( PeoplePeer::ID, EventLivePlayerPeer::PEOPLE_ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		
		return PeoplePeer::doSelect($criteria);
	}
	
	public function getGameStyle($returnTagName=false){
		
		return $this->getRankingLive()->getGameStyle($returnTagName);
	}
	
	public function getGameType($returnTagName=false){
		
		return $this->getRankingLive()->getGameType($returnTagName);
	}
	
	public function toString(){
	
		return ($this->getEventShortName()?$this->getEventShortName():$this->getEventName());	
	}
}
