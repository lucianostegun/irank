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
	
	public function quickSave($request, $fromUser=false){
		
		$peopleId    = $request->getParameter('peopleId');
		$clubId      = $request->getParameter('clubId');
		$username    = $request->getParameter('username');
		$password    = $request->getParameter('password');
		$newPassword = $request->getParameter('newPassword');
		$master      = $request->getParameter('master');
		$active      = $request->getParameter('active');
		
		$password = ($newPassword && $newPassword!='******'?md5($newPassword):$this->getPassword());
		
		if( $fromUser===false ){
			
			$this->setPeopleId($peopleId);
			$this->setClubId(($clubId?$clubId:null));
			$this->setMaster(($master?true:false));
			$this->setActive(($active?true:false));
			$this->setEnabled(true);
			$this->setVisible(true);
			$this->setDeleted(false);
		}
		
		$this->setUsername($username);
		$this->setPassword($password);
		$this->save();
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
	
	public function login(){
		
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
	}

	public static function logout(){
		
		MyTools::getUser()->getAttributeHolder()->remove('userAdminId');
		MyTools::getUser()->getAttributeHolder()->remove('peopleId');
		MyTools::getUser()->getAttributeHolder()->remove('username');
		MyTools::getUser()->getAttributeHolder()->remove('fullName');
		MyTools::getUser()->getAttributeHolder()->remove('firstName');
		MyTools::getUser()->getAttributeHolder()->remove('clubId');
		MyTools::getUser()->removeCredential('iRankAdmin');
		MyTools::getUser()->removeCredential('iRankClub');
		MyTools::getUser()->setAuthenticated(false);
	}
	
	public function toString(){
		
		return $this->getUsername();
	}
	
	public static function getCurrentUser(){
		
		$userAdminId = MyTools::getAttribute('userAdminId');
		
		return UserAdminPeer::retrieveByPK($userAdminId);
	}
}
