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
	
	public static function doSelectRS(Criteria $criteria, $con = null){
		
		$criteria->addAnd( self::DELETED, false );
		
		return parent::doSelectRS($criteria, $con);
	}
	
	public static function validateResult($eventId){
		
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
				MyTools::setError('buyin'.$peopleId, 'Este campo é obrigatório e não foi preenchido');
			elseif( !Validate::isFloat($buyin) || $buyin < 0 )
				MyTools::setError('buyin'.$peopleId, 'O valor informado não é um número válido');
			elseif( $eventPosition && $buyin <= 0 )
				MyTools::setError('buyin'.$peopleId, 'Informe um valor maior que 0,00');
			
			if( !$rebuy && $rebuy!=='0' )
				MyTools::setError('rebuy'.$peopleId, 'Este campo é obrigatório e não foi preenchido');
			elseif( !Validate::isFloat($rebuy) || $rebuy < 0 )
				MyTools::setError('rebuy'.$peopleId, 'O valor informado não é um número válido');
				
			if( !$addon && $addon!=='0' )
				MyTools::setError('addon'.$peopleId, 'Este campo é obrigatório e não foi preenchido');
			elseif( !Validate::isFloat($addon) || $addon < 0 )
				MyTools::setError('addon'.$peopleId, 'O valor informado não é um número válido');
				
			if( !$eventPosition && $eventPosition!=='0' )
				MyTools::setError('eventPosition'.$peopleId, 'Este campo é obrigatório e não foi preenchido');
			elseif( !Validate::isInteger($eventPosition) || $eventPosition < 0 )
				MyTools::setError('eventPosition'.$peopleId, 'O valor informado não é um número inteiro válido');
			
			if( !$prize && $prize!=='0' )
				MyTools::setError('prize'.$peopleId, 'Este campo é obrigatório e não foi preenchido');
			elseif( !Validate::isFloat($prize) || $prize < 0 )
				MyTools::setError('prize'.$peopleId, 'O valor informado não é um número válido');
			
			if( $eventPosition!=-'0' && $peopleIdConflict = array_search($eventPosition, $eventPositionList) ){
				
				MyTools::setError('eventPosition'.$peopleId, 'Ocorreu um conflito de posições para a posição '.$eventPosition);
				MyTools::setError('eventPosition'.$peopleIdConflict, 'Ocorreu um conflito de posições para a posição '.$eventPosition);
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
  				MyTools::setError('eventPosition'.$peopleId, 'As posições informadas devem ser sequenciais e sem cortes');
  		}
  		
		return !$request->hasErrors();
	}
	
	public static function retrieveByConfirmCode($confirmCode){

		$criteria = new Criteria();
		$criteria->add( EventPlayerPeer::CONFIRM_CODE, $confirmCode );
		return EventPlayerPeer::doSelectOne($criteria);
	}
}
