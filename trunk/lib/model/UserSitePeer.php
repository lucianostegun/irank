<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'user_site'.
 *
 * 
 *
 * @package lib.model
 */ 
class UserSitePeer extends BaseUserSitePeer
{
	
	public static function uniqueUsername( $username ){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::ID, $userSiteId, Criteria::NOT_EQUAL );
		$criteria->add( UserSitePeer::USERNAME, $username, Criteria::LIKE );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );

		return !is_object( $userSiteObj );
	}
	
	public static function uniqueEmailAddress( $emailAddress ){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::ID, $userSiteId, Criteria::NOT_EQUAL );
		$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->add( PeoplePeer::EMAIL_ADDRESS, $emailAddress, Criteria::ILIKE );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );

		return !is_object( $userSiteObj );
	}
}
