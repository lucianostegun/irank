<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePeer extends BaseEventLivePeer
{
	
	public static function search($criteria=null){
		
		$request = MyTools::getRequest();
		$clubId  = $request->getParameter('clubId');
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( EventLivePeer::ENABLED, true );
		$criteria->add( EventLivePeer::VISIBLE, true );
		$criteria->add( EventLivePeer::DELETED, false );
		
		if( $clubId )
			$criteria->add( EventLivePeer::CLUB_ID, $clubId );
		
		$criteria->addDescendingOrderByColumn( EventLivePeer::EVENT_DATE );
		$criteria->addAscendingOrderByColumn( EventLivePeer::START_TIME );
		
		return EventLivePeer::doSelect($criteria);
	}
	
	public static function validateChips($stackChips){
		
		return preg_match('/^[0-9]*[,\.]?[0-9]*[kK]?$/', $stackChips);
	}
}
