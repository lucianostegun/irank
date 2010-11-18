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
	
	public function cleanRecord(){
		
		$this->setInvites(0);
		$this->setMembers(0);
		$this->save();
		
		Util::executeQuery('DELETE FROM event_member WHERE event_id = '.$this->getId());
	}
	
	public function delete($con=null){
		
		$rankingObj = $this->getRanking();
		$rankingObj->setEvents($rankingObj->getEvents()-1);
		$rankingObj->save();
		
		$rankingObj->updateScores();
		
		$deleted = $this->getDeleted();
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
		
		/**
		 * Envia a notificação nas seguintes condições:
		 * 
		 * - Se não for um evento clonado
		 * - Se o e-mail de notificação de criação já tiver sido enviado
		 */
		if( !$deleted && $this->getSentEmail() )
			$this->notifyDelete();
	}
	
	public function getCode(){
		
		return '#'.sprintf('%04d', $this->getId());
	}
	
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
		
//			$eventMemberObj->setEnabled(true);
//			$this->setMembers( $this->getMembers()+1 );
//			$this->save();
			
//			$rankingMemberObj = RankingMemberPeer::retrieveByPK($this->getRankingId(), $peopleId);
//			$rankingMemberObj->setEvents($rankingMemberObj->getEvents()+1);
//			$rankingMemberObj->save();
			
			$eventMemberObj->notifyConfirm();
		}
		
//		$eventMemberObj->save();
	}
	
	public function deleteMember($peopleId){

		$eventMemberObj = EventMemberPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( is_object($eventMemberObj) && $eventMemberObj->getEnabled() ){
			
			
			$eventMemberObj->setEventPosition(0);
			$eventMemberObj->setPrize(0);
			$eventMemberObj->setRebuy(0);
			$eventMemberObj->setAddon(0);
			$eventMemberObj->setBuyin(0);
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
	
	public function getGameStyle($returnTagName=false){
		
		return $this->getRanking()->getGameStyle($returnTagName);
	}
	
	public function getEmailAddressList($tagName=null){
		
		$emailAddressList = array();
		
		if( $tagName )
			$userSiteOptionId = VirtualTable::getIdByTagName('userSiteOption', $tagName);
		
		foreach( $this->getPeopleList(true) as $peopleObj ){
			
			if( $tagName )
				if( !$peopleObj->getOptionValue($userSiteOptionId, true) )
					continue;
					
			$emailAddressList[] = $peopleObj->getEmailAddress();
		}
		
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
		$emailContent = str_replace('<buyin>', Util::formatFloat($this->getBuyin(), true), $emailContent);
		$emailContent = str_replace('<comments>', $this->getComments(), $emailContent);
		$emailContent = str_replace('<invites>', $this->getInvites(), $emailContent);
		$emailContent = str_replace('<members>', $this->getMembers(), $emailContent);

		$emailAddressList = $this->getEmailAddressList();
		
		Report::sendMail($emailSubject, $emailAddressList, $emailContent);
		
		$this->setSentEmail(true);
		$this->save();
	}
	
	public function notifyResult(){

		$emailContent = AuxiliarText::getContentByTagName('eventResult');

		$emailContent = $this->getEmailContent($emailContent);
		$resultList   = $this->getEmailResultList();
	  	$classifyList = $this->getEmailClassifyList();
		
		$emailContent = str_replace('<resultList>', $resultList, $emailContent);
		$emailContent = str_replace('<classifyList>', $classifyList, $emailContent);
		
		$isDebug = Util::isDebug();

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
			
			if( $isDebug && $eventPosition==1 || !$isDebug  )
				Report::sendMail('Resultado de evento @ '.$this->getEventName(), $peopleObj->getEmailAddress(), $emailContentTmp);
		}
	}
	
	public function notifyDelete(){

		$emailContent = AuxiliarText::getContentByTagName('eventDeleteNotify');

		$emailContent = $this->getEmailContent($emailContent);
	  	$classifyList = $this->getEmailClassifyList();
		
		$emailContent = str_replace('<classifyList>', $classifyList, $emailContent);
		
		$emailAddressList = $this->getEmailAddressList();
		
		Report::sendMail('Exclusão do evento @ '.$this->getEventName(), $emailAddressList, $emailContent);
	}
	
	public function notifyReminder($days=7){

		$emailContent = AuxiliarText::getContentByTagName('eventReminder');
		$emailContent = $this->getEmailContent($emailContent);
		
		$eventSchedule = ($days==0?'hoje':'em '.$days.' dias');
		$emailContent = str_replace('<eventSchedule>', $eventSchedule, $emailContent);
		
		$emailAddressList = $this->getEmailAddressList('receiveEventReminder'.$days);
		
		Report::sendMail('Lembrete de evento @ '.$this->getEventName(), $emailAddressList, $emailContent);
	}
	
	public function getEmailContent($emailContent){
		
		$rankingObj = $this->getRanking();
		
		$emailContent = str_replace('<eventName>', $this->getEventName(), $emailContent);
		$emailContent = str_replace('<rankingName>', $this->getRanking()->getRankingName(), $emailContent);
		$emailContent = str_replace('<gameStyle>', $this->getGameStyle()->getDescription(), $emailContent);
		$emailContent = str_replace('<eventPlace>', $this->getEventPlace(), $emailContent);
		$emailContent = str_replace('<eventDate>', $this->getEventDate('d/m/Y'), $emailContent);
		$emailContent = str_replace('<startTime>', $this->getStartTime('H:i'), $emailContent);
		$emailContent = str_replace('<paidPlaces>', $this->getPaidPlaces(), $emailContent);
		$emailContent = str_replace('<buyin>', Util::formatFloat($this->getBuyin(), true), $emailContent);
		$emailContent = str_replace('<comments>', $this->getComments(), $emailContent);
		$emailContent = str_replace('<invites>', $this->getInvites(), $emailContent);
		$emailContent = str_replace('<members>', $this->getMembers(), $emailContent);
		$emailContent = str_replace('<rankingType>', strtolower($rankingObj->getRankingType()->getDescription()), $emailContent);
		
		return $emailContent;
	}
	
	public function getEmailResultList(){
		
		$resultList = '';
		$nl         = chr(10);
		
		$eventMemberObjList = $this->getClassify();
	  	foreach($eventMemberObjList as $key=>$eventMemberObj){
		
			$eventPosition = $eventMemberObj->getEventPosition();
			
			if( $eventPosition==0 )
				continue;
			
			$peopleObj = $eventMemberObj->getPeople();
			
			$resultList .= '  <tr class="boxcontent">'.$nl;
			$resultList .= '    <td style="background: #1B4315">#'.$eventPosition.'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315">'.$peopleObj->getFullName().'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventMemberObj->getBuyin(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventMemberObj->getPrize(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventMemberObj->getRebuy(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventMemberObj->getAddon(), true).'</td>'.$nl;
			$resultList .= '  </tr>'.$nl;
	  	}
	  	
	  	return $resultList;
	}
	
	public function getEmailClassifyList(){
		
		$rankingObj   = $this->getRanking();
		$classifyList = '';
		$nl           = chr(10);
		$position     = 0;
		
		$rankingMemberObjList = $rankingObj->getClassify();
	  	foreach($rankingMemberObjList as $key=>$rankingMemberObj){
		
			$peopleObj = $rankingMemberObj->getPeople();
			
			$classifyList .= '  <tr class="boxcontent">'.$nl;
			$classifyList .= '    <td style="background: #1B4315">#'.(($position++)+1).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315">'.$peopleObj->getFullName().'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.$rankingMemberObj->getEvents().'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.$rankingMemberObj->getScore().'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingMemberObj->getTotalPaid(), true).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingMemberObj->getTotalPrize(), true).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingMemberObj->getBalance(), true).'</td>'.$nl;
			$classifyList .= '  </tr>'.$nl;
	  	}
	  	
	  	return $classifyList;
	}
	
	public function getPosition($peopleId){
		
		$eventMemberObj = EventMemberPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( is_object($eventMemberObj) )
			return $eventMemberObj->getEventPosition();
		else
			return 0;
	}
	
	public function getClone(){
		
		$eventObj = new Event();
		$eventObj->setRankingId($this->getRankingId());
		$eventObj->setEventName($this->getEventName());
		$eventObj->setEventPlace($this->getEventPlace());
		$eventObj->setEventDate($this->getEventDate());
		$eventObj->setStartTime($this->getStartTime());
		$eventObj->setPaidPlaces($this->getPaidPlaces());
		$eventObj->setBuyin($this->getBuyin());
		$eventObj->setComments($this->getComments());
		$eventObj->setVisible(false);
		$eventObj->setEnabled(false);
		$eventObj->setLocked(true);
		$eventObj->save();
		
		foreach( $this->getMemberList() as $eventMemberObj ){
			
			$eventMemberNewObj = new EventMember();
			$eventMemberNewObj->setEventId( $eventObj->getId() );
			$eventMemberNewObj->setPeopleId( $eventMemberObj->getPeopleId() );
			$eventMemberNewObj->save();
		}

		return $eventObj;
	}
}
