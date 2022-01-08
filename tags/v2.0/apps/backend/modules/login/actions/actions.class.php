<?php

class loginActions extends sfActions
{

  public function executeIndex($request){
	
	if ( $this->getContext()->getUser()->isAuthenticated() && $this->getUser()->hasCredential('irankAdmin'))
	  return $this->redirect( 'home/index' );
	
	$pathInfo = $this->getRequest()->getPathInfo();
	$triedUrl = $this->getRequest()->getUri();
	$this->triedUrl = ($pathInfo=='/'?'':$triedUrl);
    
	$this->setLayout('clean');
  }
  
  public function executeLogin($request){

	$username = $request->getParameter('username');
	$password = $request->getParameter('password');
	
	$statusMessage = false;
	
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
			throw new Exception('<b>ACESSO NEGADO!</b> - O usuário/senha não são válidos');
	}else{
		
		throw new Exception('<b>ACESSO NEGADO!</b> - Informe seu username/email e senha de acesso');
	}
	
	exit;
  }

  public function executeLogout(){
    
    UserAdmin::doLogout();
   
    return $this->redirect('login/index');
  }
  
  public function executeIsLogged(){
  	
  	$isAuthenticated = $this->getUser()->isAuthenticated();
  	echo ($isAuthenticated?'1':'0');
  	exit;
  }
  
  public function executePasswordRetrieveForm(){
  	
	$this->setLayout(false);
  }

  public function handleErrorRetrievePassword(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeRetrievePassword($request){
	
	$username     = $request->getParameter( 'username' );
	$emailAddress = $this->emailAddress = $request->getParameter( 'emailAddress' );
	
	$userAdminObj = UserAdminPeer::retrieveByUsername($username);
	$userAdminObj->resetPassword($emailAddress);
	
	sfConfig::set('sf_web_debug', false);
	$this->setLayout(false);
  }
}
