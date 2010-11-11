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
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::USERNAME, $username, Criteria::LIKE );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );

		return !is_object( $userSiteObj );
	}
}
