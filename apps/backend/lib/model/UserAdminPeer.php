<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'user_admin'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class UserAdminPeer extends BaseUserAdminPeer
{
	
	public static function uniqueUsername( $username ){
		
		$userAdminId = MyTools::getAttribute('userAdminId');
		
		$criteria = new Criteria();
		$criteria->add( UserAdminPeer::ID, $userAdminId, Criteria::NOT_EQUAL );
		$criteria->add( UserAdminPeer::USERNAME, $username, Criteria::LIKE );
		$userAdminObj = UserAdminPeer::doSelectOne( $criteria );

		return !is_object( $userAdminObj );
	}
}
