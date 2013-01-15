<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'sms_ranking_option'.
 *
 * 
 *
 * @package lib.model
 */ 
class SmsRankingOptionPeer extends BaseSmsRankingOptionPeer
{
	
	public static function retrieveByPK($peopleId, $rankingId, $smsTemplateId, $con=null){
		
		$smsRankingOptionObj = parent::retrieveByPK($peopleId, $rankingId, $smsTemplateId, $con);
		
		if( !is_object($smsRankingOptionObj) ){
			
			$smsRankingOptionObj = new SmsRankingOption();
			$smsRankingOptionObj->setPeopleId($peopleId);
			$smsRankingOptionObj->setRankingId($rankingId);
			$smsRankingOptionObj->setSmsTemplateId($smsTemplateId);
		}
		
		return $smsRankingOptionObj;
	}
}
