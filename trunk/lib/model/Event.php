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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

    		$this->postOnWall();

			parent::save();
			
        	Log::quickLog('event', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event', $this->getPrimaryKey(), $e);
        }
        
    }
	
	public function delete($con=null){
		
		$rankingObj = $this->getRanking();
		$rankingObj->setEvents($rankingObj->getEvents()-1);
		$rankingObj->save();
		
		$deleted = $this->getDeleted();
		
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('event', $this->getPrimaryKey());
		
		$rankingObj->updateScores();
		
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
	
	public static function getList($criteria=null, $limit=null){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		if( !is_object($criteria) )
			$criteria = new Criteria();

		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( RankingPeer::DELETED, false );
		$criteria->add( UserSitePeer::ID, $userSiteId );
		$criteria->addJoin( EventPeer::RANKING_ID, RankingPeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( RankingPeer::ID, RankingPlayerPeer::RANKING_ID, Criteria::INNER_JOIN );
		$criteria->addJoin( RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( PeoplePeer::ID, UserSitePeer::PEOPLE_ID, Criteria::INNER_JOIN );
		$criteria->addDescendingOrderByColumn( EventPeer::EVENT_DATE );
		$criteria->addDescendingOrderByColumn( EventPeer::START_TIME );
		
		$criteria->setLimit($limit);
		
		return EventPeer::doSelect( $criteria );
	}
	
	public static function getPreviousList($limit=null){
		
		$criteria = new Criteria();

		$criteria->add( EventPeer::EVENT_DATE, date('Y-m-d'), Criteria::LESS_EQUAL );
		$criteria->add( EventPeer::SAVED_RESULT, true );
		
		return self::getList($criteria, $limit);
	}
	
	public static function getNextList($criteria=null, $limit=null){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		if( !is_object($criteria) )
			$criteria = new Criteria();

		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( EventPeer::EVENT_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
		$criteria->add( EventPeer::START_TIME, date('H:i:s'), Criteria::GREATER_EQUAL );
		$criteria->add( EventPeer::SAVED_RESULT, false );
		$criteria->add( UserSitePeer::ID, $userSiteId );
		$criteria->addJoin( EventPeer::RANKING_ID, RankingPeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( RankingPeer::ID, RankingPlayerPeer::RANKING_ID, Criteria::INNER_JOIN );
		$criteria->addJoin( RankingPlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( PeoplePeer::ID, UserSitePeer::PEOPLE_ID, Criteria::INNER_JOIN );
		$criteria->addDescendingOrderByColumn( EventPeer::EVENT_DATE );
		$criteria->addDescendingOrderByColumn( EventPeer::START_TIME );
		
		$criteria->setLimit($limit);
		
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
	
	public function getCommentList($limit=null){
		
		$criteria = new Criteria();
		$criteria->add( EventCommentPeer::EVENT_ID, $this->getId() );
		$criteria->add( EventCommentPeer::DELETED, false );
		$criteria->addJoin( EventCommentPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		
		$criteria->addDescendingOrderByColumn( EventCommentPeer::CREATED_AT );

		if( $limit )
			$criteria->setLimit($limit);
		
		return EventCommentPeer::doSelect($criteria);
	}
	
	public function getCommentCount(){
		
		$criteria = new Criteria();
		$criteria->add( EventCommentPeer::EVENT_ID, $this->getId() );
		$criteria->add( EventCommentPeer::DELETED, false );
		$criteria->addJoin( EventCommentPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		
		return EventCommentPeer::doCount($criteria);
	}
	
	public function getPlayerList($orderByList=null){
		
		return $this->getPeopleList(false, $orderByList);
	}
	
	public function addPlayer($peopleId, $confirm=false, $sendNotify=true){
		
		$this->togglePresence( $peopleId, ($confirm?'yes':'none'), $sendNotify );
	}
	
	public function deletePlayer($peopleId){

		$this->togglePresence( $peopleId, 'no', false );
	}
	
	public function removePlayer($peopleId){

		$this->togglePresence($peopleId, 'no');

		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		$eventPlayerObj->delete();
	}
	
	public function isConfirmed($peopleId){
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		return is_object($eventPlayerObj) && $eventPlayerObj->getEnabled();
	}

	public function getInviteStatus($peopleId){
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( !is_object($eventPlayerObj) )
			return 'nok';
		else
			return $eventPlayerObj->getInviteStatus();
	}
	
	public function importPlayers(){

		$rankingPlayerObjList = $this->getRanking()->getPlayerList();
		
		foreach( $rankingPlayerObjList as $rankingPlayerObj )
			$this->togglePresence( $rankingPlayerObj->getPeopleId(), 'none' );
		
		$this->setInvites( count($rankingPlayerObjList) );
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
			
		return ($rankingObj->isMyRanking() || $this->isAllowEdit());
	}
	
	public function isAllowEdit(){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK( $this->getId(), $peopleId );
		
		return $eventPlayerObj->getAllowEdit();
	}
	
	public function getGameStyle($returnTagName=false){
		
		return $this->getRanking()->getGameStyle($returnTagName);
	}
	
	public function getEmailAddressList($tagName=null, $supressMe=false){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$emailAddressList = array();
		
		if( $tagName )
			$userSiteOptionId = VirtualTable::getIdByTagName('userSiteOption', $tagName);
		
		foreach( $this->getPeopleList(true) as $peopleObj ){
			
			if( $supressMe && $peopleId==$peopleObj->getId() )
				continue;

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
		$emailContent = str_replace('<mapsLink>', $this->getRankingPlace()->getMapsLink(), $emailContent);
		$emailContent = str_replace('<eventDate>', $this->getEventDate('d/m/Y'), $emailContent);
		$emailContent = str_replace('<startTime>', $this->getStartTime('H:i'), $emailContent);
		$emailContent = str_replace('<paidPlaces>', $this->getPaidPlaces(), $emailContent);
		$emailContent = str_replace('<buyin>', Util::formatFloat($this->getBuyin(), true), $emailContent);
		$emailContent = str_replace('<comments>', $this->getComments(), $emailContent);
		$emailContent = str_replace('<invites>', $this->getInvites(), $emailContent);
		$emailContent = str_replace('<players>', $this->getPlayers(), $emailContent);

		foreach($this->getEventPlayerList() as $eventPlayerObj){
			
			$peopleObj       = $eventPlayerObj->getPeople();
			$emailAddress    = $peopleObj->getEmailAddress();
			$emailContentTmp = str_replace('<peopleName>', $peopleObj->getFirstName(), $emailContent);
			$emailContentTmp = str_replace('<confirmCode>', $eventPlayerObj->getConfirmCode(), $emailContentTmp);
			
			Report::sendMail($emailSubject, $emailAddress, $emailContentTmp);
		}
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
		switch($days){
			case 1:
				$eventSchedule = ' amanhã';
				break;	
		}
		
		$emailContent = str_replace('<eventSchedule>', $eventSchedule, $emailContent);
		
		$emailAddressList = $this->getEmailAddressList('receiveEventReminder'.$days);
		
		Report::sendMail('Lembrete de evento @ '.$this->getEventName(), $emailAddressList, $emailContent);
	}
	
	public function getEmailContent($emailContent){

		$rankingObj = $this->getRanking();

		$rankingType = $rankingObj->getRankingType()->getDescription();
		
		$emailContent = str_replace('<eventName>', $this->getEventName(), $emailContent);
		$emailContent = str_replace('<rankingName>', $this->getRanking()->getRankingName(), $emailContent);
		$emailContent = str_replace('<gameStyle>', $this->getGameStyle()->getDescription(), $emailContent);
		$emailContent = str_replace('<eventPlace>', $this->getEventPlace(), $emailContent);
		$emailContent = str_replace('<mapsLink>', $this->getRankingPlace()->getMapsLink(), $emailContent);
		$emailContent = str_replace('<eventDate>', $this->getEventDate('d/m/Y'), $emailContent);
		$emailContent = str_replace('<startTime>', $this->getStartTime('H:i'), $emailContent);
		$emailContent = str_replace('<paidPlaces>', $this->getPaidPlaces(), $emailContent);
		$emailContent = str_replace('<buyin>', Util::formatFloat($this->getBuyin(), true), $emailContent);
		$emailContent = str_replace('<comments>', $this->getComments(), $emailContent);
		$emailContent = str_replace('<invites>', $this->getInvites(), $emailContent);
		$emailContent = str_replace('<players>', $this->getPlayers(), $emailContent);
		$emailContent = str_replace('<rankingType>', $rankingType, $emailContent);
		
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
			$resultList .= '    <td style="background: #1B4315" align="right">'.Util::formatFloat($eventPlayerObj->getScore(), true, 3).'</td>'.$nl;
			$resultList .= '  </tr>'.$nl;
	  	}
	  	
	  	return $resultList;
	}
	
	public function getEmailClassifyList(){
		
		$rankingObj   = $this->getRanking();
		$classifyList = $rankingObj->getEmailClassifyList();
	  	
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
		$eventObj->setRankingPlaceId($this->getRankingPlaceId());
		$eventObj->setEventDate($this->getEventDate());
		$eventObj->setStartTime($this->getStartTime());
		$eventObj->setPaidPlaces($this->getPaidPlaces());
		$eventObj->setInvites($this->getInvites());
		$eventObj->setPlayers($this->getPlayers());
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
			$eventPlayerNewObj->setInviteStatus( $eventPlayerObj->getInviteStatus() );
			$eventPlayerNewObj->setEnabled( $eventPlayerObj->getEnabled() );
			$eventPlayerNewObj->save();
		}

		return $eventObj;
	}
	
	public function isEditable(){

		$userSiteId = MyTools::getAttribute('userSiteId');
		$rankingObj = $this->getRanking();
		
		if( is_object($rankingObj) && !$rankingObj->isMyRanking() )
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
	
	public function togglePresence($peopleId, $choice, $forceNotify=null){
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		$eventPlayerObj->togglePresence($choice, $forceNotify);
	}
	
	public function saveResult($request){
		
		$eventId    = $this->getId();
		$rankingObj = $this->getRanking();
		
		$paidPlaces = 0;
		$players    = 0;
		
		$eventPlayerObjList = $this->getPlayerList();
		$totalBuyin         = 0;
		foreach($eventPlayerObjList as $eventPlayerObj){
			
			$peopleId      = $eventPlayerObj->getPeopleId();
			$buyin         = $request->getParameter('buyin'.$peopleId);
			$rebuy         = $request->getParameter('rebuy'.$peopleId);
			$addon         = $request->getParameter('addon'.$peopleId);
			$eventPosition = $request->getParameter('eventPosition'.$peopleId);
			
			if( $eventPosition > 0 )
				$totalBuyin += Util::formatFloat($buyin)+Util::formatFloat($rebuy)+Util::formatFloat($addon);
		}
		
		foreach($eventPlayerObjList as $eventPlayerObj){
			
			$peopleId      = $eventPlayerObj->getPeopleId();
			$buyin         = $request->getParameter('buyin'.$peopleId);
			$rebuy         = $request->getParameter('rebuy'.$peopleId);
			$addon         = $request->getParameter('addon'.$peopleId);
			$eventPosition = $request->getParameter('eventPosition'.$peopleId);
			$prize         = $request->getParameter('prize'.$peopleId);
			
			$eventPlayerObj = EventPlayerPeer::retrieveByPK($eventId, $peopleId);
			$enabled        = $eventPlayerObj->getEnabled();
			
			if( !$enabled && $eventPosition > 0 ){
				
				$this->addPlayer($peopleId, true, false);
				$enabled = true;
			}
			
			if( $enabled && $eventPosition == 0 ){
				
				$this->deletePlayer($peopleId);
				$enabled = false;
			}
			
			if( $enabled ){
				
				if( $prize > 0 )
					$paidPlaces++;
	
				$eventPlayerObj->setEventPosition($eventPosition);
				$eventPlayerObj->setPrize( Util::formatFloat($prize) );
				$eventPlayerObj->setRebuy( Util::formatFloat($rebuy) );
				$eventPlayerObj->setAddon( Util::formatFloat($addon) );
				$eventPlayerObj->setBuyin( Util::formatFloat($buyin) );
				$eventPlayerObj->setScore( $totalBuyin/$eventPosition/$buyin );
				$eventPlayerObj->save();
				$players++;
			}
		}
		
		$this->setPlayers($players);
		$this->setPaidPlaces($paidPlaces);
		$this->setSavedResult(true);
		$this->save();
		
		$rankingObj->updateScores();
		$rankingObj->updatePlayerEvents();
		$rankingObj->updateHistory($this->getEventDate('d/m/Y'));
		
		$this->notifyResult();
	}
	
	public function isInvited($peopleId){
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		return (is_object($eventPlayerObj) && !$eventPlayerObj->getDeleted());
	}
	
	public function getPhotoList(){
		
		$criteria = new Criteria();
		$criteria->add( EventPhotoPeer::EVENT_ID, $this->getId() );
		$criteria->add( EventPhotoPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( EventPhotoPeer::ID );
		
		return EventPhotoPeer::doSelect($criteria);
	}
	
	public function getEventPlace(){

		$rankingPlaceObj = $this->getRankingPlace();

		if( !is_object($rankingPlaceObj) )
			return null;
		
		return $rankingPlaceObj->getPlaceName();
	}
	
	public function postOnWall(){
		
		if( $this->getDeleted() || !$this->getVisible() )
			return false;
			
		$isNew       = $this->isNew();
		$savedResult = $this->isColumnModified( EventPeer::SAVED_RESULT );
		
		if( $isNew )
        	HomeWall::doLog('criado novo evento <b>'.$this->getEventName().'</b>', 'event');
		
		if( $savedResult && $this->getSavedResult() )
    		HomeWall::doLog('o resultado do evento <b>'.$this->getEventName().'</b> foi atualizado', 'event');
	}
	
	public function getInfo(){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$infoList = array();
		$infoList['eventId']      = $this->getId();
		$infoList['isConfirmed']  = $this->isConfirmed($peopleId);
		$infoList['isEditable']   = $this->isEditable();
		$infoList['inviteStatus'] = $this->getInviteStatus($peopleId);
		
		return $infoList;
	}
}
