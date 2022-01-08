<?php

class friendSearchActions extends sfActions
{

  public function executeSearch($request){
  	
  	$keyWord = $request->getParameter('keyWord');

  	$criteria = new Criteria();
  	
  	$criterion = $criteria->getNewCriterion( UserSitePeer::USERNAME, '%'.$keyWord.'%', Criteria::ILIKE );
  	$criterion->addOr( $criteria->getNewCriterion( PeoplePeer::EMAIL_ADDRESS, '%'.$keyWord.'%', Criteria::ILIKE ) );
	$criteria->add( $criterion );

	if( !$keyWord )
		$criteria->add( PeoplePeer::ID, null );

	$this->criteria = $criteria;
	$this->setTemplate('index');
  }
}
