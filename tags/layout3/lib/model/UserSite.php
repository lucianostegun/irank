<?php

/**
 * Subclasse de representação de objetos da tabela 'user_site'.
 *
 * 
 *
 * @package lib.model
 */ 
class UserSite extends BaseUserSite
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
			if( $this->getVisible() )				
        		Log::quickLog('userSite', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        		
        	$this->postOnWall($isNew);
        } catch ( Exception $e ) {
        	
            Log::quickLogError('userSite', $this->getPrimaryKey(), $e);
        }
    }
	
	public function quickSave($request){
		
		$username        = $request->getParameter('username');
	  	$emailAddress    = $request->getParameter('emailAddress');
	  	$firstName       = $request->getParameter('firstName');
	  	$lastName        = $request->getParameter('lastName');
	  	$password        = $request->getParameter('password');
	  	$defaultLanguage = $request->getParameter('defaultLanguage');
	  	$startBankroll   = $request->getParameter('startBankroll');
	  	
  		$peopleObj = People::getQuickPeople($firstName, $lastName, 'userSite', $this->getPeopleId(), $defaultLanguage);
  		
	  	if( !$this->getActive() ){
	  		
	  		$this->setPeopleId( $peopleObj->getId() );
		  	$this->setUsername( $username );
		}
		
//		if( strlen($password)!=32 || $this->isNew() ){
//			if( !$this->getSignedSchedule() )
//				$password = 'irank';
//		  	
//		  	$this->updateHtpasswd($password);
//		}
		
	  	$peopleObj->setEmailAddress( $emailAddress );
	  	$this->setPassword( (strlen($password)==32?$password:md5($password)) );
	  	$this->setActive(true);
	  	$this->setStartBankroll(nvl(Util::formatFloat($startBankroll)));
	  	$this->save();
	  	
	  	$peopleObj->save();
	}
	
	public function saveEmailOptions($request){
		
		$receiveFriendEventConfirmNotify = $request->getParameter('receiveFriendEventConfirmNotify');
		$receiveEventReminder0           = $request->getParameter('receiveEventReminder0');
		$receiveEventReminder3           = $request->getParameter('receiveEventReminder3');
		$receiveEventReminder5           = $request->getParameter('receiveEventReminder5');
		$receiveEventCommentNotify       = $request->getParameter('receiveEventCommentNotify');
		$receiveAllResults               = $request->getParameter('receiveAllResults');
		$quickResume                     = $request->getParameter('quickResume');
		$quickResumePeriod               = $request->getParameter('quickResumePeriod');
		
		$this->setOptionValue('receiveFriendEventConfirmNotify', ($receiveFriendEventConfirmNotify?'1':'0'));
		$this->setOptionValue('receiveEventReminder0', ($receiveEventReminder0?'1':'0'));
		$this->setOptionValue('receiveEventReminder3', ($receiveEventReminder3?'1':'0'));
		$this->setOptionValue('receiveEventReminder5', ($receiveEventReminder5?'1':'0'));
		$this->setOptionValue('receiveEventCommentNotify', ($receiveEventCommentNotify?'1':'0'));
		$this->setOptionValue('receiveAllResults', ($receiveAllResults?'1':'0'));
		$this->setOptionValue('quickResume', $quickResume);
		$this->setOptionValue('quickResumePeriod', $quickResumePeriod);
	}
	
	public function saveScheduleOptions($request){
		
		$scheduleStateId   = $request->getParameter('scheduleStateId');
		$scheduleCityId    = $request->getParameter('scheduleCityId');
		$scheduleAlarmTime = $request->getParameter('scheduleAlarmTime');
		
		$this->setOptionValue('scheduleStateId', $scheduleStateId);
		$this->setOptionValue('scheduleCityId', $scheduleCityId);
		$this->setOptionValue('scheduleAlarmTime', $scheduleAlarmTime);
	}
	
	public static function getCurrentUser(){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		return UserSitePeer::retrieveByPK($userSiteId);
	}
	
	public function login($keepLogin=false){
		
        $peopleObj = $this->getPeople();
        
		if( MyTools::getUser()->isAuthenticated() ){

			MyTools::setCulture( $peopleObj->getDefaultLanguage());	
			return true;
		}
		
        
        if( $keepLogin ){

        	$userSiteId = base64_encode(serialize(array($this->getId())));
	        MyTools::setCookie('userSiteId', $userSiteId, (time()+(86400*15)), '/');
	        MyTools::getResponse()->sendHttpHeaders();
        }
        
        MyTools::setCulture( $peopleObj->getDefaultLanguage() );
        	
        MyTools::getUser()->setAttribute('userSiteId', $this->getId());
        MyTools::getUser()->setAttribute('peopleId', $peopleObj->getId());
        MyTools::getUser()->setAttribute('username', $this->getUsername());
        MyTools::getUser()->setAttribute('fullName', $peopleObj->getName());
        MyTools::getUser()->setAttribute('firstName', $peopleObj->getFirstName());
        MyTools::getUser()->setAttribute('lastName', $peopleObj->getLastName());
        MyTools::getUser()->setAuthenticated( true );
        MyTools::getUser()->addCredential('iRankSite');
        
        $this->setLastAccessDate(time());
        $this->save();
        
        $this->doLog();
	}
	
	public static function logout(){
		
		MyTools::setCookie('userSiteId', null, time());
		MyTools::setCookie('culture', null, time());
		MyTools::getUser()->getAttributeHolder()->remove('userSiteId');
		MyTools::getUser()->getAttributeHolder()->remove('peopleId');
		MyTools::getUser()->getAttributeHolder()->remove('username');
		MyTools::getUser()->getAttributeHolder()->remove('fullName');
		MyTools::getUser()->getAttributeHolder()->remove('firstName');
		MyTools::getUser()->getAttributeHolder()->remove('lastName');
		MyTools::getUser()->removeCredential('iRankSite');
		
		MyTools::getUser()->setAuthenticated( false );
		
        MyTools::getResponse()->sendHttpHeaders();
	}
	
	public function doLog(){
		
		$accessLogObj = new AccessLog();
		$accessLogObj->setUserSiteId($this->getId());
		$accessLogObj->setIpAddress($_SERVER['REMOTE_ADDR']);
		$accessLogObj->save();
		
		unset($accessLogObj);
	}
	
	public function getRankingList($criteria=null, $con=null, $count=false){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->setNoFilter(true);
		$criteria->add( RankingPeer::ENABLED, true );
		$criteria->add( RankingPeer::VISIBLE, true );
		$criteria->add( RankingPeer::DELETED, false );
		$criteria->add( RankingPlayerPeer::PEOPLE_ID, $this->getPeopleId() );
		$criteria->add( RankingPlayerPeer::ENABLED, true );
		$criteria->addAscendingOrderByColumn( RankingPeer::RANKING_NAME );
		
		if( $count )
			return RankingPeer::doCount($criteria);
		else
			return RankingPeer::doSelect($criteria);
	}
	
	public function getRankingCount(){
		
		return $this->getRankingList(null, null, true);
	}

	public function getEventCount(){
		
		return Util::executeOne('SELECT get_event_count('.$this->getPeopleId().')');
	}
	
	public function getEventPersonalCount(){
		
		return Util::executeOne('SELECT get_event_personal_count('.$this->getId().')');
	}
	
	public function sendWelcomeMail($request, $sufix=null){

		Util::getHelper('I18N');
		
		$emailContent = EmailTemplate::getContentByTagName('signWelcome'.ucfirst($sufix));
		$emailContent = str_replace('[password]', $request->getParameter('password'), $emailContent);
		$emailContent = str_replace('[username]', $this->getUsername(), $emailContent);
		$emailContent = str_replace('[peopleName]', $this->getPeople()->getFirstName(), $emailContent); 		

		$emailAddress = $this->getPeople()->getEmailAddress();
		
		Report::sendMail(__('email.subject.welcome'), $emailAddress, $emailContent);
	}

	public function resetPassword(){

		Util::getHelper('I18N');
		
		$emailContent  = EmailTemplate::getContentByTagName('passwordRecovery');
		
		$newPassword = String::createRandom(7);
		
		$emailContent = str_replace('[password]', $newPassword, $emailContent);
		$emailContent = str_replace('[username]', $this->getUsername(), $emailContent);
		$emailContent = str_replace('[peopleName]', $this->getPeople()->getFirstName(), $emailContent);
		
		$emailAddress = $this->getPeople()->getEmailAddress();
		
		$this->setPassword( md5($newPassword) );
		$this->save();
		
		$options = array();
		
		Report::sendMail(__('email.subject.passwordRecovery'), $emailAddress, $emailContent, $options);
	}
	
	public function setOptionValue($tagName, $optionValue){
		
		$userSiteOptionId  = VirtualTable::getIdByTagName('userSiteOption', $tagName);
		$userSiteOptionObj = UserSiteOptionPeer::retrieveByPK($this->getPeopleId(), $userSiteOptionId);
		$userSiteOptionObj->setOptionValue(nvl($optionValue));
		$userSiteOptionObj->save();
	}
	
	public function getOptionValue($tagName, $defaultValue=null){
		
		$userSiteOptionId  = VirtualTable::getIdByTagName('userSiteOption', $tagName);
		$userSiteOptionObj = UserSiteOptionPeer::retrieveByPK($this->getPeopleId(), $userSiteOptionId);
		
		if( $userSiteOptionObj->isNew() && !empty($defaultValue) ){
			
			$userSiteOptionObj->setOptionValue($defaultValue);
			$userSiteOptionObj->save();
		}
		
		return $userSiteOptionObj->getOptionValue();
	}
	
	public function resetOptions(){
		
		$this->setOptionValue('receiveFriendEventConfirmNotify', '1');
		$this->setOptionValue('receiveEventReminder0', '1');
		$this->setOptionValue('receiveEventReminder3', '1');
		$this->setOptionValue('receiveEventReminder5', '1');
		$this->setOptionValue('receiveEventCommentNotify', '1');
		$this->setOptionValue('receiveAllResults', '1');
		$this->setOptionValue('quickResume', 'balance');
		$this->setOptionValue('quickResumePeriod', 'always');
		$this->setOptionValue('scheduleAlarmTime', '4H');
	}
	
	public function getImagePath($create=false, $thumb=false){
		
		$imagePath = parent::getImagePath();
		
		if( (!$imagePath || !file_exists(Util::getFilePath('/uploads/profilePicture/'.$imagePath))) && $create ){
			
			$fileName  = md5(microtime().'-'.$this->getId()).'.png';
			$imagePath = Util::getFilePath('/uploads/profilePicture/'.$fileName);
			$thumbPath = Util::getFilePath('/uploads/profilePicture/thumb/'.$fileName);
			
			copy(Util::getFilePath('/images/unavailable200.png'), $imagePath);
			copy(Util::getFilePath('/images/unavailable65.png'), $thumbPath);
			
			$this->setImagePath($fileName);
			$this->save();
		}
		
		return '/uploads/profilePicture/'.($thumb?'thumb/':'').$imagePath;
	}
	
	public function getProfilePicture($width=null){
		
		$imagePath = $this->getImagePath();
		$filePath  = Util::getFilePath($imagePath);
		
		$extension       = File::getFileExtension($filePath);
		$fileDimensions  = File::getFileDimension($filePath);
		
		switch( $extension ){
			case 'jpg':
				$newImg = imagecreatefromjpeg( $filePath );
				break;
			case 'png':
				$newImg = imagecreatefrompng( $filePath );
				break;
			case 'gif':
				$newImg = imagecreatefromgif( $filePath );
				break;	
		}

		$width  = $fileDimensions['width'];
		$height = $fileDimensions['height'];
		
		$srcW = imagesx($newImg);
		$srcH = imagesy($newImg);
	
		$new = imagecreatetruecolor($width, $height);
		imagecopyresampled($new, $newImg, 0, 0, 0, 0, $width, $height, $srcW, $srcH);

		header('Content-Type: image/jpg');
		imagejpeg($new, '', 100);
				
		imagedestroy($new);
		imagedestroy($newImg);
	}
	
	public function getId($encode=false){
		
		$id = parent::getId();
		
		if( $encode ){
			
			
		}
		
		return $id;
	}
	
	public function updateEmailGroups(){
		
		foreach($this->getRankingList() as $rankingObj)
			$rankingObj->updateEmailGroup();
	}
	
	public function postOnWall($isNew){
		
		if( $isNew )
   			HomeWall::doLog('juntou-se aos jogadores do <b>iRank</b>. Seja bem vindo!', 'userSite', true, $this->getId());
	}
	
	public function getEventListResume($limit, $offset=0, $eventDate=null){
		
		$criteria = new Criteria();
		$criteria->add( EventPeer::SAVED_RESULT, false );
		if( $eventDate ) $criteria->add( EventPeer::EVENT_DATE, Util::formatDate($eventDate) );
		$criteria->add( EventPeer::EVENT_DATE_TIME, date('Y-m-d H:i:s'), Criteria::GREATER_EQUAL );
		$criteria->setOffset($offset);
		
		$eventObjList = Event::getList($criteria, $limit, $this->getId());
		$eventCount   = count($eventObjList);
		
		if( $eventCount < $limit ){
			
			$criteria = new Criteria();
			$criteria->add( EventPeer::EVENT_DATE_TIME, date('Y-m-d H:i:s'), Criteria::LESS_THAN );
			if( $eventDate ) $criteria->add( EventPeer::EVENT_DATE, Util::formatDate($eventDate) );
			$criteria->setOffset($offset);
			
			$eventObjPastList = Event::getList($criteria, $limit-$eventCount, $this->getId());
			
			$eventObjList = array_merge($eventObjList, $eventObjPastList);
		}
		
		return $eventObjList;
	}
	
	public static function getCalendarList($startDate, $endDate){
		
		$startDate = Util::formatDate($startDate);
		$endDate   = Util::formatDate($endDate);
		$peopleId  = MyTools::getAttribute('peopleId', '0');
		
		$sql = "SELECT
					event.EVENT_DATE
				FROM 
					event 
					INNER JOIN ranking ON event.RANKING_ID=ranking.ID
					INNER JOIN ranking_player ON ranking_player.RANKING_ID=ranking.ID AND ranking_player.PEOPLE_ID = $peopleId AND ranking_player.ENABLED
				WHERE 
					event.ENABLED 
					AND event.VISIBLE 
					AND NOT event.DELETED 
					AND ranking.ENABLED 
					AND ranking.VISIBLE 
					AND NOT ranking.DELETED 
					AND event.EVENT_DATE BETWEEN '$startDate' AND '$endDate' 
				GROUP BY 
					event.EVENT_DATE";

		$resultSet = Util::executeQuery($sql);
		
		$eventDateList = array();
		
		while($resultSet->next()){
			
			$eventDate = $resultSet->getTimestamp(1);
			$eventDate = date('Ymd', strtotime($eventDate));
			
			$eventDateList[] = $eventDate;
		}
		
		return array_unique($eventDateList);
	}
	
	public function updateHtpasswd($pass){
		
		$password     = Htpasswd::non_salted_sha1($pass);
		$username     = $this->getUsername();
		$htpasswdLine = $this->getHtpasswdLine();
		
		$htpasswdFilePath = Config::getConfigByName('htpasswdFilePath', true);
		$filePath         = $htpasswdFilePath;
		
		$file = file($filePath);
		
		$lineContent = $username.':'.$password.chr(10);
		
		if( !$htpasswdLine ){
			
			$htpasswdLine = count($file);
			$this->setHtpasswdLine($htpasswdLine);
		}
		
		$file[$htpasswdLine] = $lineContent;
		
		$fileContent = implode('', $file);
		
		$fp = fopen($filePath, 'w');
		fwrite($fp, $fileContent);
		fclose($fp);
	}
	
	public static function isAuthenticated(){
		
		$hasCredentials = MyTools::hasCredential('iRankSite');
		
		return (MyTools::isAuthenticated() && $hasCredentials);
	}
	
	public function buildMobileToken($deviceUDID){
		
		$tokenChars  = $this->getId();
		$tokenChars .= $deviceUDID;
		$tokenChars .= $this->getPeopleId();
		$tokenChars .= $this->getUsername();
		$tokenChars .= $this->getCreatedAt('dmYHis');
		
		$mobileToken = String::createRandom(40, true, $tokenChars);
		
		$this->setDeviceUDID($deviceUDID);
		$this->setMobileToken($mobileToken);
		$this->save();
	}

	public static function getPendingPurchases(){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		return Util::executeOne("SELECT get_pending_purchases($userSiteId)"); 
	}
	
	public function getInfo($replaceNull=false, $withBalance=true, $formatFloat=true){
		
		$infoList = array();
		$infoList['id']            = $this->getId();
		$infoList['firstName']     = $this->getPeople()->getFirstName();
		$infoList['lastName']      = $this->getPeople()->getLastName();
		$infoList['username']      = $this->getUsername();
		$infoList['emailAddress']  = $this->getPeople()->getEmailAddress();
		
		if( $withBalance ){
			
			$resumeList = People::getFullResume($this->getPeopleId(), $this->getId(), $formatFloat);
			$infoList = array_merge($infoList, $resumeList);
		}
		
		if( $replaceNull ){
			
			foreach($infoList as &$info)
				if( is_null($info) )
					$info = '';
		}
		
		return $infoList;
	}
}
