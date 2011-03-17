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
		
		$deleted = $this->getDeleted();
		
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('event', $this->getPrimaryKey());
		
		$rankingObj->decraseEvents();
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
		
		return '#'.sprintf('%04d', ($this->getId()+1985));
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

		$criterion = $criteria->getNewCriterion( EventPeer::EVENT_DATE, date('Y-m-d'), Criteria::LESS_EQUAL );
		$criterion->addAnd( $criteria->getNewCriterion( EventPeer::SAVED_RESULT, true ) );
		
		$criterion2 = $criteria->getNewCriterion( EventPeer::EVENT_DATE, date('Y-m-d'), Criteria::LESS_EQUAL );
		$criterion2->addAnd( $criteria->getNewCriterion( EventPeer::EVENT_DATE, date('Y-m-d', mktime(0,0,0,date('m'),date('d')-7,date('Y'))), Criteria::GREATER_THAN ) );

		$criterion->addOr( $criterion2 );

		$criteria->add( $criterion );
		
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
//		$criteria->add( EventPeer::START_TIME, date('H:i:s'), Criteria::GREATER_EQUAL );
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
		$criteria->addAnd( EventPlayerPeer::DELETED, false );
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
		
		$this->decraseInvite();

		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		$eventPlayerObj->delete();
	}
	
	public function isConfirmed($peopleId){
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		return is_object($eventPlayerObj) && $eventPlayerObj->getEnabled();
	}

	public function getInviteStatus($peopleId){
		
		$eventPlayerObj = EventPlayerPeer::retrieveByPK($this->getId(), $peopleId);
		
		if( !is_object($eventPlayerObj) ){
			
			return 'nok';
		}else{

			if( $eventPlayerObj->getDeleted() )
				return 'deleted';
			
			return $eventPlayerObj->getInviteStatus();
		}
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

		Util::getHelper('I18N');
		
		if( $this->getSentEmail() ){
			
			$templateName = 'eventChangeNotify';
			$emailSubject = 'email.subject.eventChangeNotify';
		}else{
			
			$templateName = 'eventCreateNotify';
			$emailSubject = 'email.subject.eventCreateNotify';
		}

		$infoList = array();
		$infoList['eventName']   = $this->getEventName();
		$infoList['rankingName'] = $this->getRanking()->getRankingName();
		$infoList['gameStyle']   = $this->getGameStyle()->getDescription();
		$infoList['eventPlace']  = $this->getEventPlace();
		$infoList['mapsLink']    = $this->getRankingPlace()->getMapsLink();
		$infoList['eventDate']   = $this->getEventDate('d/m/Y');
		$infoList['startTime']   = $this->getStartTime('H:i');
		$infoList['paidPlaces']  = $this->getPaidPlaces();
		$infoList['buyin']       = Util::formatFloat($this->getBuyin(), true);
		$infoList['comments']    = $this->getComments();
		$infoList['invites']     = $this->getInvites();
		$infoList['players']     = $this->getPlayers();
		
		$iCalFile = $this->getICal('update');
		$attachmentList  = array('invite.ics'=>$iCalFile);
		$optionList      = array('attachmentList'=>$attachmentList);

		$emailContentList['pt_BR'] = Report::replace(AuxiliarText::getContentByTagName($templateName, false, 'pt_BR'), $infoList);
		$emailContentList['en_US'] = Report::replace(AuxiliarText::getContentByTagName($templateName, false, 'en_US'), $infoList);
		$emailSubjectList['pt_BR'] = __($emailSubject, null, 'messages', 'pt_BR');
		$emailSubjectList['en_US'] = __($emailSubject, null, 'messages', 'en_US');

		foreach($this->getEventPlayerList() as $eventPlayerObj){
			
			$peopleObj    = $eventPlayerObj->getPeople();
			$emailAddress = $peopleObj->getEmailAddress();
			$culture      = $peopleObj->getDefaultLanguage();
			$emailContent = $emailContentList[$culture];
			$emailSubject = $emailSubjectList[$culture];
			
			$emailContent = str_replace('<peopleName>', $peopleObj->getFirstName(), $emailContent);
			$emailContent = str_replace('<confirmCode>', $eventPlayerObj->getConfirmCode(), $emailContent);

			Report::sendMail($emailSubject, $emailAddress, $emailContent, $optionList);
		}
 
		unlink($iCalFile);
		
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
			
			if( $eventPosition <= $this->getPaidPlaces() && $eventPosition > 0 ){
				
				$sufix = 'th';
				
				if( ereg('1$', $eventPosition) ) $sufix = 'st';
				elseif( ereg('2$', $eventPosition) ) $sufix = 'nd';
				elseif( ereg('3$', $eventPosition) ) $sufix = 'rd';
				
				$congratsMessage = __('event.congratMessage', array('%eventPosition%'=>$eventPosition, '%sufix%'=>$sufix)).'<br/><br/>';
			}

			$emailContentTmp = str_replace('<congratsMessage>', $congratsMessage, $emailContentTmp);

			Report::sendMail(__('email.subject.eventResult', array('%eventName%'=>$this->getEventName())), $peopleObj->getEmailAddress(), $emailContentTmp);
		}
	}
	
	public function notifyDelete(){

		Util::getHelper('I18N');

		$emailContent = AuxiliarText::getContentByTagName('eventDeleteNotify');

		$emailContent = $this->getEmailContent($emailContent);
	  	$classifyList = $this->getEmailClassifyList();
	  	$peopleName   = People::getCurrentPeople()->getName();
		
		$emailContent = str_replace('<peopleName>', $peopleName, $emailContent);
		$emailContent = str_replace('<classifyList>', $classifyList, $emailContent);
		
		$emailAddressList = $this->getEmailAddressList();
		
		$iCalFile = $this->getICal('delete');
		$attachmentList  = array('invite.ics'=>$iCalFile);
		$optionList      = array('attachmentList'=>$attachmentList);
		
		Report::sendMail(__('email.subject.eventDeleteNotify', array('%eventName%'=>$this->getEventName())), $emailAddressList, $emailContent, $optionList);
		unlink($iCalFile);
	}
	
	public function notifyReminder($days=7){

		Util::getHelper('I18N');

		$emailContent = AuxiliarText::getContentByTagName('eventReminder');
		$emailContent = $this->getEmailContent($emailContent);
		
		$eventSchedule = ($days==0?__('today'):__('inDays', array('%days%'=>$days)));
		switch($days){
			case 1:
				$eventSchedule = ' '.__('tomorrow');
				break;	
		}
		
		$emailContent = str_replace('<eventSchedule>', $eventSchedule, $emailContent);
		
		$emailAddressList = $this->getEmailAddressList('receiveEventReminder'.$days);
		
		Report::sendMail(__('email.subject.eventReminder', array('%eventName%'=>$this->getEventName())), $emailAddressList, $emailContent);
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

		// Se hoje for maior que a data final do ranking
		if( $this->getSavedResult() && $rankingObj->getFinishDate()!==null && $rankingObj->getFinishDate(null) < time() )
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
		
		if( $this->getRanking()->isShared($peopleId) )
			$eventPlayerObj->share(false);
			
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
	
	public function isShared($peopleIdException){
		
		$criteria = new Criteria();
		$criteria->add( EventPlayerPeer::EVENT_ID, $this->getId() );
		$criteria->add( EventPlayerPeer::PEOPLE_ID, $peopleIdException, Criteria::NOT_EQUAL );
		$criteria->add( EventPlayerPeer::DELETED, false );
		$criteria->add( EventPlayerPeer::ALLOW_EDIT, true );
		return EventPlayerPeer::doCount($criteria) > 0;
	}
	
	public function updateInvites(){
		
		$invites = Util::executeOne('SELECT COUNT(1) FROM event_player WHERE event_id = '.$this->getId().' AND deleted = FALSE', 'int');
		$this->setInvites( $invites );
		$this->save();
	}
	
	public function decraseInvite(){
		
		$this->setInvites( $this->getInvites()-1 );
		$this->save();
	}
	
	public function getICal($action='update', $returnContent=false){
		
		Util::getHelper('I18N');
		
		$peopleObj  = People::getCurrentPeople();
		$rankingObj = $this->getRanking();
		
		$organizerName         = 'iRank - Poker Ranking';
		$organizerEmailAddress = 'irank@irank.com.br';
		
		$days = array($this->getEventDate('w'));

		$organizer   = array($organizerName, $organizerEmailAddress);
		$categories  = array('Game');
		$eventDate   = strtotime($this->getEventDate('Y-m-d').' '.$this->getStartTime('H:i:s'));
		$description = __('event.iCal.description', array('%rankingName%'=>$rankingObj->getRankingName(),
														  '%buyIn%'=>Util::formatFloat($this->getBuyin(), true),
														  '%paidPlaces%'=>$this->getPaidPlaces(),
														  '%comments%'=>$this->getComments())); 
		
		$attendeeList = array();
						   
		foreach($this->getPlayerList() as $eventPlayerObj){
		
			$inviteStatus = $eventPlayerObj->getInviteStatus();
			$status       = ($inviteStatus=='yes'?'ACCEPTED':($inviteStatus=='no'?'DECLINED':'TENTATIVE'));
			
			$peopleObj      = $eventPlayerObj->getPeople();
			$attendeeList[$peopleObj->getName()] = $peopleObj->getEmailAddress().',1,'.$status;
		}
		
		$downloadPath = Util::getFilePath('/temp');
		$iCal = new iCal('', 0, $downloadPath); // (ProgrammID, Method (1 = Publish | 0 = Request), Download Directory)

		$alarm = array(0, // Action: 0 = DISPLAY, 1 = EMAIL, (not supported: 2 = AUDIO, 3 = PROCEDURE)
					   150,  // Trigger: alarm before the event in minutes
					   'iRank - '.$this->getEventName(), // Title
					   __('event.iCal.remindDescription'), // Description
					   $attendeeList, // Array (key = attendee name, value = e-mail, second value = role of the attendee [0 = CHAIR | 1 = REQ | 2 = OPT | 3 =NON])
					   5, // Duration between the alarms in minutes
					   3  // How often should the alarm be repeated
					   );
		
		if( $action=='delete' )
			$alarm = null;

		$iCal->addEvent($organizer, // Organizer
						$eventDate, // Start Time (timestamp; for an allday event the startdate has to start at YYYY-mm-dd 00:00:00)
						null, // End Time (write 'allday' for an allday event instead of a timestamp)
						$this->getRankingPlace()->getPlaceName(), // Location
						1, // Transparancy (0 = OPAQUE | 1 = TRANSPARENT)
						$categories, // Array with Strings
						$description, // Description
						$this->getEventName(), // Title
						1, // Class (0 = PRIVATE | 1 = PUBLIC | 2 = CONFIDENTIAL)
						$attendeeList, // Array (key = attendee name, value = e-mail, second value = role of the attendee [0 = CHAIR | 1 = REQ | 2 = OPT | 3 =NON])
						5, // Priority = 0-9
						0, // frequency: 0 = once, secoundly - yearly = 1-7
						'', // recurrency end: ('' = forever | integer = number of times | timestring = explicit date)
						1, // Interval for frequency (every 2,3,4 weeks...)
						$days, // Array with the number of the days the event accures (example: array(0,1,5) = Sunday, Monday, Friday
						0, // Startday of the Week ( 0 = Sunday - 6 = Saturday)
						'', // exeption dates: Array with timestamps of dates that should not be includes in the recurring event
						$alarm,  // Sets the time in minutes an alarm appears before the event in the programm. no alarm if empty string or 0
						($action=='update'?1:2), // Status of the event (0 = TENTATIVE, 1 = CONFIRMED, 2 = CANCELLED)
						'http://www.irank.com.br/', // optional URL for that event
						'pt_BR', // Language of the Strings
		                md5('irankEvent-'.$this->getId()) // Optional UID for this event
					   );
		
		if( $returnContent ){
			
			header('Content-type: application/force-download');
			header('Content-Disposition: attachment; filename="invite.ics"');
			
			$iCal->outputFile();
			exit;
		}else{
		
			$iCal->writeFile();
			return $iCal->getFilePath();
		}
	}
	
	public function getInfo(){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$infoList = array();
		$infoList['eventId']      = $this->getId();
		$infoList['isConfirmed']  = $this->isConfirmed($peopleId);
		$infoList['pastDate']     = $this->isPastDate();
		$infoList['isEditable']   = $this->isEditable();
		$infoList['inviteStatus'] = $this->getInviteStatus($peopleId);
		
		return $infoList;
	}
}
