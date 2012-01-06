<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'user_site_option'.
 *
 * 
 *
 * @package lib.model
 */ 
class UserSiteOptionPeer extends BaseUserSiteOptionPeer
{
	
	public static function retrieveByPK($peopleId, $userSiteOptionId, $con=null){
		
		$userSiteOptionObj = parent::retrieveByPK($peopleId, $userSiteOptionId);
		
		if( !is_object($userSiteOptionObj) ){
			
			$userSiteOptionObj = new UserSiteOption();
			$userSiteOptionObj->setPeopleId($peopleId);
			$userSiteOptionObj->setUserSiteOptionId($userSiteOptionId);
		}
		
		return $userSiteOptionObj;
	}
}
