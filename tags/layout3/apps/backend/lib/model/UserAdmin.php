<?php

/**
 * Subclasse de representação de objetos da tabela 'user_admin'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class UserAdmin extends BaseUserAdmin
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('user_admin', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('user_admin', $this->getPrimaryKey(), $e);
        }
    }
	
	public function quickSave($request, $fromUser=false){
		
		$peopleId     = $request->getParameter('peopleId');
		$emailAddress = $request->getParameter('emailAddress');
		$clubId       = $request->getParameter('clubId');
		$username     = $request->getParameter('username');
		$password     = $request->getParameter('password');
		$newPassword  = $request->getParameter('newPassword');
		$master       = $request->getParameter('master');
		$active       = $request->getParameter('active');
		
		$password = ($newPassword && $newPassword!='******'?md5($newPassword):$this->getPassword());
		
		if( $fromUser===false ){
			
			$this->setPeopleId($peopleId);
			$this->setClubId(nvl($clubId));
			$this->setMaster(($master?true:false));
			$this->setActive(($active?true:false));
			$this->setEnabled(true);
			$this->setVisible(true);
			$this->setDeleted(false);
		}
		
		$this->setUsername($username);
		$this->setPassword($password);
		$this->save();
		
		$peopleObj = $this->getPeople();
		$peopleObj->setEmailAddress($emailAddress);
		$peopleObj->save();
	}
	
	public static function getList(){
		
		$criteria = new Criteria();
		$criteria->add( UserAdminPeer::ENABLED, true );
		$criteria->add( UserAdminPeer::VISIBLE, true );
		$criteria->add( UserAdminPeer::DELETED, false );
		
		return UserAdminPeer::doSelect($criteria);
	}
	
	public function getPeople($con=null){
		
		$peopleObj = parent::getPeople($con);
		
		if( !is_object($peopleObj) )
			$peopleObj = new People();
			
		return $peopleObj;
	}
	
	public function getClub($con=null){
		
		$clubObj = parent::getClub($con);
		
		if( !is_object($clubObj) )
			$clubObj = new Club();
			
		return $clubObj;
	}
	
	public function login($keepLogin=false){
		
		MyTools::getUser()->setCulture('pt_BR');
	  	
		$peopleObj = $this->getPeople();
		MyTools::getUser()->setAttribute('userAdminId', $this->getId());
		MyTools::getUser()->setAttribute('peopleId', $peopleObj->getId());
		MyTools::getUser()->setAttribute('username', $this->getUsername());
		MyTools::getUser()->setAttribute('fullName', $peopleObj->getName());
		MyTools::getUser()->setAttribute('firstName', $peopleObj->getFirstName());
		MyTools::getUser()->setAttribute('clubId', $this->getClubId());
		
		MyTools::getUser()->setAuthenticated(true);
		
		if( $this->getMaster() || !$this->getClubId() )
			MyTools::getUser()->addCredential('iRankAdmin');
		else
			MyTools::getUser()->addCredential('iRankClub');
		
		$this->setLastAccessDate(date('Y-m-d H:i:s'));
		$this->save();
		
		if( $keepLogin ){

        	$userAdminId = base64_encode(serialize(array($this->getId())));
	        MyTools::setCookie('userAdminId', $userAdminId, (time()+(86400*15)), '/');
	        MyTools::getResponse()->sendHttpHeaders();
        }
		
		$this->doLog();
	}

	public static function logout(){
		
		MyTools::setCookie('userAdminId', null, time());
		MyTools::getUser()->getAttributeHolder()->remove('userAdminId');
		MyTools::getUser()->getAttributeHolder()->remove('peopleId');
		MyTools::getUser()->getAttributeHolder()->remove('username');
		MyTools::getUser()->getAttributeHolder()->remove('fullName');
		MyTools::getUser()->getAttributeHolder()->remove('firstName');
		MyTools::getUser()->getAttributeHolder()->remove('clubId');
		MyTools::getUser()->removeCredential('iRankAdmin');
		MyTools::getUser()->removeCredential('iRankClub');
		MyTools::getUser()->setAuthenticated(false);
		
		// Limpa todas as configurações salvas na sessão
		MyTools::getUser()->getAttributeHolder()->removeNamespace('iRankSettings');
	}
	
	public function doLog(){
		
		$accessAdminLogObj = new AccessAdminLog();
		$accessAdminLogObj->setUserAdminId($this->getId());
		$accessAdminLogObj->setIpAddress($_SERVER['REMOTE_ADDR']);
		$accessAdminLogObj->save();
		
		unset($accessAdminLogObj);
	}
	
	public function toString(){
		
		return $this->getUsername();
	}
	
	public static function getCurrentUser(){
		
		$userAdminId = MyTools::getAttribute('userAdminId');
		
		return UserAdminPeer::retrieveByPK($userAdminId);
	}
	
	public function getSettings($tagName){
		
		return UserAdminSettingsPeer::retrieveByPK($this->getId(), $tagName)->getSettingsValue();
	}
}
