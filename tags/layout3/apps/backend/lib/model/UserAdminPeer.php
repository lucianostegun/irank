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
	
	public static function uniqueUsername($username){
		
		$userAdminId = MyTools::getRequestParameter('userAdminId');
		
		$criteria = new Criteria();
		$criteria->add( UserAdminPeer::ID, $userAdminId, Criteria::NOT_EQUAL );
		$criteria->add( UserAdminPeer::USERNAME, $username, Criteria::LIKE );
		$userAdminObj = UserAdminPeer::doSelectOne( $criteria );

		return !is_object( $userAdminObj );
	}

	public static function validateMasterClub($clubId){
		
		$master = MyTools::getRequestParameter('master');
		
		if( $clubId && $master ){
			
			MyTools::setError('master', 'Um usuário não pode ser Master e pertencer a um clube');
			return false;
		}

		return true;
	}
}
