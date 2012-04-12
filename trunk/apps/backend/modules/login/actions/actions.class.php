<?php

/**
 * login actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class loginActions extends sfActions
{

  public function preExecute(){
  	
  	$actionName = $this->getContext()->getActionName();
  	if( $actionName!='logout' && $this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('iRankAdmin') )
  		return $this->redirect('home/index');
  }

  public function executeIndex($request){
  	
  }

  public function executeAccessDenied($request){
  	
  }

  public function executeLogin($request){
  	
	$username = $request->getParameter('username');
	$password = $request->getParameter('password');
	
	$errorMessage = false;
	
	if( $username && $password ){
		
		$criteria = new Criteria();
		$criteria->add( UserAdminPeer::ACTIVE, true );
		$criteria->add( UserAdminPeer::ENABLED, true );
		$criteria->add( UserAdminPeer::VISIBLE, true );
		$criteria->add( UserAdminPeer::DELETED, false );
		
		$criterion = $criteria->getNewCriterion( UserAdminPeer::USERNAME, $username );
		$criterion->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, $username ) );
		$criteria->add($criterion);
		
		$criteria->add( UserAdminPeer::PASSWORD, md5( $password ) );
		$criteria->addJoin( UserAdminPeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$userAdminObj = UserAdminPeer::doSelectOne( $criteria );
		
		if( is_object($userAdminObj) )
	        $userAdminObj->login();
		else
			$errorMessage = '<b>ACESSO NEGADO!</b> - O usuário/senha não são válidos';
	}else{
		
		$errorMessage = '<b>ACESSO NEGADO!</b> - Informe seu username/email e senha de acesso';
	}
	
	if( $errorMessage )
		Util::forceError($errorMessage);
	
	echo 'success';
	exit;
  }

  public function executeLogout($request)
  {
  	
  	UserAdmin::logout();
  	
  	return $this->redirect('login/index');
  }
}
