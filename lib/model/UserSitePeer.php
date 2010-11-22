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
		$criteria->add( UserSitePeer::ACTIVE, true );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		$criteria->add( UserSitePeer::ID, $userSiteId, Criteria::NOT_EQUAL );
		$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->add( PeoplePeer::EMAIL_ADDRESS, $emailAddress, Criteria::ILIKE );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );

		return !is_object( $userSiteObj );
	}
	
	public static function validateEmailList(){
		
		$pattern = '/^[a-z]([a-z-_\.A-Z0-9])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/';

		for($i=1; $i<=10; $i++){
			
			$emailAddress = MyTools::getRequestParameter('emailAddress'.$i);
			$friendName   = MyTools::getRequestParameter('friendName'.$i);
			
			if( $emailAddress && !preg_match($pattern, $emailAddress))
				MyTools::setError('emailAddress'.$i, 'O e-mail informado não é um e-mail válido');
			
			if( $emailAddress xor $friendName ){
				if( $emailAddress )
					MyTools::setError('friendName'.$i, 'Informe o nome de seu amigo');
				else
					MyTools::setError('emailAddress'.$i, 'Informe o e-mail de seu amigo');
			}
		}
		
		return !MyTools::getRequest()->hasErrors();
	}
}
