<?php

class searchActions extends sfActions
{

  public function executeResult($request){
  	
  	$keyWord = $request->getParameter('mainSearch');

  	$criteria = new Criteria();
  	
  	$criterion = $criteria->getNewCriterion( UserSitePeer::USERNAME, '%'.$keyWord.'%', Criteria::ILIKE );
  	$criterion->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, '%'.$keyWord.'%', Criteria::ILIKE ) );
	$criteria->add( $criterion );

	if( !$keyWord )
		$criteria->add( PeoplePeer::ID, null );

	$criteria->add( UserSitePeer::ACTIVE, true );	
	$criteria->add( UserSitePeer::ENABLED, true );	
	$criteria->add( UserSitePeer::VISIBLE, true );	
	$criteria->add( UserSitePeer::DELETED, false );	
	$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );	
	$criteria->setLimit(20);	
	$this->userSiteObjList = UserSitePeer::doSelect($criteria);
  }
}
