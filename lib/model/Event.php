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
		$this->setPlayers(0);
		$this->save();
		
		Util::executeQuery('DELETE FROM event_player WHERE event_id = '.$this->getId());
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
	
	public static function getList($criteria=null){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		if( !is_object($criteria) )
			$criteria = new Criteria();

		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( UserSitePeer::ID, $userSiteId );
		$criteria->addJoin( EventPeer::RANKING_ID, RankingPeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( RankingPeer::ID, RankingPlayerPeer::RANKING_ID, Criteria::INNER_JOIN );
		$criteria->addJoin( RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( PeoplePeer::ID, UserSitePeer::PEOPLE_ID, Criteria::INNER_JOIN );
		$criteria->addDescendingOrderByColumn( EventPeer::EVENT_DATE );
		$criteria->addDescendingOrderByColumn( EventPeer::START_TIME );
		
		return EventPeer::doSelect( $criteria );
	}
	
	public function getPeopleList($returnPeople=false, $orderByList=null){
		
		$criteria = new Criteria();
		$criteria->add( EventPlayerPeer::EVENT_ID, $this->getId() );
		$criteria->addJoin( EventPlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		
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
			return EventPlayerPeer::doSelect($criteria);
	}
	
	public function getPlayerList($orderByList=null){
		
		return $this->getPeopleList(false, $orderByList);
	}
	
	public function addPlayer($peopleId, $confirm=false, $sendNotify=true){
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( !is_object($eventPlayerObj) ){
			
			$eventPlayerObj = new EventPlayer();
			$eventPlayerObj->setEventId( $this->getId() );
			$eventPlayerObj->setPeopleId( $peopleId );
			$eventPlayerObj->setDeleted(false);
		}
		
		if( $confirm && !$eventPlayerObj->getEnabled() ){
		
			$eventPlayerObj->setEnabled(true);
			$this->setPlayers( $this->getPlayers()+1 );
			$this->save();
			
			$rankingPlayerObj = RankingPlayerPeer::retrieveByPK($this->getRankingId(), $peopleId);
			$rankingPlayerObj->setEvents($rankingPlayerObj->getEvents()+1);
			$rankingPlayerObj->save();
			
			if( $sendNotify )
				$eventPlayerObj->notifyConfirm();
		}
		
		$eventPlayerObj->save();
	}
	
	public function deletePlayer($peopleId){

		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( is_object($eventPlayerObj) && $eventPlayerObj->getEnabled() ){
			
			
			$eventPlayerObj->setEventPosition(0);
			$eventPlayerObj->setPrize(0);
			$eventPlayerObj->setRebuy(0);
			$eventPlayerObj->setAddon(0);
			$eventPlayerObj->setBuyin(0);
			$eventPlayerObj->setEnabled(false);
			$eventPlayerObj->save();
			
			$this->setPlayers( $this->getPlayers()-1 );
			$this->save();
			
			$rankingPlayerObj = RankingPlayerPeer::retrieveByPK($this->getRankingId(), $peopleId);
			$rankingPlayerObj->setEvents($rankingPlayerObj->getEvents()-1);
			$rankingPlayerObj->save();
		}
	}
	
	public function removePlayer($peopleId){

		$this->deletePlayer($peopleId);

		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		$eventPlayerObj->delete();
	}
	
	public function isConfirmed($peopleId){
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		return is_object($eventPlayerObj) && $eventPlayerObj->getEnabled();
	}
	
	public function importPlayers(){

		$rankingPlayerObjList = $this->getRanking()->getPlayerList();
		
		foreach( $rankingPlayerObjList as $rankingPlayerObj )
			$this->addPlayer( $rankingPlayerObj->getPeopleId() );
			
		
		$this->setInvites( count($rankingPlayerObjList) );
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
		
		$orderByList = array(EventPlayerPeer::ENABLED=>'desc',
	  						 EventPlayerPeer::EVENT_POSITION=>'asc');
	  	
	  	$eventPlayerObjList = $this->getPlayerList($orderByList);

	  	$lastList = array();
	  	foreach($eventPlayerObjList as $key=>$eventPlayerObj){
	  		
	  		if( $eventPlayerObj->getEventPosition()==0 ){
	  			
	  			$lastList[] = $eventPlayerObj;
	  			unset($eventPlayerObjList[$key]);
	  		}
	  	}
	  	
	  	return array_merge($eventPlayerObjList, $lastList);
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
		$emailContent = str_replace('<players>', $this->getPlayers(), $emailContent);

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
		
		$eventPlayerObjList = $this->getPlayerList();
		foreach($eventPlayerObjList as $eventPlayerObj){
			
			$eventPosition   = $eventPlayerObj->getEventPosition();
			
			if( $eventPosition==0 )
				continue;
			
			$peopleObj = $eventPlayerObj->getPeople();
			
			$emailContentTmp = str_replace('<peopleName>', $peopleObj->getFirstName(), $emailContent);
			
			$congratsMessage = '';
			
			if( $eventPosition <= $this->getPaidPlaces() && $eventPosition > 0 )
				$congratsMessage = 'Parabéns, você ficou em '.$eventPosition.'º lugar no evento<br/><br/>';
				
			$emailContentTmp = str_replace('<congratsMessage>', $congratsMessage, $emailContentTmp);
			
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
		$emailContent = str_replace('<players>', $this->getPlayers(), $emailContent);
		$emailContent = str_replace('<rankingType>', strtolower($rankingObj->getRankingType()->getDescription()), $emailContent);
		
		return $emailContent;
	}
	
	public function getEmailResultList(){
		
		$resultList = '';
		$nl         = chr(10);
		
		$eventPlayerObjList = $this->getClassify();
	  	foreach($eventPlayerObjList as $key=>$eventPlayerObj){
		
			$eventPosition = $eventPlayerObj->getEventPosition();
			
			if( $eventPosition==0 )
				continue;
			
			$peopleObj = $eventPlayerObj->getPeople();
			
			$resultList .= '  <tr class="boxcontent">'.$nl;
			$resultList .= '    <td style="background: #1B4315">#'.$eventPosition.'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315">'.$peopleObj->getFullName().'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventPlayerObj->getBuyin(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventPlayerObj->getPrize(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventPlayerObj->getRebuy(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventPlayerObj->getAddon(), true).'</td>'.$nl;
			$resultList .= '  </tr>'.$nl;
	  	}
	  	
	  	return $resultList;
	}
	
	public function getEmailClassifyList(){
		
		$rankingObj   = $this->getRanking();
		$classifyList = '';
		$nl           = chr(10);
		$position     = 0;
		
		$rankingPlayerObjList = $rankingObj->getClassify();
	  	foreach($rankingPlayerObjList as $key=>$rankingPlayerObj){
		
			$peopleObj = $rankingPlayerObj->getPeople();
			
			$classifyList .= '  <tr class="boxcontent">'.$nl;
			$classifyList .= '    <td style="background: #1B4315">#'.(($position++)+1).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315">'.$peopleObj->getFullName().'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.$rankingPlayerObj->getEvents().'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.$rankingPlayerObj->getScore().'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingPlayerObj->getTotalPaid(), true).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingPlayerObj->getTotalPrize(), true).'</td>'.$nl;
			$classifyList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($rankingPlayerObj->getBalance(), true).'</td>'.$nl;
			$classifyList .= '  </tr>'.$nl;
	  	}
	  	
	  	return $classifyList;
	}
	
	public function getPosition($peopleId){
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( is_object($eventPlayerObj) )
			return $eventPlayerObj->getEventPosition();
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
		
		foreach( $this->getPlayerList() as $eventPlayerObj ){
			
			$eventPlayerNewObj = new EventPlayer();
			$eventPlayerNewObj->setEventId( $eventObj->getId() );
			$eventPlayerNewObj->setPeopleId( $eventPlayerObj->getPeopleId() );
			$eventPlayerNewObj->save();
		}

		return $eventObj;
	}
	
	public function isEditable(){

		$userSiteId = MyTools::getAttribute('userSiteId');
		$rankingObj = $this->getRanking();
		
		if(is_object($rankingObj) && $rankingObj->getUserSiteId()!=$userSiteId)
			return false;
		
		$eventDate = $this->getEventDate();
		if( $eventDate==null )
			return true;
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::RANKING_ID, $this->getRankingId() );
		$criteria->add( EventPeer::EVENT_DATE, $eventDate, Criteria::GREATER_THAN );
		$criteria->add( EventPeer::SAVED_RESULT, true );
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$eventCount = EventPeer::doCount($criteria);
		
		return ($eventCount==0);
	}
	
	public function getInfo(){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$infoList = array();
		$infoList['eventId']     = $this->getId();
		$infoList['isConfirmed'] = $this->isConfirmed($peopleId);
		$infoList['isEditable']  = $this->isEditable();
		
		return $infoList;
	}
}
