<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'people'.
 *
 * 
 *
 * @package lib.model
 */ 
class PeoplePeer extends BasePeoplePeer
{
	
	public static function retrieveByEmailAddress($emailAddress){
		
		$criteria = new Criteria();
		$criteria->add( PeoplePeer::ENABLED, true );
		$criteria->add( PeoplePeer::VISIBLE, true );
		$criteria->add( PeoplePeer::DELETED, false );
		$criteria->add( PeoplePeer::EMAIL_ADDRESS, $emailAddress, Criteria::ILIKE );
   		return PeoplePeer::doSelectOne( $criteria );
	}
	
    public static function search( $request, $count ){
    
    	$fullName = $request->getParameter('fullName');
    	
    	$limit  = $request->getParameter('limit', 50);
    	$offset = $request->getParameter('offset', 0);
    	
    	$databaseSortField = $request->getParameter('databaseSortField');
    	$databaseSortDesc  = $request->getParameter('databaseSortDesc');

		$criteria = new Criteria();
		if( $fullName )  $criteria->add( PeoplePeer::FULL_NAME, '%'.$fullName.'%', Criteria::ILIKE );
		$criteria->add( PeoplePeer::ENABLED, true );
		$criteria->add( PeoplePeer::VISIBLE, true );
		$criteria->add( PeoplePeer::DELETED, false );
		
		$criteria->addJoin( PeoplePeer::ID, PeopleEmailPeer::PEOPLE_ID, Criteria::LEFT_JOIN );
		$criteria->addJoin( PeopleEmailPeer::EMAIL_ID, EmailPeer::ID, Criteria::LEFT_JOIN );
		
		if( $databaseSortField ){
			
			if( $databaseSortDesc )
				$criteria->addDescendingOrderByColumn( $databaseSortField );
			else
				$criteria->addAscendingOrderByColumn( $databaseSortField );
		}else {	

			$criteria->addAscendingOrderByColumn( PeoplePeer::FULL_NAME );
		}
		
		if( $count )
    		return PeoplePeer::doCount( $criteria );
    	else{
    		
    		$criteria->setLimit($limit);
    		$criteria->setOffset($offset);
    		
    		return PeoplePeer::doSelect( $criteria );
    	}
    }
    
    public static function uniqueNickname($nickname){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$criteria = new Criteria();
		$criteria->add( PeoplePeer::ID, $peopleId, Criteria::NOT_EQUAL );
		$criteria->add( PeoplePeer::NICKNAME, $nickname, Criteria::LIKE );
		$peopleObj = PeoplePeer::doSelectOne( $criteria );

		return !is_object( $peopleObj );
	}
}
