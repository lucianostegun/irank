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
	
	public static function retrieve($userSiteId, $peopleId, $username){
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::ID, $userSiteId );
		$criteria->add( UserSitePeer::PEOPLE_ID, $peopleId );
		$criteria->add( UserSitePeer::USERNAME, $username );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		return UserSitePeer::doSelectOne( $criteria );
	}

	public static function retrieveByUsername($username){
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::USERNAME, $username );
		$criteria->add( UserSitePeer::ENABLED, true );
		$criteria->add( UserSitePeer::VISIBLE, true );
		$criteria->add( UserSitePeer::DELETED, false );
		return UserSitePeer::doSelectOne( $criteria );
	}
	
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
		$iRankAdmin = MyTools::hasCredential('iRankAdmin');
		$iRankClub  = MyTools::hasCredential('iRankClub');
		$peopleId   = MyTools::getRequestParameter('peopleId');
		
		$criteria = new Criteria();
		
		if( ($iRankAdmin || $iRankClub) && $peopleId ){
			
			$criteria->add( PeoplePeer::ID, $peopleId, Criteria::NOT_EQUAL );
			$criteria->add( PeoplePeer::ENABLED, true );
			$criteria->add( PeoplePeer::VISIBLE, true );
			$criteria->add( PeoplePeer::DELETED, false );
		}else{
			
			$criteria->add( UserSitePeer::ACTIVE, true );
			$criteria->add( UserSitePeer::ENABLED, true );
			$criteria->add( UserSitePeer::VISIBLE, true );
			$criteria->add( UserSitePeer::DELETED, false );
			$criteria->add( UserSitePeer::ID, $userSiteId, Criteria::NOT_EQUAL );
			$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		}

		$criteria->add( PeoplePeer::EMAIL_ADDRESS, $emailAddress, Criteria::ILIKE );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );

		return !is_object( $userSiteObj );
	}
	
	public static function validateEmailList(){
		
		Util::getHelper('I18N');
		
		$pattern = '/^[a-z]([a-z-_\.A-Z0-9])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/';

		for($i=1; $i<=10; $i++){
			
			$emailAddress = MyTools::getRequestParameter('emailAddress'.$i);
			$friendName   = MyTools::getRequestParameter('friendName'.$i);
			
			if( $emailAddress && !preg_match($pattern, $emailAddress))
				MyTools::setError('emailAddress'.$i, __('form.error.invalidEmail'));
			
			if( $emailAddress xor $friendName ){
				if( $emailAddress )
					MyTools::setError('friendName'.$i, __('friendInvite.form.error.friendNameError'));
				else
					MyTools::setError('emailAddress'.$i, __('friendInvite.form.error.friendEmailError'));
			}
		}
		
		return !MyTools::getRequest()->hasErrors();
	}
	
	public static function checkUsernameRecovery( $username ){
		
		Util::getHelper('I18N');
		
		$emailAddress = MyTools::getRequestParameter('emailAddress');
		
		if( !$emailAddress )
			return true;
		
		$criteria = new Criteria();
		$criteria->add( UserSitePeer::USERNAME, $username, Criteria::ILIKE );
		$criteria->add( PeoplePeer::EMAIL_ADDRESS, $emailAddress, Criteria::ILIKE );
		$criteria->addJoin( UserSitePeer::PEOPLE_ID, PeoplePeer::ID, Criteria::INNER_JOIN );
		$criteria->add( UserSitePeer::ACTIVE, true );
		$userSiteObj = UserSitePeer::doSelectOne( $criteria );
		
		if( !$userSiteObj )
			MyTools::setError('emailAddress', __('form.error.passwordRecoveryError'));

		return is_object( $userSiteObj );
	}
	
	public static function validatePhoneNumber($phone){
		
		$phoneDdd    = MyTools::getRequestParameter('phoneDdd');
		$phoneNumber = MyTools::getRequestParameter('phoneNumber');
		
		if( $phoneDdd && !$phoneNumber )
			MyTools::setError('phoneNumber', 'form.error.requiredField');
		
		if( !$phoneDdd && $phoneNumber )
			MyTools::setError('phoneDdd', 'form.error.requiredField');
		
		return !MyTools::getRequest()->hasErrors();
	}
}
