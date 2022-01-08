<?php

/**
 * Subclasse de representação de objetos da tabela 'sms_option'.
 *
 * 
 *
 * @package lib.model
 */ 
class SmsOption extends BaseSmsOption
{
	
	public static function checkOption($peopleId, $tagName){
		
		$criteria = new Criteria();
		$criteria->addJoin( SmsTemplatePeer::ID, SmsOptionPeer::SMS_TEMPLATE_ID, Criteria::INNER_JOIN );
		$criteria->add( SmsTemplatePeer::TAG_NAME, $tagName, Criteria::ILIKE );
		$criteria->add( SmsOptionPeer::PEOPLE_ID, $peopleId );
		$criteria->add( SmsOptionPeer::LOCK_SEND, false );
		return is_object(SmsOptionPeer::doSelectOne($criteria));
	}
}
