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
	
	public function toString($withDate=false){
		
		$string = $this->getEventName().' ';
		
		if( $withDate )
			$string .= '- '.$this->getEventDate('d/m/Y').'\n';
		
		$string .= '@ '.$this->getEventPlace();
		
		return $string;
	}
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

    		$this->postOnWall();
    		
    		$this->setEventDateTime($this->getEventDate('Y-m-d').' '.$this->getStartTime());

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
	
	public function getEventName($showSufix=true){
		
		return parent::getEventName().($this->getIsFreeroll() && $showSufix?' [Freeroll]':'');
	}
	
	public static function getList($criteria=null, $limit=null, $userSiteId=null){
		
		$userSiteId = ($userSiteId?$userSiteId:MyTools::getAttribute('userSiteId'));
		
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
	
	public static function getPreviousList($criteria=null, $limit=null, $userSiteId=null){
		
		$userSiteId = ($userSiteId?$userSiteId:MyTools::getAttribute('userSiteId'));
		
		if( !is_object($criteria) )
			$criteria = new Criteria();

		$criterion = $criteria->getNewCriterion( EventPeer::EVENT_DATE_TIME, date('Y-m-d H:i'), Criteria::LESS_EQUAL );
		$criterion->addAnd( $criteria->getNewCriterion( EventPeer::SAVED_RESULT, true ) );

		$criterion2 = $criteria->getNewCriterion( EventPeer::EVENT_DATE_TIME, date('Y-m-d H:i'), Criteria::LESS_EQUAL );
		$criterion2->addAnd( $criteria->getNewCriterion( EventPeer::EVENT_DATE, date('Y-m-d', mktime(0,0,0,date('m'),date('d')-7,date('Y'))), Criteria::GREATER_THAN ) );

		$criterion->addOr( $criterion2 );

		$criteria->add( $criterion );
		
		return self::getList($criteria, $limit, $userSiteId);
	}

	public static function getNextList($criteria=null, $limit=null, $userSiteId=null){
		
		$userSiteId = ($userSiteId?$userSiteId:MyTools::getAttribute('userSiteId'));
		
		if( !is_object($criteria) )
			$criteria = new Criteria();

		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::VISIBLE, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( EventPeer::EVENT_DATE_TIME, date('Y-m-d H:i'), Criteria::GREATER_EQUAL );
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

	public static function getResumeList($limit=null, $userSiteId=null){
		
		$criteria = new Criteria();
		$criteria->setNoFilter(true);
		
		$eventObjListNext = Event::getNextList($criteria, $limit, $userSiteId);
		
		$criteria = new Criteria();
		$criteria->setNoFilter(true);
			
		$eventObjListPrevious = Event::getPreviousList($criteria, $limit, $userSiteId);
		
		return array_merge($eventObjListNext, $eventObjListPrevious);
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
		
		if( $orderByList=='result' )
		  	$orderByList = array(EventPlayerPeer::ENABLED=>'desc',
					 			 EventPlayerPeer::EVENT_POSITION=>'asc');

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
		
		$this->adjustEventPlayers();
	}
	
	public function adjustEventPlayers(){
		
		Util::executeQuery('SELECT adjust_event_players('.$this->getId().')');
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
	
	public function getEmailAddressList($tagName=null, $supressMe=false, $returnCulture=false){
		
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
			
			if( $returnCulture )
				$emailAddressList[] = array('emailAddress'=>$peopleObj->getEmailAddress(),
											'culture'=>$peopleObj->getDefaultLanguage());
			else
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

		$entranceFee = $this->getEntranceFee();
		
		$infoList = array();
		$infoList['eventName']   = $this->getEventName();
		$infoList['rankingName'] = $this->getRanking()->getRankingName();
		$infoList['gameStyle']   = $this->getGameStyle()->getDescription();
		$infoList['eventPlace']  = $this->getEventPlace();
		$infoList['mapsLink']    = $this->getRankingPlace()->getMapsLink();
		$infoList['eventDate']   = $this->getEventDate('d/m/Y');
		$infoList['startTime']   = $this->getStartTime('H:i');
		$infoList['paidPlaces']  = $this->getPaidPlaces();
		$infoList['entranceFee'] = Util::formatFloat($entranceFee, true);
		$infoList['buyin']       = ($entranceFee?$infoList['entranceFee'].'+':'').Util::formatFloat($this->getBuyin(), true);
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

		$templateName = 'eventResult';
		$emailSubject = 'email.subject.eventResult';
		
		$resultList   = $this->getEmailResultList();
	  	$classifyList = $this->getEmailClassifyList();
		
		$infoList['resultList']   = $resultList;
		$infoList['classifyList'] = $classifyList;
		$infoList                 = array_merge($infoList, $this->getInfo());
		
		$emailContentList['pt_BR'] = Report::replace(AuxiliarText::getContentByTagName($templateName, false, 'pt_BR'), $infoList);
		$emailContentList['en_US'] = Report::replace(AuxiliarText::getContentByTagName($templateName, false, 'en_US'), $infoList);
		$emailSubjectList['pt_BR'] = __($emailSubject, array('%eventName%'=>$this->getEventName()), 'messages', 'pt_BR');
		$emailSubjectList['en_US'] = __($emailSubject, array('%eventName%'=>$this->getEventName()), 'messages', 'en_US');
		
		$userSiteOptionId = VirtualTable::getIdByTagName('userSiteOption', 'receiveAllResults');
		
		$eventPlayerObjList = $this->getPlayerList();
		foreach($eventPlayerObjList as $eventPlayerObj){
			
			$eventPosition = $eventPlayerObj->getEventPosition();
			
			$receiveAllResults = $eventPlayerObj->getPeople()->getOptionValue($userSiteOptionId);
			
			if( $eventPosition==0 && !$receiveAllResults )
				continue;
			
			$peopleObj = $eventPlayerObj->getPeople();
			$emailAddress = $peopleObj->getEmailAddress();
			$culture      = $peopleObj->getDefaultLanguage();
			$emailContent = $emailContentList[$culture];
			$emailSubject = $emailSubjectList[$culture];
			
			$emailContent = str_replace('<peopleName>', $peopleObj->getFirstName(), $emailContent);
			
			$congratsMessage = '';
			
			if( $eventPosition <= $this->getPaidPlaces() && $eventPosition > 0 ){
				
				$sufix = 'th';
				
				if( ereg('1$', $eventPosition) ) $sufix = 'st';
				elseif( ereg('2$', $eventPosition) ) $sufix = 'nd';
				elseif( ereg('3$', $eventPosition) ) $sufix = 'rd';
				
				$congratsMessage = __('event.congratMessage', array('%eventPosition%'=>$eventPosition, '%sufix%'=>$sufix), 'messages', $culture).'<br/><br/>';
			}

			$emailContent = str_replace('<congratsMessage>', $congratsMessage, $emailContent);

			Report::sendMail($emailSubject, $emailAddress, $emailContent);
		}
	}
	
	public function notifyDelete(){

		Util::getHelper('I18N');

		$templateName = 'eventDeleteNotify';
		$emailSubject = 'email.subject.eventDeleteNotify';
		
	  	$classifyList = $this->getEmailClassifyList();
	  	$peopleName   = People::getCurrentPeople()->getName();
		
		$infoList['classifyList'] = $classifyList;
		$infoList                 = array_merge($infoList, $this->getInfo());
		
		$emailContentList['pt_BR'] = Report::replace(AuxiliarText::getContentByTagName($templateName, false, 'pt_BR'), $infoList);
		$emailContentList['en_US'] = Report::replace(AuxiliarText::getContentByTagName($templateName, false, 'en_US'), $infoList);
		$emailSubjectList['pt_BR'] = __($emailSubject, array('%eventName%'=>$this->getEventName()), 'messages', 'pt_BR');
		$emailSubjectList['en_US'] = __($emailSubject, array('%eventName%'=>$this->getEventName()), 'messages', 'en_US');
		
		$emailAddressInfoList = $this->getEmailAddressList(null, false, true);
		
		$iCalFile = $this->getICal('delete');
		$attachmentList  = array('invite.ics'=>$iCalFile);
		$optionList      = array('attachmentList'=>$attachmentList);
		
		foreach($emailAddressInfoList as $emailAddressInfo){
			
			$emailAddress = $emailAddressInfo['emailAddress'];
			$culture      = $emailAddressInfo['culture'];
			$emailContent = $emailContentList[$culture];
			$emailSubject = $emailSubjectList[$culture];
			
			Report::sendMail($emailSubject, $emailAddress, $emailContent, $optionList);
		}
		
		unlink($iCalFile);
	}
	
	public function notifyReminder($days=7){

		Util::getHelper('I18N');
		
		$templateName  = 'eventReminder';
		$emailSubject  = 'email.subject.eventReminder';
		$eventSchedule = ($days==0?'today':($days==1?'tomorrow':'inDays'));
		
	  	$classifyList = $this->getEmailClassifyList();

		$eventScheduleList['pt_BR'] = __($eventSchedule, array('%days%'=>$days), 'messages', 'pt_BR');
		$eventScheduleList['en_US'] = __($eventSchedule, array('%days%'=>$days), 'messages', 'en_US');
		
		$infoList = $this->getInfo();
		
		$emailContentList['pt_BR']  = Report::replace(AuxiliarText::getContentByTagName($templateName, false, 'pt_BR'), array_merge($infoList, array('eventSchedule'=>$eventScheduleList['pt_BR'])));
		$emailContentList['en_US']  = Report::replace(AuxiliarText::getContentByTagName($templateName, false, 'en_US'), array_merge($infoList, array('eventSchedule'=>$eventScheduleList['en_US'])));
		$emailSubjectList['pt_BR']  = __($emailSubject, array('%eventName%'=>$this->getEventName()), 'messages', 'pt_BR');
		$emailSubjectList['en_US']  = __($emailSubject, array('%eventName%'=>$this->getEventName()), 'messages', 'en_US');

		$emailAddressInfoList = $this->getEmailAddressList('receiveEventReminder'.$days, false, true);

		foreach($emailAddressInfoList as $emailAddressInfo){

			$emailAddress  = $emailAddressInfo['emailAddress'];
			$culture       = $emailAddressInfo['culture'];
			$emailContent  = $emailContentList[$culture];
			$emailSubject  = $emailSubjectList[$culture];
			$eventSchedule = $eventScheduleList[$culture];
			
			Report::sendMail($emailSubject, $emailAddress, $emailContent);
		}
	}
	
	public function getEmailContent($emailContent){

		return Report::replace($emailContent, $this->getInfo());
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
			$resultList .= '    <td style="background: #606060">#'.$eventPosition.'</td>'.$nl;
			$resultList .= '    <td style="background: #606060">'.$peopleObj->getFullName().'</td>'.$nl;
			$resultList .= '    <td style="background: #606060" align="right">'.Util::formatFloat($eventPlayerObj->getBuyin(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #606060" align="right">'.Util::formatFloat($eventPlayerObj->getPrize(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #606060" align="right">'.Util::formatFloat($eventPlayerObj->getRebuy(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #606060" align="right">'.Util::formatFloat($eventPlayerObj->getAddon(), true).'</td>'.$nl;
			$resultList .= '    <td style="background: #606060" align="right">'.Util::formatFloat($eventPlayerObj->getScore(), true, 3).'</td>'.$nl;
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
		$eventObj->setEntranceFee($this->getEntranceFee());
		$eventObj->setComments($this->getComments());
		$eventObj->setAllowRebuy($this->getAllowRebuy());
		$eventObj->setAllowAddon($this->getAllowAddon());
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
	
	public function isEditable($ignorePeople=false){

		$userSiteId = MyTools::getAttribute('userSiteId');
		$rankingObj = $this->getRanking();
		
		if( !$userSiteId || (!$ignorePeople && is_object($rankingObj) && !$rankingObj->isMyRanking()) )
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
		
		$entranceFee = $this->getEntranceFee();
		$isFreeroll  = $this->getIsFreeroll();
		
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
		
		if( $isFreeroll )
			$totalBuyin += $this->getPrizePot();
			
		foreach($eventPlayerObjList as $eventPlayerObj){
			
			$peopleId      = $eventPlayerObj->getPeopleId();
			$buyin         = $request->getParameter('buyin'.$peopleId);
			$rebuy         = $request->getParameter('rebuy'.$peopleId);
			$addon         = $request->getParameter('addon'.$peopleId);
			$eventPosition = $request->getParameter('eventPosition'.$peopleId);
			$prize         = $request->getParameter('prize'.$peopleId);

			$eventPlayerObj = EventPlayerPeer::retrieveByPK($eventId, $peopleId);
			$enabled        = $eventPlayerObj->getEnabled();
			
			if( $isFreeroll )
				$buyin = $this->getRanking()->getDefaultBuyin();
			
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
				$eventPlayerObj->setEntranceFee( Util::formatFloat($entranceFee) );
				$eventPlayerObj->setRebuy( Util::formatFloat($rebuy) );
				$eventPlayerObj->setAddon( Util::formatFloat($addon) );
				$eventPlayerObj->setBuyin( Util::formatFloat(($isFreeroll?0:$buyin)) );
				
				$score = $totalBuyin/$eventPosition/$buyin;
				
//				if( !$isFreeroll )
					$eventPlayerObj->setScore( $score );
					
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
														  '%entranceFee%'=>Util::formatFloat($this->getEntranceFee(), true),
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
	
	public function getFacebookResult($peopleId=null, $thumb=false){
		
		Util::getHelper('Form');
		Util::getHelper('Text');
		
		if( $peopleId )
			$peopleObj = PeoplePeer::retrieveByPK($peopleId);
		else			
			$peopleObj = People::getCurrentPeople();
		
		$culture = $peopleObj->getDefaultLanguage();
		
		$filePath         = Util::getFilePath('/templates/'.$culture.'/facebook/eventResult.jpg');
		$filePathFavorite = Util::getFilePath('/images/favorite.png');
		$fontPath         = Util::getFilePath('/../lib/pChart/Fonts');
	
		$newImg = imagecreatefromjpeg( $filePath );
		$newFav = imagecreatefrompng( $filePathFavorite );
		
		imagealphablending($newFav, false);
		imagesavealpha($newFav, true);
		
		$fileDimensions = File::getFileDimension($filePath);
			
		$width  = $fileDimensions['width'];
		$height = $fileDimensions['height'];
		
		$srcW = imagesx($newImg);
		$srcH = imagesy($newImg);
		
		$rankingId = $this->getRankingId();
		
		$colorBlack  = imagecolorallocate($newImg, 0,0,0);
		$colorWhite  = imagecolorallocate($newImg, 255, 255, 255);
		$colorRed    = imagecolorallocate($newImg, 229, 32, 36);
		$eventDate   = 'em '.$this->getEventDate('d/m/Y').' valendo pelo ranking';
		$rankingName = $this->getRanking()->getRankingName();
		$eventName   = $this->getEventName().' @ '.$this->getRankingPlace()->getPlaceName();
		$verdana     = $fontPath.'/verdana.ttf';
		$verdanaB    = $fontPath.'/verdanab.ttf';
		$verdanaI    = $fontPath.'/verdanai.ttf';
		$verdanaZ    = $fontPath.'/verdanaz.ttf';
		$tahoma      = $fontPath.'/tahoma.ttf';
		$tahomaB     = $fontPath.'/tahomabd.ttf';
	
		imagettftext($newImg, 8, 0, 15, 43, $colorBlack, $verdana, $eventName);
		imagettftext($newImg, 8, 0, 10, 265, $colorWhite, $verdana, $eventDate);
		imagettftext($newImg, 8, 0, 220, 265, $colorWhite, $verdanaB, $rankingName);
		
		$peopleIdCurrent = $peopleObj->getId();
		
		$positionY   = 0;
		$playerList  = array();
		$keyPosition = null;
		
		foreach($this->getPlayerList('result') as $key=>$eventPlayerObj){
		
			if( !$eventPlayerObj->getEnabled() )
				continue;
	
			$peopleId        = $eventPlayerObj->getPeopleId();
			$eventPosition   = $eventPlayerObj->getEventPosition();
			$rankingPosition = Util::executeOne('SELECT get_player_position('.$rankingId.', '.$peopleId.', \''.$this->getEventDate('Y-m-d').'\')');
			
			$playerList[$peopleId] = array('playerName'=>$eventPlayerObj->getPeople()->getName(),
										   'score'=>$eventPlayerObj->getScore(),
										   'ranking'=>$rankingPosition.'º',
										   'eventPosition'=>$eventPosition.'º');
			
			if( $peopleId==$peopleIdCurrent )
				$keyPosition = $eventPosition;
		}
	
		if( count($playerList) > 8 && $keyPosition!==null ){
			
			$loop = 0;
			foreach($playerList as $key=>$playerName){
				
				if( $loop < $keyPosition-2 )
					unset($playerList[$key]);
				
				if( count($playerList)==8 )
					break;
					
				$loop++;
			}
		}
		
		foreach($playerList as $peopleId=>$playerInfo){
			
			$fontFace  = $verdana;//($peopleIdCurrent==$peopleId?$verdanaZ:$verdana);
			$fontColor = ($peopleIdCurrent==$peopleId?$colorRed:$colorBlack);
			
			$eventPosition = $playerInfo['eventPosition'];
			$playerName    = truncate_text('- '.$playerInfo['playerName'], 50);
			$score         = $playerInfo['score'];
			$ranking       = $playerInfo['ranking'];
			
			$score  = Util::formatFloat($score, true, 3);
			$length1 = imagettfbbox(8, 0, $verdana, $score);
			$length1 = $length1[2]-$length1[0];
			
			$length2 = imagettfbbox(8, 0, $verdana, $ranking);
			$length2 = $length2[2]-$length2[0];
			
			$length3 = imagettfbbox(8, 0, $verdana, $eventPosition);
			$length3 = $length3[2]-$length3[0];
			
			imagettftext($newImg, 8, 0, $width-$length3-390, 85+$positionY, $fontColor, $verdana, $eventPosition);
			imagettftext($newImg, 8, 0, 37, 85+$positionY, $fontColor, $fontFace, $playerName);
			imagettftext($newImg, 8, 0, $width-$length1-74, 85+$positionY, $fontColor, $verdana, $score);
			imagettftext($newImg, 8, 0, $width-$length2-17, 85+$positionY, $fontColor, $verdana, $ranking);
			
			$positionY += 20;
		}
		
		
		header('Content-Type: image/png');
		
		if( $thumb ){
			
			$new = imagecreatetruecolor(100, 63);
			imagecopyresampled($new, $newImg, 0, 0, 0, 0, 100, 63, $srcW, $srcH);
	
			imagepng($new);
			imagedestroy($new);
		}else{
			
			imagepng($newImg);
			imagedestroy($newImg);
		}
	}
	
	public function getRanking($createNew=false){
		
		$rankingObj = parent::getRanking();
		
		if( !is_object($rankingObj) && $createNew )
			$rankingObj = new Ranking();
		
		return $rankingObj;
	}
	
	public function savePrizeConfig($request){
		
		$paidPlaces = $request->getParameter('paidPlaces');
		
		for($eventPosition=1; $eventPosition <= $paidPlaces; $eventPosition++){
			
			$prizeValue = $request->getParameter('paidPlace'.$eventPosition);
			$isPercent  = false;
			
			if( ereg('^[0-9]*(,[0-9]*)*%$', $prizeValue) ){
				
				$prizeValue = str_replace('%', '', $prizeValue);
				$isPercent  = true;
			}
			
			$eventPrizeConfigObj = EventPrizeConfigPeer::retrieveByPK($this->getId(), $eventPosition);
			$eventPrizeConfigObj->setPrizeValue(Util::formatFloat($prizeValue));
			$eventPrizeConfigObj->setIsPercent($isPercent);
			$eventPrizeConfigObj->save();
		}
				
		$this->deletePrizeConfig($paidPlaces);
	}

	public function deletePrizeConfig($paidPlaces=0){
		
		Util::executeQuery('DELETE FROM event_prize_config WHERE event_id = '.$this->getId().' AND event_position > '.$paidPlaces);
	}
	
	public function getPrizeConfigList(){
		
		$criteria = new Criteria();
		$criteria->add( EventPrizeConfigPeer::EVENT_ID, $this->getId() );
		$criteria->addAscendingOrderByColumn( EventPrizeConfigPeer::EVENT_POSITION );
		return EventPrizeConfigPeer::doSelect($criteria);
	}
	
	public function getPrizeConfig(){
		
		$prizeValueList = array();
		
		foreach($this->getPrizeConfigList() as $eventPrizeConfigObj)
			$prizeValueList[] = $eventPrizeConfigObj->getPrizeValue();
		
		return implode(';', $prizeValueList);
	}
	
	public static function confirmPresence($request){

	  	$confirmCode = $request->getParameter('confirmCode');
	
		$eventPlayerObj = EventPlayerPeer::retrieveByConfirmCode($confirmCode);
	  	
	  	if( !$confirmCode || !is_object($eventPlayerObj) )
	  		return false;
	  	
	  	MyTools::setAttribute('peopleId', $eventPlayerObj->getPeopleId());
	  	
	  	$eventPlayerObj->confirmPresence();

	  	if( $eventPlayerObj->getPeople()->isPeopleType('userSite') ) 
	  		$eventPlayerObj->getPeople()->getUserSite()->login();

	  	return $eventPlayerObj->getEvent();
	}
	
	public function getEventPlayerList($criteria=null, $con=null){
		
		$criteria = new Criteria();
		$criteria->add( EventPlayerPeer::EVENT_ID, $this->getId() );
		$criteria->addJoin( EventPlayerPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addDescendingOrderByColumn( EventPlayerPeer::ENABLED );
		$criteria->addAscendingOrderByColumn( EventPlayerPeer::EVENT_POSITION );
		$criteria->addAscendingOrderByColumn( PeoplePeer::FIRST_NAME );
		$criteria->addAscendingOrderByColumn( PeoplePeer::LAST_NAME );
		return parent::getEventPlayerList($criteria, $con);
	}
	
	public static function getXml($eventList){
		
		return Util::buildXml($eventList, 'events', 'event');
	}
	
	public static function uploadPicture($request, $fromIOS=false){
		
		$publish              = $request->getParameter('publish');
		$eventId              = $request->getParameter('eventId');
		$userSiteId           = $request->getParameter('userSiteId');
		$allowedExtensionList = array('jpg', 'jpeg', 'png');
		$maxFileSize          = (1024*1024*2);
		
		if( $fromIOS )
			$maxFileSize *= 3.5;
		
		$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
		$peopleId    = $userSiteObj->getPeopleId();
		
		MyTools::setAttribute('userSiteId', $userSiteId);
		MyTools::setAttribute('firstName', $userSiteObj->getPeople()->getFirstName());
		
		$options = array('allowedExtensionList'=>$allowedExtensionList,
						 'maxFileSize'=>$maxFileSize);
	
		try {
			
			$fileObj = File::upload( $request, 'Filedata', 'eventPhoto/event-'.$eventId, $options );
		}catch( Exception $e ){
		
			Util::forceError($e);	
		}
		
		$thumbPath = '/uploads/eventPhoto/event-'.$eventId.'/thumb';
		$fileObj->createThumbnail($thumbPath, 80, 60);
		$fileObj->resizeMax(800,600);
		
		$eventPhotoObj = new EventPhoto();
		$eventPhotoObj->setEventId($eventId);
		$eventPhotoObj->setFileId($fileObj->getId());
		$eventPhotoObj->setPeopleId($peopleId);
		$eventPhotoObj->setIsShared($publish);
		$eventPhotoObj->save();
	}
	
	public function getAllowRebuy(){
		
		$allowRebuy = parent::getAllowRebuy();
		
		if( is_null($allowRebuy) )
			$allowRebuy = true;
		
		return $allowRebuy;
	}
	
	public function getAllowAddon(){
		
		$allowAddon = parent::getAllowAddon();
		
		if( is_null($allowAddon) )
			$allowAddon = true;
		
		return $allowAddon;
	}
	
	public function getInfo(){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$rankingObj = $this->getRanking();

		$rankingType = $rankingObj->getRankingType()->getDescription();
		
		$infoList = array();
		$infoList['id']           = $this->getId();
		$infoList['eventId']      = $this->getId();
		$infoList['isConfirmed']  = $this->isConfirmed($peopleId);
		$infoList['pastDate']     = $this->isPastDate();
		$infoList['isEditable']   = $this->isEditable();
		$infoList['isFreeroll']   = $this->getIsFreeroll();
		$infoList['prizeConfig']  = $this->getPrizeConfig();
		$infoList['inviteStatus'] = $this->getInviteStatus($peopleId);
		
		$infoList['eventName']   = $this->getEventName();
		$infoList['rankingName'] = $this->getRanking()->getRankingName();
		$infoList['gameStyle']   = $this->getGameStyle()->getDescription();
		$infoList['eventPlace']  = $this->getEventPlace();
		$infoList['mapsLink']    = $this->getRankingPlace()->getMapsLink();
		$infoList['eventDate']   = $this->getEventDate('d/m/Y');
		$infoList['startTime']   = $this->getStartTime('H:i');
		$infoList['paidPlaces']  = $this->getPaidPlaces();
		$infoList['buyin']       = Util::formatFloat($this->getBuyin(), true);
		$infoList['entranceFee'] = Util::formatFloat($this->getEntranceFee(), true);
		$infoList['comments']    = $this->getComments();
		$infoList['invites']     = $this->getInvites();
		$infoList['players']     = $this->getPlayers();
		$infoList['rankingType'] = $rankingType;
		
		return $infoList;
	}
}
