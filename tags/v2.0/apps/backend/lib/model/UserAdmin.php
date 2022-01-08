<?php

/**
 * Subclasse de representação de objetos da tabela 'user_admin'.
 *
 * 
 *
 * @package lib.model
 */ 
class UserAdmin extends BaseUserAdmin
{
	
	public function toString(){
		
		return $this->getUsername();
	}
	
	public function getName(){
		
		return $this->getPeople()->getName();
	}
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isColumnModified( UserAdminPeer::VISIBLE );
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			Log::quickLog('user_admin', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
   
		} catch ( Exception $e ) {
			
		    Log::quickLogError('user_admin', $this->getPrimaryKey(), $e);
		}
    }
    
	public function delete($con = null){

		$this->setDeleted( true );
		$this->setVisible( false );
		$this->setActive( false );
		$this->save();
		
		Log::quickLogDelete('user_admin', $this->getPrimaryKey());
	}

	public function quickSave($request){

		$peopleId   = $request->getParameter('peopleId');
		$peopleName = $request->getParameter('peopleName');
		$username   = $request->getParameter('username');
		$password   = $request->getParameter('password');
		$active     = $request->getParameter('active');
		$master     = $request->getParameter('master');
		
		if( !$peopleId )			
			$peopleId = People::getQuickPeople($peopleName)->getId();
			
		if( strlen($password)!=32 )
			$password = md5($password);
		
	  	$this->setPeopleId( $peopleId );
	  	$this->setUsername( $username );
	  	$this->setPassword( $password );
	  	$this->setActive(($active?true:false));
	  	$this->setMaster(($master?true:false));
	  	$this->setEnabled(true);
	  	$this->setVisible(true);
	  	$this->save();
	}
    
    public function getPeople($con=null){
    	
    	$peopleObj = parent::getPeople($con);
    	
    	if( !is_object($peopleObj) )
    		$peopleObj = new People();
    	
    	return $peopleObj;
    }
    
    public static function getList(){
    	
    	$criteria = new Criteria();
    	$criteria->add( UserAdminPeer::ENABLED, true );
    	$criteria->add( UserAdminPeer::VISIBLE, true );
    	$criteria->add( UserAdminPeer::DELETED, false );
    	
    	$criteria->addJoin( UserAdminPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
    	return UserAdminPeer::doSelect( $criteria );
    }
    
    public function login(){
    	
		$peopleObj = $this->getPeople();
		MyTools::getUser()->setAttribute('userAdminId', $this->getId());
		MyTools::getUser()->setAttribute('peopleId', $peopleObj->getId());
		MyTools::getUser()->setAttribute('username', $this->getUsername());
		MyTools::getUser()->setAttribute('fullName', $peopleObj->getName());
		MyTools::getUser()->setAttribute('firstName', $peopleObj->getFirstName());
		MyTools::getUser()->setAttribute('lastName', $peopleObj->getLastName());
		MyTools::getUser()->setAuthenticated( true );
		MyTools::getUser()->addCredential( 'irankAdmin' );
    }
	
	public function doLogout(){
		
		self::getCurrentUser()->logout();
	}

	public function logout(){
		
		MyTools::getUser()->getAttributeHolder()->remove( 'userAdminId' );
		MyTools::getUser()->getAttributeHolder()->remove( 'peopleId' );
		MyTools::getUser()->getAttributeHolder()->remove( 'username' );
		MyTools::getUser()->getAttributeHolder()->remove( 'fullName' );
		MyTools::getUser()->getAttributeHolder()->remove( 'firstName' );
		MyTools::getUser()->getAttributeHolder()->remove( 'lastName' );
		MyTools::getUser()->removeCredential( 'irankAdmin' );
		MyTools::getUser()->setAuthenticated( false );
	}
	
	public static function getCurrentUser(){
    	
    	$userAdminId = MyTools::getAttribute('userAdminId');
    	return UserAdminPeer::retrieveByPK( $userAdminId );
    }
	
	public static function checkPermission($userAdminId, $moduleId, $action=null){
		
		return true;
	}
	
	public function resetPassword( $emailAddress ){
		
		$newPassword = String::createRandom(7, true);
		$this->setPassword( md5($newPassword) );
		$this->save();
		
		$emailContent = AuxiliarText::getContentByTagName('passwordRetrieve');
		$emailContent = utf8_encode($emailContent);
		
		$emailContent = str_replace('<peopleName>', $this->getPeople()->getFirstName(), $emailContent);
		$emailContent = str_replace('<username>', $this->getUsername(), $emailContent);
		$emailContent = str_replace('<password>', $newPassword, $emailContent);
		
		$emailSubject = 'Recuperação de senha';

		Report::sendMail( $emailSubject, array($emailAddress), $emailContent);
		
		Log::doLog('Recuperou a senha para o usuário '.$this->getUsername(), 'backend', get_class($this));
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']                = $this->getId();
		$infoList['peopleId']          = $this->getPeopleId();
		$infoList['people']            = $this->getName();
		$infoList['username']          = $this->getUsername();
		$infoList['password']          = $this->getPassword();
		$infoList['active']            = $this->getActive();
		$infoList['master']            = $this->getMaster();
//		$infoList['userGroupIdList']   = implode(',', $this->getUserGroupList('id'));
//		$infoList['specialPermIdList'] = implode(',', $this->getSpecialPermList('id'));
		$infoList['enabled']           = $this->getEnabled();
		$infoList['visible']           = $this->getVisible();
		$infoList['deleted']           = $this->getDeleted();
		$infoList['locked']            = $this->getLocked();
		$infoList['createdAt']         = $this->getCreatedAt('d/m/Y H:i:s');
		$infoList['updatedAt']         = $this->getUpdatedAt('d/m/Y H:i:s');
		
		return $infoList;
	}
}
