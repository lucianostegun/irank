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
		$eventTime        = $request->getParameter('startTime');
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
	
	public function toString(){
	
		return ($this->getEventShortName()?$this->getEventShortName():$this->getEventName());	
	}
}
