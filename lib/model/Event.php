<?php

/**
 * Subclasse de representação de objetos da tabela 'event'.
 *
 * 
 *
 * @package lib.model
 */ 
class Event extends BaseEvent
{
	
	public static function getList(){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( UserSitePeer::ID, $userSiteId );
		$criteria->addJoin( EventPeer::RANKING_ID, RankingPeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( RankingPeer::ID, RankingMemberPeer::RANKING_ID, Criteria::INNER_JOIN );
		$criteria->addJoin( RankingMemberPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( PeoplePeer::ID, UserSitePeer::PEOPLE_ID, Criteria::INNER_JOIN );
		$criteria->addDescendingOrderByColumn( EventPeer::EVENT_DATE );
		$criteria->addDescendingOrderByColumn( EventPeer::START_TIME );
		
		return EventPeer::doSelect( $criteria );
	}
	
	public function getPeopleList($returnPeople=false, $orderByList=null){
		
		$criteria = new Criteria();
		$criteria->add( EventMemberPeer::EVENT_ID, $this->getId() );
		$criteria->addJoin( EventMemberPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		
		if( is_array($orderByList) ){

			foreach( $orderByList as $orderBy=>$order ){
				
				if( $order=='desc' )
					$criteria->addDescendingOrderByColumn( $orderBy );
				else
					$criteria->addAscendingOrderByColumn( $orderBy );
			}
		}
			
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		
		if( $returnPeople )
			return PeoplePeer::doSelect($criteria);
		else
			return EventMemberPeer::doSelect($criteria);
	}
	
	public function getMemberList($orderByList=null){
		
		return $this->getPeopleList(false, $orderByList);
	}
	
	public function addMember($peopleId, $confirm=false){
		
		$eventMemberObj = EventMemberPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( !is_object($eventMemberObj) ){
			
			$eventMemberObj = new EventMember();
			$eventMemberObj->setEventId( $this->getId() );
			$eventMemberObj->setPeopleId( $peopleId );
		}
		
		if( $confirm && !$eventMemberObj->getEnabled() ){
		
			$eventMemberObj->setEnabled(true);
			$this->setMembers( $this->getMembers()+1 );
			$this->save();
			
			$rankingMemberObj = RankingMemberPeer::retrieveByPK($this->getRankingId(), $peopleId);
			$rankingMemberObj->setEvents($rankingMemberObj->getEvents()+1);
			$rankingMemberObj->save();
		}
		
		$eventMemberObj->save();
	}
	
	public function deleteMember($peopleId){

		$eventMemberObj = EventMemberPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( is_object($eventMemberObj) && $eventMemberObj->getEnabled() ){
			
			
			$eventMemberObj->setEventPosition(0);
			$eventMemberObj->setPrizeValue(0);
			$eventMemberObj->setRebuys(0);
			$eventMemberObj->setAddons(0);
			$eventMemberObj->setBuyIn(0);
			$eventMemberObj->setEnabled(false);
			$eventMemberObj->save();
			
			$this->setMembers( $this->getMembers()-1 );
			$this->save();
			
			$rankingMemberObj = RankingMemberPeer::retrieveByPK($this->getRankingId(), $peopleId);
			$rankingMemberObj->setEvents($rankingMemberObj->getEvents()-1);
			$rankingMemberObj->save();
		}
	}
	
	public function isConfirmed($peopleId){
		
		$eventMemberObj = EventMemberPeer::retrieveByPK($this->getId(), $peopleId);
		
		return is_object($eventMemberObj) && $eventMemberObj->getEnabled();
	}
	
	public function importMembers(){

		$rankingMemberObjList = $this->getRanking()->getMemberList();
		
		foreach( $rankingMemberObjList as $rankingMemberObj )
			$this->addMember( $rankingMemberObj->getPeopleId() );
			
		
		$this->setInvites( count($rankingMemberObjList) );
		$this->save();
	}
	
	public function isPastDate(){
		
		$eventDateTime   = $this->getEventDate('Y-m-d').' '.$this->getStartTime('H:i:s');
		$currentDateTime = time();
		
		return $currentDateTime > strtotime($eventDateTime);
	}
	
	
	
	public function isMyEvent(){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		$rankingObj = $this->getRanking();
		
		if( !is_object($rankingObj) )
			return true;
		return ($rankingObj->getUserSiteId()==$userSiteId);
	}
}
