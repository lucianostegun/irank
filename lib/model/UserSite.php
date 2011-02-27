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
	  	
  		$peopleObj = People::getQuickPeople($firstName, $lastName, 'userSite', $this->getPeopleId(), $defaultLanguage);
  		
	  	if( !$this->getActive() ){
	  		
	  		$this->setPeopleId( $peopleObj->getId() );
		  	$this->setUsername( $username );
		}
	
	  	$peopleObj->setEmailAddress( $emailAddress );
	  	$this->setPassword( (strlen($password)==32?$password:md5($password)) );
	  	$this->setActive(true);
	  	$this->save();
	  	
	  	$peopleObj->save();
	}
	
	public function saveEmailOptions($request){
		
		$receiveFriendEventConfirmNotify = $request->getParameter('receiveFriendEventConfirmNotify');
		$receiveEventReminder0           = $request->getParameter('receiveEventReminder0');
		$receiveEventReminder3           = $request->getParameter('receiveEventReminder3');
		$receiveEventReminder7           = $request->getParameter('receiveEventReminder7');
		$receiveEventCommentNotify       = $request->getParameter('receiveEventCommentNotify');
		$quickResume                     = $request->getParameter('quickResume');
		
		$this->setOptionValue('receiveFriendEventConfirmNotify', ($receiveFriendEventConfirmNotify?'1':'0'));
		$this->setOptionValue('receiveEventReminder0', ($receiveEventReminder0?'1':'0'));
		$this->setOptionValue('receiveEventReminder3', ($receiveEventReminder3?'1':'0'));
		$this->setOptionValue('receiveEventReminder7', ($receiveEventReminder7?'1':'0'));
		$this->setOptionValue('receiveEventCommentNotify', ($receiveEventCommentNotify?'1':'0'));
		$this->setOptionValue('quickResume', $quickResume);
	}
	
	public static function getCurrentUser(){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		return UserSitePeer::retrieveByPK($userSiteId);
	}
	
	public function login($keepLogin=false){
		
		if( MyTools::getUser()->isAuthenticated() )
			return true;
		
        $peopleObj = $this->getPeople();
        
        if( $keepLogin ){

        	$userSiteId = base64_encode(serialize(array($this->getId())));
	        MyTools::setCookie('userSiteId', $userSiteId, (time()+(86400*15)), '/');
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
	}
	
	public function getRankingList($criteria=null, $con=null){
		
		$criteria = new Criteria();
		$criteria->setNoFilter(true);
		$criteria->add( RankingPeer::ENABLED, true );
		$criteria->add( RankingPeer::VISIBLE, true );
		$criteria->add( RankingPeer::DELETED, false );
		$criteria->add( RankingPlayerPeer::PEOPLE_ID, $this->getPeopleId() );
		$criteria->add( RankingPlayerPeer::ENABLED, true );
		$criteria->addJoin( RankingPeer::ID, RankingPlayerPeer::RANKING_ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( RankingPeer::RANKING_NAME );
		return RankingPeer::doSelect($criteria);
	}
	
	public function sendWelcomeMail($request){

		Util::getHelper('I18N');
		
		$emailContent = AuxiliarText::getContentByTagName('signWelcome');
		$emailContent = str_replace('<password>', $request->getParameter('password'), $emailContent);
		$emailContent = str_replace('<username>', $this->getUsername(), $emailContent);
		$emailContent = str_replace('<peopleName>', $this->getPeople()->getFirstName(), $emailContent); 		

		$emailAddress = $this->getPeople()->getEmailAddress();
		
		Report::sendMail(__('email.subject.welcome'), $emailAddress, $emailContent);
	}

	public function resetPassword(){

		Util::getHelper('I18N');
		
		$emailContent  = AuxiliarText::getContentByTagName('passwordRecovery');
		
		$newPassword = String::createRandom(7);
		
		$emailContent = str_replace('<password>', $newPassword, $emailContent);
		$emailContent = str_replace('<username>', $this->getUsername(), $emailContent);
		$emailContent = str_replace('<peopleName>', $this->getPeople()->getFirstName(), $emailContent); 		
		
		$emailAddress = $this->getPeople()->getEmailAddress();
		
		$this->setPassword( md5($newPassword) );
		$this->save();
		
		$options = array();
		$options['emailTemplate'] = null;
		
		Report::sendMail(__('email.subject.passwordRecovery'), $emailAddress, $emailContent, $options);
	}
	
	public function setOptionValue($tagName, $optionValue){
		
		$userSiteOptionId  = VirtualTable::getIdByTagName('userSiteOption', $tagName);
		$userSiteOptionObj = UserSiteOptionPeer::retrieveByPK($this->getPeopleId(), $userSiteOptionId);
		$userSiteOptionObj->setOptionValue($optionValue);
		$userSiteOptionObj->save();
	}
	
	public function getOptionValue($tagName){
		
		$userSiteOptionId  = VirtualTable::getIdByTagName('userSiteOption', $tagName);
		$userSiteOptionObj = UserSiteOptionPeer::retrieveByPK($this->getPeopleId(), $userSiteOptionId);
		return $userSiteOptionObj->getOptionValue();
	}
	
	public function resetOptions(){
		
		$this->setOptionValue('receiveFriendEventConfirmNotify', '1');
		$this->setOptionValue('receiveEventReminder0', '1');
		$this->setOptionValue('receiveEventReminder3', '1');
		$this->setOptionValue('receiveEventReminder7', '1');
		$this->setOptionValue('receiveEventReminder7', '1');
		$this->setOptionValue('receiveEventCommentNotify', '1');
		$this->setOptionValue('quickResume', 'balance');
	}
	
	public function getImagePath(){
		
		$imagePath = parent::getImagePath();
		
		if( !$imagePath || !file_exists(Util::getFilePath($imagePath)) )
			$imagePath = '/images/unavailable65.png';
		
		return $imagePath;
	}
	
	public function getId($encode=false){
		
		$id = parent::getId();
		
		if( $encode ){
			
			
		}
		
		return $id;
	}
	
	public function postOnWall($isNew){
		
		if( $isNew )
   			HomeWall::doLog('juntou-se aos jogadores do <b>iRank</b>. Seja bem vindo!', 'userSite', true, $this->getId());
	}
}
