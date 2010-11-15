<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'event_member'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventMemberPeer extends BaseEventMemberPeer
{
	
	public static function validateResult($eventId){
		
		$eventObj = EventPeer::retrieveByPK($eventId);
		$request  = MyTools::getRequest();
		
		$eventPositionList = array();
		
		$eventMemberObjList = $eventObj->getMemberList();
  		foreach($eventMemberObjList as $eventMemberObj){
  			
  			$peopleId = $eventMemberObj->getPeopleId();
  			
			$rebuys        = $request->getParameter('rebuys'.$peopleId);
			$addons        = $request->getParameter('addons'.$peopleId);
			$eventPosition = $request->getParameter('eventPosition'.$peopleId);
			$prizeValue    = $request->getParameter('prizeValue'.$peopleId);
			
			if( !$rebuys && $rebuys!=='0' )
				MyTools::setError('rebuys'.$peopleId, 'Este campo é obrigatório e não foi preenchido');
			elseif( !Validate::isInteger($rebuys) || $rebuys < 0 )
				MyTools::setError('rebuys'.$peopleId, 'O valor informado não é um número inteiro válido');
				
			if( !$addons && $addons!=='0' )
				MyTools::setError('addons'.$peopleId, 'Este campo é obrigatório e não foi preenchido');
			elseif( !Validate::isInteger($addons) || $addons < 0 )
				MyTools::setError('addons'.$peopleId, 'O valor informado não é um número inteiro válido');
				
			if( !$eventPosition && $eventPosition!=='0' )
				MyTools::setError('eventPosition'.$peopleId, 'Este campo é obrigatório e não foi preenchido');
			elseif( !Validate::isInteger($eventPosition) || $eventPosition < 0 )
				MyTools::setError('eventPosition'.$peopleId, 'O valor informado não é um número inteiro válido');
			
			if( !$prizeValue && $prizeValue!=='0' )
				MyTools::setError('prizeValue'.$peopleId, 'Este campo é obrigatório e não foi preenchido');
			elseif( !Validate::isFloat($prizeValue) || $prizeValue < 0 )
				MyTools::setError('prizeValue'.$peopleId, 'O valor informado não é um número válido');
			
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
}
