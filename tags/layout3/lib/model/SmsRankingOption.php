<?php

/**
 * Subclasse de representação de objetos da tabela 'sms_ranking_option'.
 *
 * 
 *
 * @package lib.model
 */ 
class SmsRankingOption extends BaseSmsRankingOption
{
	
	public static function checkOption($peopleId, $rankingId, $tagName){
		
		$criteria = new Criteria();
		$criteria->addJoin( SmsTemplatePeer::ID, SmsRankingOptionPeer::SMS_TEMPLATE_ID, Criteria::INNER_JOIN );
		$criteria->add( SmsTemplatePeer::TAG_NAME, $tagName, Criteria::ILIKE );
		$criteria->add( SmsRankingOptionPeer::PEOPLE_ID, $peopleId );
		$criteria->add( SmsRankingOptionPeer::RANKING_ID, $rankingId );
		$criteria->add( SmsRankingOptionPeer::LOCK_SEND, false );
		return is_object(SmsRankingOptionPeer::doSelectOne($criteria));
	}
}
