<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'state'.
 *
 * 
 *
 * @package lib.model
 */ 
class StatePeer extends BaseStatePeer
{
	
	public static function retrieveByInitial($initial, $createNew=false){
		
		$initial = trim($initial);
		
		$criteria = new Criteria();
		$criteria->add( StatePeer::INITIAL, $initial );
		$stateObj = StatePeer::doSelectOne($criteria);
		
		if( !is_object($stateObj) && $createNew ){
			
			$stateObj = new State();
			$stateObj->setInitial($initial);
			$stateObj->save();
		}
		
		return $stateObj;
	}

	public static function retrieveByStateName($stateName, $createNew=false){
		
		$stateName = trim($stateName);
		
		$criteria = new Criteria();
		$criteria->add( StatePeer::STATE_NAME, $stateName, Criteria::ILIKE );
		return StatePeer::doSelectOne($criteria);
	}
}
