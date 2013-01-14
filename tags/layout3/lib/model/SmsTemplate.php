<?php

/**
 * Subclasse de representação de objetos da tabela 'sms_template'.
 *
 * 
 *
 * @package lib.model
 */ 
class SmsTemplate extends BaseSmsTemplate
{

	public static function getList($criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		
		$criteria->add( SmsTemplatePeer::ENABLED, true );
		$criteria->add( SmsTemplatePeer::VISIBLE, true );
		$criteria->add( SmsTemplatePeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( SmsTemplatePeer::ORDER_SEQ );
		$criteria->addAscendingOrderByColumn( SmsTemplatePeer::TEMPLATE_NAME );
		
		return SmsTemplatePeer::doSelect( $criteria );
	}
}
