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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isColumnModified( PeoplePeer::VISIBLE );
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
			if( $this->getVisible() )				
        		Log::quickLog('people', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('people', $this->getPrimaryKey(), $e);
        }
    }
	
	public function toString(){
		
		return $this->getName();
	}
	
	public function cleanRecord(){
		
	}
	
	public function getName(){
		
		$firstName = $this->getFirstName();
		$lastName  = $this->getLastName();
		
		return $firstName.($lastName?' '.$lastName:'');
	}
	
	public static function getQuickPeople($firstName, $lastName=null, $peopleType, $peopleId=null, $defaultLanguage=null){

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
		$peopleObj->save();
		
		return $peopleObj;
	}
	
	public function quickSave($request){
		
	  	$firstName = $request->getParameter('firstName');
	  	$lastName  = $request->getParameter('lastName');
	  	$birthday  = $request->getParameter('birthday');
	  	$culture   = MyTools::getCulture();
	
	  	$this->setFirstName( $firstName );
	  	$this->setLastName( $lastName );
	  	$this->setBirthday( Util::formatDate($birthday) );
	  	$this->setDefaultLanguage( $culture );
	  	$this->setEnabled(true);
	  	$this->setVisible(true);
	  	$this->save();
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( PeoplePeer::ENABLED, true );
		$criteria->add( PeoplePeer::VISIBLE, true );
		$criteria->add( PeoplePeer::DELETED, false );
		
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
		
		$emailContent = AuxiliarText::getContentByTagName('rankingPlayerAdd');
		
		if( !$this->isUserSite() )
			$emailContent .= AuxiliarText::getContentByTagName('newUserInvite');
		
		$emailContent = str_replace('<peopleName>', $this->getFirstName(), $emailContent);
		$emailContent = str_replace('<rankingName>', $rankingObj->getRankingName(), $emailContent);
		$emailContent = str_replace('<createdAt>', $rankingObj->getCreatedAt('d/m/Y'), $emailContent);
		$emailContent = str_replace('<startDate>', $rankingObj->getStartDate('d/m/Y'), $emailContent);
		$emailContent = str_replace('<rankingType>', $rankingObj->getRankingType()->getDescription(), $emailContent);
		$emailContent = str_replace('<players>', $rankingObj->getPlayers(), $emailContent);
		$emailContent = str_replace('<events>', $rankingObj->getEvents(), $emailContent);
		$emailContent = str_replace('<rankingOwner>', $rankingOwner, $emailContent);
		
		$emailAddress = $this->getEmailAddress();
		Report::sendMail(__('email.subject.playerAdd'), $emailAddress, $emailContent);
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
	
	public static function getQuickResume($quickResume){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		switch($quickResume){
			case 'balance':
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
	
	public static function getResumeBalance($peopleId=null, $userSiteId=null, $formatDecimal=false){
		
		$peopleId   = ($peopleId?$peopleId:MyTools::getAttribute('peopleId'));
		$userSiteId = ($userSiteId?$userSiteId:MyTools::getAttribute('userSiteId'));
		
		$resumeList = array();
		
		$resumeList['fee']     = Util::executeOne('SELECT SUM(event.ENTRANCE_FEE) FROM event_player, event WHERE event_player.PEOPLE_ID = \''.$peopleId.'\' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID', 'float');
		$resumeList['buyin']   = Util::executeOne('SELECT SUM(event_player.BUYIN) FROM event_player, event WHERE event_player.PEOPLE_ID = \''.$peopleId.'\' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID', 'float');
		$resumeList['addon']   = Util::executeOne('SELECT SUM(event_player.ADDON) FROM event_player, event WHERE event_player.PEOPLE_ID = \''.$peopleId.'\' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID', 'float');
		$resumeList['rebuy']   = Util::executeOne('SELECT SUM(event_player.REBUY) FROM event_player, event WHERE event_player.PEOPLE_ID = \''.$peopleId.'\' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID', 'float');
		$resumeList['prize']   = Util::executeOne('SELECT SUM(event_player.PRIZE) FROM event_player, event WHERE event_player.PEOPLE_ID = \''.$peopleId.'\' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID', 'float');
		$resumeList['score']   = Util::executeOne('SELECT SUM(event_player.SCORE) FROM event_player, event WHERE event_player.PEOPLE_ID = \''.$peopleId.'\' AND event_player.ENABLED=TRUE AND event.VISIBLE=TRUE AND event.ENABLED=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID', 'float');

		$resumeList['buyin']  += Util::executeOne('SELECT SUM(event_personal.BUYIN) FROM event_personal WHERE event_personal.USER_SITE_ID = \''.$userSiteId.'\' AND event_personal.VISIBLE=TRUE AND event_personal.DELETED=FALSE', 'float');
		$resumeList['addon']  += Util::executeOne('SELECT SUM(event_personal.ADDON) FROM event_personal WHERE event_personal.USER_SITE_ID = \''.$userSiteId.'\' AND event_personal.VISIBLE=TRUE AND event_personal.DELETED=FALSE', 'float');
		$resumeList['rebuy']  += Util::executeOne('SELECT SUM(event_personal.REBUY) FROM event_personal WHERE event_personal.USER_SITE_ID = \''.$userSiteId.'\' AND event_personal.VISIBLE=TRUE AND event_personal.DELETED=FALSE', 'float');
		$resumeList['prize']  += Util::executeOne('SELECT SUM(event_personal.PRIZE) FROM event_personal WHERE event_personal.USER_SITE_ID = \''.$userSiteId.'\' AND event_personal.VISIBLE=TRUE AND event_personal.DELETED=FALSE', 'float');
		
		$bra = $resumeList['buyin']+$resumeList['rebuy']+$resumeList['addon'];
		
		$resumeList['balance'] = $resumeList['prize']-$resumeList['buyin']-$resumeList['rebuy']-$resumeList['addon']-$resumeList['fee'];
		$resumeList['average'] = ($bra?$resumeList['prize']/$bra:0);
		
		
		$resumeList['buyin'] = rand(500, 1000);
		
		if($formatDecimal)
			foreach($resumeList as &$resume)
				$resume = Util::formatFloat($resume, true);
		
		$resumeList['rankings'] = Util::executeOne('SELECT COUNT(1) FROM ranking_player, ranking WHERE ranking_player.PEOPLE_ID = \''.$peopleId.'\' AND ranking.VISIBLE=TRUE AND ranking.DELETED=FALSE AND ranking_player.RANKING_ID=ranking.ID', 'float');
		$resumeList['events']   = Util::executeOne('SELECT COUNT(1) FROM event_player, event WHERE event_player.PEOPLE_ID = \''.$peopleId.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_player.EVENT_ID=event.ID', 'float');
		$resumeList['comments'] = Util::executeOne('SELECT COUNT(1) FROM event_comment, event WHERE event_comment.PEOPLE_ID = \''.$peopleId.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_comment.EVENT_ID=event.ID', 'float');
		$resumeList['photos']   = Util::executeOne('SELECT COUNT(1) FROM event_photo, event WHERE event_photo.PEOPLE_ID = \''.$peopleId.'\' AND event.VISIBLE=TRUE AND event.DELETED=FALSE AND event.SAVED_RESULT=TRUE AND event_photo.EVENT_ID=event.ID', 'float');
		
		return $resumeList;
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']         = $this->getId();
		$infoList['firstName']  = $this->getFirstName();
		$infoList['lastName']   = $this->getLastName();
		$infoList['birthday']   = $this->getBirthday('d/m/Y');
		$infoList['enabled']    = $this->getEnabled();
		$infoList['visible']    = $this->getVisible();
		$infoList['deleted']    = $this->getDeleted();
		$infoList['locked']     = $this->getLocked();
		$infoList['createdAt']  = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']  = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
