<?php

class loginActions extends sfActions
{

  public function executeIndex($request){
  	
  }

  public function executeLogin($request){
	
	$username  = $request->getParameter('username');
	$password  = $request->getParameter('password');
	$keepLogin = $request->getParameter('keepLogin');

	$statusMessage = false;
	
	if( $username && $password ){
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::ACTIVE, true );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		$criterion = $criteria->getNewCriterion( UserSitePeer::USERNAME, $username );
		$criterion->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, $username ) );
		$criteria->add($criterion);
		$criteria->add( UserSitePeer::PASSWORD, $password );
		$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );
		
		if( is_object($userSiteObj) ){
	        
	        UserSite::logout();
	        $userSiteObj->login($keepLogin);
	        
	        $options              = array();
	        $options['username']  = $userSiteObj->getUsername();
	        $options['firstName'] = $userSiteObj->getPeople()->getFirstName();
	        
	        sfConfig::set('sf_web_debug', false);
			sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

			return $this->renderText(get_partial('login/include/userMenu', $options));
		}else{
			
			$statusMessage = '<b>ACESSO NEGADO!</b> O login/senha inválidos';
		}
	}else{
		
		$statusMessage = '<b>ACESSO NEGADO!</b> O login/senha inválidos';
	}
	
	if( $statusMessage )
		Util::forceError( $statusMessage );
		
	exit;
  }

  public function executeLogout($request){
	
    UserSite::logout();
    
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
		
	return $this->renderText(get_partial('login/include/quickLogin'));
  }
}
