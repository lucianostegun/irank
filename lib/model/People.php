<?php

/**
 * Subclasse de representação de objetos da tabela 'people'.
 *
 * 
 *
 * @package lib.model
 */ 
class People extends BasePeople
{
	
	public function cleanRecord(){
		
	}
	
	public function getName(){
		
		$firstName = $this->getFirstName();
		$lastName  = $this->getLastName();
		
		return $firstName.($lastName?' '.$lastName:'');
	}
	
	public function setName($fullName){
		
 		$firstName = preg_replace('/ .*$/', '', $fullName);
	    $lastName  = preg_replace('/^'.$firstName.' /', '', $fullName);
	    
	    $this->setFirstName($firstName);
	    $this->setLastName($lastName);
	    $this->setFullName($fullName);
	}
	
	public function isMe(){
		
		return ($this->getId()==MyTools::getAttribute('peopleId'));
	}
	
	public function getShareName(){
		
		$firstName = trim($this->getFirstName());
		$lastName  = trim($this->getLastName());
		$firstName = preg_replace('/^([^ ]*) .*/i', '\1', $firstName);
		$lastName  = preg_replace('/^([a-z]).*/i', '\1', $lastName);
		
		return $firstName.($lastName?' '.$lastName.'.':'');
	}
	
	public static function getQuickPeople($firstName, $lastName=null, $peopleType, $peopleId=null, $defaultLanguage=null, $con=null){

		$peopleTypeId    = VirtualTable::getIdByTagName('peopleType', $peopleType);
		$culture         = MyTools::getCulture();
		$defaultLanguage = ($defaultLanguage?$defaultLanguage:$culture);

		if( $peopleId )
			$peopleObj = PeoplePeer::retrieveByPK($peopleId);
		else
			$peopleObj = new People();

		$peopleObj->setPeopleTypeId($peopleTypeId);
		$peopleObj->setFirstName($firstName);
		$peopleObj->setLastName($lastName);
		$peopleObj->setFullName($firstName.($lastName?' '.$lastName:''));
	  	$peopleObj->setDefaultLanguage( $defaultLanguage );
		$peopleObj->setEnabled(true);
		$peopleObj->setVisible(true);
		$peopleObj->save($con);
		
		return $peopleObj;
	}
	
	public function quickSave($request){
		
	  	$firstName = $request->getParameter('firstName');
	  	$lastName  = $request->getParameter('lastName');
	  	$birthday  = $request->getParameter('birthday');
		$phoneNumber = $request->getParameter('phoneNumber');
	  	
	  	$culture = 'pt_BR';
	
	  	$this->setFirstName( $firstName );
	  	$this->setLastName( $lastName );
	  	$this->setBirthday( Util::formatDate($birthday) );
	  	$this->setDefaultLanguage( $culture );
	  	$this->setPhoneNumber( nvl($phoneNumber) );
	  	$this->setEnabled(true);
	  	$this->setVisible(true);
	  	$this->save();
	}

	public function quickSaveAdmin($request){
		
	  	$firstName    = $request->getParameter('firstName');
	  	$lastName     = $request->getParameter('lastName');
	  	$nickname     = $request->getParameter('nickname');
	  	$peopleName   = $request->getParameter('peopleName');
	  	$birthday     = $request->getParameter('birthday');
	  	$emailAddress = $request->getParameter('emailAddress');
		$phoneNumber  = $request->getParameter('phoneNumber');
		
		if( $peopleName )
		  	$this->setName( $peopleName );
	  	else{
	  		
		  	$this->setFirstName( $firstName );
		  	$this->setLastName( $lastName );
	  	}
	  	
	  	$this->setNickname( nvl($nickname) );
	  	$this->setEmailAddress( nvl($emailAddress) );
	  	$this->setBirthday( Util::formatDate($birthday) );
	  	$this->setPhoneNumber( nvl($phoneNumber) );
	  	$this->save();
	}

	public function quickSaveClub($request){
		
	  	$peopleName   = $request->getParameter('peopleName');
	  	$emailAddress = $request->getParameter('emailAddress');
	  	$phoneNumber  = $request->getParameter('phoneNumber');
	  	
	  	$this->setName( $peopleName );
	  	$this->setEmailAddress( nvl($emailAddress) );
	  	$this->setPhoneNumber( nvl($phoneNumber) );
	  	$this->save();
	}
	
	public static function getList($criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		$criteria->add( PeoplePeer::ENABLED, true );
		$criteria->add( PeoplePeer::VISIBLE, true );
		$criteria->add( PeoplePeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME, false );
		
		return PeoplePeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect( $defaultValue=false, $returnArray=false ){
		
		$peopleObjList = self::getList();
		
		$optionList = array();
		$optionList[''] = __('select');
		foreach( $peopleObjList as $peopleObj )			
			$optionList[$peopleObj->getId()] = $peopleObj->getFirstName();
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public function isPeopleType($tagName){
		
		return $this->getVirtualTable()->getTagName()==$tagName;
	}
	
	public function sendPlayerNotify($rankingObj){

		Util::getHelper('I18N');
		
		if( $rankingObj->getUserSite()->getPeopleId()==$this->getId() )
			return true;

		$rankingOwner = $rankingObj->getUserSite()->getPeople()->getFullName();
		
		$templateName = 'rankingPlayerAdd';
		$emailContent = EmailTemplate::getContentByTagName($templateName);
		
		if( !$this->isUserSite() )
			$emailContent .= EmailTemplate::getContentByTagName('newUserInvite');
		
		$emailContent = str_replace('[peopleName]', $this->getFirstName(), $emailContent);
		$emailContent = str_replace('[rankingName]', $rankingObj->getRankingName(), $emailContent);
		$emailContent = str_replace('[createdAt]', $rankingObj->getCreatedAt('d/m/Y'), $emailContent);
		$emailContent = str_replace('[startDate]', $rankingObj->getStartDate('d/m/Y'), $emailContent);
		$emailContent = str_replace('[rankingType]', $rankingObj->getRankingType()->getDescription(), $emailContent);
		$emailContent = str_replace('[players]', $rankingObj->getPlayers(), $emailContent);
		$emailContent = str_replace('[events]', $rankingObj->getEvents(), $emailContent);
		$emailContent = str_replace('[rankingOwner]', $rankingOwner, $emailContent);
		
		$emailAddress = $this->getEmailAddress();
		
		$optionList = array('templateName'=>$templateName);
		
		if( $emailAddress )
			Report::sendMail(__('email.subject.playerAdd'), $emailAddress, $emailContent, $optionList);
	}
	
	public function isUserSite(){
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::ACTIVE, true );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		$criteria->add( UserSitePeer::PEOPLE_ID, $this->getId() );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );
		
		return is_object($userSiteObj);
	}
	
	public function getOptionValue($userSiteOptionId, $defaultValue=null){
		
		$userSiteOptionObj = UserSiteOptionPeer::retrieveByPK($this->getId(), $userSiteOptionId);
		
		$optionValue = $userSiteOptionObj->getOptionValue();
		
		if( $optionValue===null && $defaultValue!==null )
			return $defaultValue;
		else
			return $optionValue;
	}
	
	public static function getCurrentPeople(){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		return PeoplePeer::retrieveByPK($peopleId);
	}
	
	public function getUserSite(){
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::PEOPLE_ID, $this->getId() );
		$criteria->add( UserSitePeer::ACTIVE, true );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		return UserSitePeer::doSelectOne( $criteria );
	}
	
	public static function getQuickResume($quickResume, $peopleId=null){
		
		if( is_null($peopleId) )
			$peopleId = MyTools::getAttribute('peopleId');
		
		switch($quickResume){
			case 'balance':
			default:
				$sql = 'SELECT get_player_balance('.$peopleId.')';
				break;
			case 'profit':
				$sql = 'SELECT get_player_profit('.$peopleId.')';
				break;
			case 'score':
				$sql = 'SELECT get_player_score('.$peopleId.')';
				break;
			case 'paid':
				$sql = 'SELECT get_player_bra('.$peopleId.')';
				break;
			case 'average':
				$sql = 'SELECT get_player_average('.$peopleId.')';
				break;
		}
		
		return Util::executeOne($sql, 'float');
	}
	
	public function getUserSiteId(){
		
		return $this->getUserSite()->getId();
	}
	
	public static function getFullResume($peopleId=null, $userSiteId=null, $formatDecimal=false, $options=array()){
		
		$year = (array_key_exists('year', $options)?$options['year']:null);
		
		$peopleId   = ($peopleId?$peopleId:MyTools::getAttribute('peopleId'));
		$userSiteId = ($userSiteId?$userSiteId:MyTools::getAttribute('userSiteId'));
		
		$resumeList = array();
		
		$resumeList['startBankroll'] = Util::executeOne("SELECT COALESCE(start_bankroll, 0) FROM user_site WHERE id = '$userSiteId' OR people_id = '$peopleId'", 'float');
		
		$whereYear = ($year?" AND event_date BETWEEN '$year-01-01' AND '$year-12-31'":"AND event.EVENT_DATE >= get_resume_start_date($peopleId)");
		$resumeList['fee']   = Util::executeOne("SELECT SUM(event.ENTRANCE_FEE) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = '$peopleId' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE=TRUE AND ranking.DELETED=FALSE $whereYear", 'float');
		$resumeList['buyin'] = Util::executeOne("SELECT SUM(event_player.BUYIN) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = '$peopleId' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE=TRUE AND ranking.DELETED=FALSE $whereYear", 'float');
		$resumeList['addon'] = Util::executeOne("SELECT SUM(event_player.ADDON) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = '$peopleId' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE=TRUE AND ranking.DELETED=FALSE $whereYear", 'float');
		$resumeList['rebuy'] = Util::executeOne("SELECT SUM(event_player.REBUY) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = '$peopleId' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE=TRUE AND ranking.DELETED=FALSE $whereYear", 'float');
		$resumeList['prize'] = Util::executeOne("SELECT SUM(event_player.PRIZE) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = '$peopleId' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE=TRUE AND ranking.DELETED=FALSE $whereYear", 'float');
		$resumeList['score'] = Util::executeOne("SELECT SUM(event_player.SCORE) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = '$peopleId' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE=TRUE AND ranking.DELETED=FALSE $whereYear", 'float');

		$whereYear = ($year?" AND event_date BETWEEN '$year-01-01' AND '$year-12-31'":"AND event_personal.EVENT_DATE > get_resume_start_date($peopleId)");
		$resumeList['buyin'] += Util::executeOne("SELECT SUM(event_personal.BUYIN) FROM event_personal WHERE event_personal.USER_SITE_ID = '$userSiteId' AND event_personal.VISIBLE=TRUE AND event_personal.DELETED=FALSE $whereYear", 'float');
		$resumeList['addon'] += Util::executeOne("SELECT SUM(event_personal.ADDON) FROM event_personal WHERE event_personal.USER_SITE_ID = '$userSiteId' AND event_personal.VISIBLE=TRUE AND event_personal.DELETED=FALSE $whereYear", 'float');
		$resumeList['rebuy'] += Util::executeOne("SELECT SUM(event_personal.REBUY) FROM event_personal WHERE event_personal.USER_SITE_ID = '$userSiteId' AND event_personal.VISIBLE=TRUE AND event_personal.DELETED=FALSE $whereYear", 'float');
		$resumeList['prize'] += Util::executeOne("SELECT SUM(event_personal.PRIZE) FROM event_personal WHERE event_personal.USER_SITE_ID = '$userSiteId' AND event_personal.VISIBLE=TRUE AND event_personal.DELETED=FALSE $whereYear", 'float');
		
		
		$bra = $resumeList['buyin']+$resumeList['rebuy']+$resumeList['addon'];
		
		$resumeList['balance'] = $resumeList['startBankroll']+$resumeList['prize']-$resumeList['buyin']-$resumeList['rebuy']-$resumeList['addon']-$resumeList['fee'];
		$resumeList['average'] = ($bra?$resumeList['prize']/$bra:0);
		
		if($formatDecimal)
			foreach($resumeList as &$resume)
				$resume = Util::formatFloat($resume, true);
		
		$whereYear = ($year?" AND event_date BETWEEN '$year-01-01' AND '$year-12-31'":"");
		
		$resumeList['rankings']       = Util::executeOne("SELECT COUNT(1) FROM ranking_player, ranking WHERE ranking_player.PEOPLE_ID = '$peopleId' AND ranking.VISIBLE=TRUE AND ranking.DELETED=FALSE AND ranking_player.RANKING_ID=ranking.ID", 'float');
		$resumeList['events']         = Util::executeOne("SELECT COUNT(1) FROM event_player, event, ranking WHERE event_player.PEOPLE_ID = '$peopleId' AND event_player.ENABLED AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID AND event.RANKING_ID=ranking.ID AND ranking.VISIBLE=TRUE AND ranking.DELETED=FALSE $whereYear", 'float');
		$resumeList['eventsPersonal'] = Util::executeOne("SELECT COUNT(1) FROM event_personal WHERE event_personal.USER_SITE_ID = '$userSiteId' AND event_personal.VISIBLE=TRUE AND event_personal.DELETED=FALSE $whereYear", 'float');
		$resumeList['eventsLive']     = Util::executeOne("SELECT COUNT(1) FROM event_live_player, event_live, ranking_live WHERE event_live_player.PEOPLE_ID = '$peopleId' AND event_live.VISIBLE=TRUE AND event_live.DELETED=FALSE AND event_live.SAVED_RESULT=TRUE AND event_live_player.EVENT_LIVE_ID=event_live.ID AND event_live.RANKING_LIVE_ID=ranking_live.ID AND ranking_live.VISIBLE=TRUE AND ranking_live.DELETED=FALSE $whereYear", 'float');
		$resumeList['comments']       = Util::executeOne("SELECT COUNT(1) FROM event_comment, event WHERE event_comment.PEOPLE_ID = '$peopleId' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_comment.EVENT_ID=event.ID", 'float');
		$resumeList['photos']         = Util::executeOne("SELECT COUNT(1) FROM event_photo, event WHERE event_photo.PEOPLE_ID = '$peopleId' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_photo.EVENT_ID=event.ID", 'float');
		
		return $resumeList;
	}
	
	public function getEvents($rankingId, $eventDateTime=null){
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::RANKING_ID, $rankingId );
		$criteria->add( EventPeer::VISIBLE, true);
		$criteria->add( EventPeer::ENABLED, true );
		$criteria->add( EventPeer::DELETED, false );
		$criteria->add( EventPeer::SAVED_RESULT, true );
		
		if( $eventDateTime )
			$criteria->add( EventPeer::EVENT_DATE_TIME, Util::formatDateTime($eventDateTime), Criteria::LESS_EQUAL );
			
		$criteria->add( EventPlayerPeer::PEOPLE_ID, $this->getId() );
		$criteria->add( EventPlayerPeer::ENABLED, true );
		$criteria->addJoin( EventPlayerPeer::EVENT_ID, EventPeer::ID, Criteria::INNER_JOIN );
		$criteria->addJoin( EventPeer::RANKING_ID, RankingPeer::ID, Criteria::INNER_JOIN );
		
		return EventPlayerPeer::doCount($criteria);
	}
	
	public static function getPendingInviteList($returnIdList=false, $eventType){
		
		$peopleId = MyTools::getAttribute('peopleId');
		$eventType = ($eventType=='home'?'':'_'.$eventType);
		
		if( $returnIdList ){
		
			$eventIdList = Util::executeOne("SELECT get_pending_event{$eventType}_invite_list($peopleId)", 'string');
			if( empty($eventIdList) )
				return array();
			
			return explode(',', $eventIdList);
		}else 
			return Util::executeOne("SELECT get_pending_event{$eventType}_invites($peopleId)"); 
	}

	public function getPeopleType(){
		
		return $this->getVirtualTable();
	}
	
	public function isMyPlayer(){
		
		if( !$this->getVisible()  && !$this->getEnabled() && !$this->getDeleted() )
			return true;
		
		$iRankAdmin = MyTools::hasCredential('iRankAdmin');

		if( $iRankAdmin )
			return true;

		$clubId = MyTools::getAttribute('clubId');
			
		$criteria = new Criteria();
		$criteria->add( ClubPlayer::PEOPLE_ID, $this->getId() );
		$criteria->add( ClubPlayer::CLUB_ID, $clubId );
		$count = ClubPlayerPeer::doCount( $criteria );
		
		if( $count==0 )
			return false;
		
		return true;
	}
	
	public function addToClub($clubId){
		
		$clubPlayerObj = ClubPlayerPeer::retrieveByPK($clubId, $this->getId());
		$clubPlayerObj->save();
	}
	
	public function getLastCashGame($clubId){
		
		$lastCashGame = Util::executeOne('SELECT get_player_last_cash_game('.$this->getId().', '.($clubId?$clubId:'NULL').')', 'string');
		return ($lastCashGame?$lastCashGame:'(primeira vez)');
	}
	
	public function toString(){
		
		return $this->getName();
	}
	
	public function saveEmailOption($request, $inverse=false){
		
		$emailAddress = $this->getEmailAddress();
		
		$criteria = new Criteria();
		$criteria->add( EmailTemplatePeer::IS_OPTION, true );
		$emailTemplateObjList = EmailTemplate::getList($criteria);
	
		try{
			
			$con = Propel::getConnection();
			$con->begin();
			
			foreach($emailTemplateObjList as $emailTemplateObj){
				
				$checked = $request->getParameter('emailOption-'.$emailTemplateObj->getId());
				
				if( $inverse )
					$checked = !$checked;
				
				$emailOptionObj = EmailOptionPeer::retrieveByPK($emailAddress, $emailTemplateObj->getId());
				$emailOptionObj->setLockSend(($checked?true:false));
				$emailOptionObj->save($con);
			}
			
			$con->commit();
		}catch(Exception $e){
			
			$con->rollback();
			throw $e;
		}
	}

	public function saveSmsOption($request, $inverse=false){
		
		$smsTemplateObjList = SmsTemplate::getList();
	
		try{
			
			$con = Propel::getConnection();
			$con->begin();
			
			foreach($smsTemplateObjList as $smsTemplateObj){
				
				$checked = $request->getParameter('smsOption-'.$smsTemplateObj->getId());
				
				if( $inverse )
					$checked = !$checked;
				
				$smsOptionObj = SmsOptionPeer::retrieveByPK($this->getId(), $smsTemplateObj->getId());
				$smsOptionObj->setLockSend(($checked?true:false));
				$smsOptionObj->save($con);
			}
			
			$con->commit();
		}catch(Exception $e){
			
			$con->rollback();
			throw $e;
		}
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']           = $this->getId();
		$infoList['firstName']    = $this->getFirstName();
		$infoList['lastName']     = $this->getLastName();
		$infoList['fullName']     = $this->getFullName();
		$infoList['emailAddress'] = $this->getEmailAddress();
		$infoList['phoneNumber']  = $this->getPhoneNumber();
		$infoList['birthday']     = $this->getBirthday('d/m/Y');
		$infoList['enabled']      = $this->getEnabled();
		$infoList['visible']      = $this->getVisible();
		$infoList['deleted']      = $this->getDeleted();
		$infoList['locked']       = $this->getLocked();
		$infoList['createdAt']    = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']    = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
