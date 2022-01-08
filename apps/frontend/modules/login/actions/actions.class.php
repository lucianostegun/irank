<?php

class loginActions extends sfActions
{

  public function executeIndex($request){
  	
  	$this->passwordRecovery = false;
  }

  public function executeLogin($request){
	
	$username  = $request->getParameter('username');
	$password  = $request->getParameter('password');
	$keepLogin = $request->getParameter('keepLogin');

	Util::getHelper('I18N');

	$statusMessage = false;
	
	if( $username && $password ){
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::ACTIVE, true );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		$criterion = $criteria->getNewCriterion( UserSitePeer::USERNAME, $username, Criteria::ILIKE );
		$criterion->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, $username, Criteria::ILIKE ) );
		$criteria->add($criterion);
		
		if( strlen($password)!=30 )
			$password = md5($password);
			
		if( !Util::isDebug() )
			$criteria->add( UserSitePeer::PASSWORD, $password, Criteria::ILIKE );
			
		$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );
		
		if( is_object($userSiteObj) ){
			
	        UserSite::logout();
	        $userSiteObj->login($keepLogin);

	        
	        $options                    = array();
	        $options['username']        = $userSiteObj->getUsername();
	        $options['firstName']       = $userSiteObj->getPeople()->getFirstName();
	        $options['isAuthenticated'] = true;
	        $options['innerMenu']       = false;
	        $options['innerObj']        = false;

	        sfConfig::set('sf_web_debug', false);
			sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

			return $this->renderText(get_partial('home/include/leftMenu').get_partial('home/include/quickResume', $options));
		}else{
			
			$statusMessage = __('login.errorMessage');
		}
	}else{
		
		$statusMessage = __('login.errorMessage');
	}
	
	if( $statusMessage )
		Util::forceError( $statusMessage );
		
	exit;
  }

  public function executeLogout($request){
	
    UserSite::logout();
    
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
		
	return $this->redirect('home/index');
  }

  public function executePasswordRecovery($request){
	
	$this->passwordRecovery = true;
	$this->setTemplate('index');
  }

  public function handleErrorResetPassword(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeResetPassword($request){

	$emailAddress = $request->getParameter('emailAddress');
	
	$criteria = new Criteria();
	$criteria->add( PeoplePeer::EMAIL_ADDRESS, $emailAddress, Criteria::ILIKE );
	$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
	$criteria->add( UserSitePeer::ACTIVE, true );
	$userSiteObj = UserSitePeer::doSelectOne( $criteria );
	
	$userSiteObj->resetPassword();
	
	exit;
  }
}
