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
	
	public function getGameStyle(){
		
		return $this->getVirtualTable();
	}
	
	public function getEmailAddresList(){
		
		$emailAddressList = array();
		
		foreach( $this->getPeopleList(true) as $peopleObj )
			$emailAddressList[] = $peopleObj->getEmailAddress();
		
		return $emailAddressList;
	}
	
	public function getClassify(){
		
		$orderByList = array(EventMemberPeer::ENABLED=>'desc',
	  						 EventMemberPeer::EVENT_POSITION=>'asc');
	  	
	  	$eventMemberObjList = $this->getMemberList($orderByList);

	  	$lastList = array();
	  	foreach($eventMemberObjList as $key=>$eventMemberObj){
	  		
	  		if( $eventMemberObj->getEventPosition()==0 ){
	  			
	  			$lastList[] = $eventMemberObj;
	  			unset($eventMemberObjList[$key]);
	  		}
	  	}
	  	
	  	return array_merge($eventMemberObjList, $lastList);
	}
	
	public function notify(){

		if( $this->getSentEmail() ){
			
			$emailContent = AuxiliarText::getContentByTagName('eventChangeNotify');
			$emailSubject = 'Notificação de alteração de evento';
		}else{
			
			$emailContent = AuxiliarText::getContentByTagName('eventCreateNotify');
			$emailSubject = 'Notificação de evento';
		}

		$emailContent = str_replace('<eventName>', $this->getEventName(), $emailContent);
		$emailContent = str_replace('<rankingName>', $this->getRanking()->getRankingName(), $emailContent);
		$emailContent = str_replace('<gameStyle>', $this->getGameStyle()->getDescription(), $emailContent);
		$emailContent = str_replace('<eventPlace>', $this->getEventPlace(), $emailContent);
		$emailContent = str_replace('<eventDate>', $this->getEventDate('d/m/Y'), $emailContent);
		$emailContent = str_replace('<startTime>', $this->getStartTime('H:i'), $emailContent);
		$emailContent = str_replace('<paidPlaces>', $this->getPaidPlaces(), $emailContent);
		$emailContent = str_replace('<buyIn>', Util::formatFloat($this->getBuyIn(), true), $emailContent);
		$emailContent = str_replace('<comments>', $this->getComments(), $emailContent);
		$emailContent = str_replace('<invites>', $this->getInvites(), $emailContent);
		$emailContent = str_replace('<members>', $this->getMembers(), $emailContent);

		$emailAddressList = $this->getEmailAddresList();
		
		Report::sendMail($emailSubject, $emailAddressList, $emailContent);
		
		$this->setSentEmail(true);
		$this->save();
	}
	
	public function notifyResult(){

		$emailContent = AuxiliarText::getContentByTagName('eventResult');

		$emailContent = str_replace('<eventName>', $this->getEventName(), $emailContent);
		$emailContent = str_replace('<rankingName>', $this->getRanking()->getRankingName(), $emailContent);
		$emailContent = str_replace('<gameStyle>', $this->getGameStyle()->getDescription(), $emailContent);
		$emailContent = str_replace('<eventPlace>', $this->getEventPlace(), $emailContent);
		$emailContent = str_replace('<eventDate>', $this->getEventDate('d/m/Y'), $emailContent);
		$emailContent = str_replace('<startTime>', $this->getStartTime('H:i'), $emailContent);
		$emailContent = str_replace('<paidPlaces>', $this->getPaidPlaces(), $emailContent);
		$emailContent = str_replace('<buyIn>', Util::formatFloat($this->getBuyIn(), true), $emailContent);
		$emailContent = str_replace('<comments>', $this->getComments(), $emailContent);
		$emailContent = str_replace('<invites>', $this->getInvites(), $emailContent);
		$emailContent = str_replace('<members>', $this->getMembers(), $emailContent);

		$resultList = '';
		$nl         = chr(10);
		
		$eventMemberObjList = $this->getClassify();
	  	foreach($eventMemberObjList as $key=>$eventMemberObj){
		
			if( $eventMemberObj->getEventPosition()==0 )
				continue;
			
			$peopleObj = $eventMemberObj->getPeople();
			
			$resultList .= '  <tr class="boxcontent">'.$nl;
			$resultList .= '    <td style="background: #1B4315">#'.$eventMemberObj->getEventPosition().'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315">'.$peopleObj->getFullName().'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventMemberObj->getBuyIn(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventMemberObj->getPrizeValue(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315">'.$eventMemberObj->getRebuys().'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315">'.$eventMemberObj->getAddons().'</td>'.$nl;
			$resultList .= '  </tr>'.$nl;
	  	}
		
		$emailContent = str_replace('<resultList>', $resultList, $emailContent);

		$eventMemberObjList = $this->getMemberList();
		foreach($eventMemberObjList as $eventMemberObj){
			
			$eventPosition   = $eventMemberObj->getEventPosition();
			
			if( $eventPosition==0 )
				continue;
			
			$peopleObj = $eventMemberObj->getPeople();
			
			$emailContentTmp = str_replace('<peopleName>', $peopleObj->getFirstName(), $emailContent);
			
			$congratsMessage = '';
			
			if( $eventPosition <= $this->getPaidPlaces() && $eventPosition > 0 )
				$congratsMessage = 'Parabéns, você ficou em '.$eventPosition.'º lugar no evento<br/><br/>';
				
			$emailContentTmp = str_replace('<congratsMessage>', $congratsMessage, $emailContentTmp);
			if( $eventPosition==1 )
			Report::sendMail('Resultado de evento @ '.$this->getEventName(), $peopleObj->getEmailAddress(), $emailContentTmp);
		}
	}
}
