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
			echo Util::parseInfo($userSiteObj->getInfo());
		else
			echo 'denied';
	}else{
		
		echo 'error';
	}
	
	exit;
  }
}
