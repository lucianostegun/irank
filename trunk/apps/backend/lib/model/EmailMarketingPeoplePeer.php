<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'email_marketing_people'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class EmailMarketingPeoplePeer extends BaseEmailMarketingPeoplePeer
{
	
	public static function retrieveByPK($emailMarketingId, $peopleId, $con=null){
		
		$emailMarketingPeopleObj = parent::retrieveByPK($emailMarketingId, $peopleId, $con);
		
		if( !is_object($emailMarketingPeopleObj) ){
			
			$emailMarketingPeopleObj = new EmailMarketingPeople();
			$emailMarketingPeopleObj->setEmailMarketingId($emailMarketingId);
			$emailMarketingPeopleObj->setPeopleId($peopleId);
		}
		
		return $emailMarketingPeopleObj;
	}
}
