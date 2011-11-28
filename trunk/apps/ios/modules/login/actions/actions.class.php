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
  /**
   * Executes index action
   *
   */
  public function executeDoLogin($request)
  {

	$username = $request->getParameter('username');
	$password = $request->getParameter('password');
	
	if( $username && $password ){
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::ACTIVE, true );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		$criterion = $criteria->getNewCriterion( UserSitePeer::USERNAME, $username );
		$criterion->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, $username ) );
		$criteria->add($criterion);
		
		if( !Util::isDebug() )
			$criteria->add( UserSitePeer::PASSWORD, md5($password), Criteria::ILIKE );
			
		$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );
		
		if( is_object($userSiteObj) )
			echo Util::parseInfo($userSiteObj->getInfo(true));
		else
			echo 'denied';
	}else{
		
		echo 'error';
	}
	
	exit;
  }
  
  public function executeSave($request){
  	
  	$xmlString = $request->getParameter('userSiteXml');

//	$file = fopen(Util::getFilePath('/xml.xml'), 'w');
//	fwrite($file, $xmlString);
//	fclose($file);
//	$xmlString = file_get_contents(Util::getFilePath('/xml.xml'));

	$xmlString = simplexml_load_string( $xmlString );
	
	$validate = new DOMDocument;
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

	if( !UserSitePeer::uniqueEmailAddress($emailAddress) )
		$errorMessage = 'O e-mail informado já está em uso por outro usuário.';
	
	if( !UserSitePeer::uniqueUsername($username) )
		$errorMessage = 'O username informado já está em uso por outro usuário.';
		
	if( $errorMessage )
		Util::forceError(utf8_decode($errorMessage), true);
		
		
	$userSiteObj = new UserSite();
	$peopleObj   = PeoplePeer::retrieveByEmailAddress($emailAddress);
	
	$this->setFlash('showSuccess', true);
	
	if( is_object($peopleObj) && $peopleObj->isPeopleType('rankingPlayer') )
		$userSiteObj->setPeopleId($peopleObj->getId());
		
	$this->getUser()->setCulture('pt_BR');
  	
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
}
