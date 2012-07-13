<?php

/**
 * login actions.
 *
 * @package    sf_sandbox
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class loginActions extends sfActions
{

  public function preExecute()
  {
  	
  	$language = $this->getRequestParameter('language');
  	$culture  = Util::getConvertCulture($language);
  	
  	MyTools::setCulture($culture);
  }

  public function executeDoLogin($request)
  {
  	
	$username   = $request->getParameter('username');
	$password   = $request->getParameter('password');
	$deviceUDID = $request->getParameter('deviceUDID');
	
	if( $username && $password && $deviceUDID ){
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::ACTIVE, true );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		$criterion = $criteria->getNewCriterion( UserSitePeer::USERNAME, $username, Criteria::ILIKE );
		$criterion->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, $username, Criteria::ILIKE ) );
		$criteria->add($criterion);
		
		if( !Util::isDebug() )
			$criteria->add( UserSitePeer::PASSWORD, md5($password), Criteria::ILIKE );
			
		$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );
		$userSiteObj->buildMobileToken($deviceUDID);
		
		if( is_object($userSiteObj) ){
			
			$infoList = $userSiteObj->getInfo(true);
			$infoList['mobileToken']  = $userSiteObj->getMobileToken();
			
			echo Util::parseInfo($infoList);
		}else
			echo 'denied';
	}else{
		
		echo 'error';
	}
	
	exit;
  }
  
  public function executeGetInfo($request)
  {

	$userSiteId = $request->getParameter('userSiteId');
	
	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	echo Util::parseInfo($userSiteObj->getInfo(true));
		
	exit;
  }
  
  public function executeSave($request){
  	
  	$xmlString = $request->getParameter('userSiteXml');

	$xmlString = simplexml_load_string( $xmlString );
	$validate  = new DOMDocument;
    $validate->loadXML($xmlString->asXml());
    
    $username     = null;
    $emailAddress = null;
    $firstName    = null;
    $lastName     = null;
    $password     = null;
    
	foreach( $xmlString->userSite as $userSiteNode ){
		
		foreach( $userSiteNode as $key=>$nodeValue )
			$$key = (string)$nodeValue;
	}

	Util::getHelper('I18N');

	if( !UserSitePeer::uniqueEmailAddress($emailAddress) )
		$errorMessage = __('form.error.takenEmail');
	
	if( !UserSitePeer::uniqueUsername($username) )
		$errorMessage = __('form.error.takenUsername');
		
	if( $errorMessage )
		Util::forceError(utf8_decode($errorMessage), true);
		
		
	$userSiteObj = new UserSite();
	$peopleObj   = PeoplePeer::retrieveByEmailAddress($emailAddress);
	
	if( is_object($peopleObj) && $peopleObj->isPeopleType('rankingPlayer') )
		$userSiteObj->setPeopleId($peopleObj->getId());
		
	$request->setParameter('username', $username);
  	$request->setParameter('emailAddress', $emailAddress);
  	$request->setParameter('firstName', $firstName);
  	$request->setParameter('lastName', $lastName);
  	$request->setParameter('password', $password);
  	$request->setParameter('defaultLanguage', 'pt_BR');
  	$userSiteObj->quickSave($request);

	$userSiteObj->resetOptions();
//	$userSiteObj->sendWelcomeMail($request, 'app');
	$userSiteObj->getImagePath(true);
		
	echo 'saveSuccess';
	exit;
  }
  
  public function executeRecoveryPassword($request){
  	
	$username = $request->getParameter('username');
	
	$criteria = new Criteria();
	$criterion = $criteria->getNewCriterion( UserSitePeer::USERNAME, $username, Criteria::ILIKE );
	$criterion->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, $username, Criteria::ILIKE ) );
	$criteria->add( $criterion );
	$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
	$criteria->add( UserSitePeer::ACTIVE, true );
	$userSiteObj = UserSitePeer::doSelectOne( $criteria );
	
	if( is_object($userSiteObj) ){
		
		try {
			
			$userSiteObj->resetPassword();
			echo 'recoverySuccess';
		}catch(Exception $e){
			
			Util::forceError('sendMailFailure');
		}
	}else{
		
		echo 'userNotFound';
	}
	
	exit;
  }
}
