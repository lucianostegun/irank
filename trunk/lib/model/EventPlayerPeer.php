<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_player'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPlayerPeer extends BaseEventPlayerPeer
{
	
	public static function retrieveByPK($eventId, $peopleId, $con=null){
		
		$eventPlayerObj = parent::retrieveByPK($eventId, $peopleId, $con);
		
		if( !is_object($eventPlayerObj) ){
			
			$eventPlayerObj = new EventPlayer();
			$eventPlayerObj->setEventId( $eventId );
			$eventPlayerObj->setPeopleId( $peopleId );
			$eventPlayerObj->setDeleted(false);
			$eventPlayerObj->setConfirmCode( $eventPlayerObj->getConfirmCode() );
		}
		
		return $eventPlayerObj;
	}
	
	public static function validateResult($eventId){
		
		Util::getHelper('I18N');
		
		$eventObj = EventPeer::retrieveByPK($eventId);
		$request  = MyTools::getRequest();
		
		$eventPositionList = array();
		
		$eventPlayerObjList = $eventObj->getPlayerList();
  		foreach($eventPlayerObjList as $eventPlayerObj){
  			
  			$peopleId = $eventPlayerObj->getPeopleId();
  			
			$buyin         = $request->getParameter('buyin'.$peopleId);
			$rebuy         = $request->getParameter('rebuy'.$peopleId);
			$addon         = $request->getParameter('addon'.$peopleId);
			$eventPosition = $request->getParameter('eventPosition'.$peopleId);
			$prize    = $request->getParameter('prize'.$peopleId);
			
			if( !$buyin && $buyin!=='0' )
				MyTools::setError('buyin'.$peopleId, __('form.error.requiredField'));
			elseif( !Validate::isFloat($buyin) || $buyin < 0 )
				MyTools::setError('buyin'.$peopleId, __('form.error.invalidNumber'));
			elseif( $eventPosition && $buyin <= 0 )
				MyTools::setError('buyin'.$peopleId, __('form.error.numberGraterThan0'));
			
			if( !$rebuy && $rebuy!=='0' )
				MyTools::setError('rebuy'.$peopleId, __('form.error.requiredField'));
			elseif( !Validate::isFloat($rebuy) || $rebuy < 0 )
				MyTools::setError('rebuy'.$peopleId, __('form.error.invalidNumber'));
				
			if( !$addon && $addon!=='0' )
				MyTools::setError('addon'.$peopleId, __('form.error.requiredField'));
			elseif( !Validate::isFloat($addon) || $addon < 0 )
				MyTools::setError('addon'.$peopleId, __('form.error.invalidNumber'));
				
			if( !$eventPosition && $eventPosition!=='0' )
				MyTools::setError('eventPosition'.$peopleId, __('form.error.requiredField'));
			elseif( !Validate::isInteger($eventPosition) || $eventPosition < 0 )
				MyTools::setError('eventPosition'.$peopleId, __('form.error.invalidInteger'));
			
			if( !$prize && $prize!=='0' )
				MyTools::setError('prize'.$peopleId, __('form.error.requiredField'));
			elseif( !Validate::isFloat($prize) || $prize < 0 )
				MyTools::setError('prize'.$peopleId, __('form.error.invalidNumber'));
			
			if( $eventPosition!=-'0' && $peopleIdConflict = array_search($eventPosition, $eventPositionList) ){
				
				MyTools::setError('eventPosition'.$peopleId, __('form.error.positionConflict', array('%position%'=>$eventPosition)));
				MyTools::setError('eventPosition'.$peopleIdConflict, __('form.error.positionConflict', array('%position%'=>$eventPosition)));
			}else{
				
				if( Validate::isInteger($eventPosition) && $eventPosition!='0' )
					$eventPositionList[$peopleId] = $eventPosition;
			}
  		}
  		
  		$eventPositionListTmp = $eventPositionList;
  		sort($eventPositionListTmp);
  		
  		$position = 1;
  		foreach( $eventPositionListTmp as $peopleId=>$eventPosition ){
  			
  			$peopleId = array_search($eventPosition, $eventPositionList);
  			if( $eventPosition!=$position++ )
  				MyTools::setError('eventPosition'.$peopleId, __('form.error.sequencePosition'));
  		}
  		
		return !$request->hasErrors();
	}
	
	public static function retrieveByConfirmCode($confirmCode){

		$criteria = new Criteria();
		$criteria->add( EventPlayerPeer::CONFIRM_CODE, $confirmCode );
		return EventPlayerPeer::doSelectOne($criteria);
	}
}
