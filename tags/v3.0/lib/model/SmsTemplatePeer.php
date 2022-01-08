<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'sms_template'.
 *
 * 
 *
 * @package lib.model
 */ 
class SmsTemplatePeer extends BaseSmsTemplatePeer
{
	
	public static function getContentByTagName($tagName){
		
		$criteria = new Criteria();
		$criteria->add( SmsTemplatePeer::TAG_NAME, $tagName );
		$smsTemplateObj = SmsTemplatePeer::doSelectOne($criteria);
		
		if( !is_object($smsTemplateObj) )
			$smsTemplateObj = new SmsTemplate();
		
		return $smsTemplateObj->getContent();
	}
}
