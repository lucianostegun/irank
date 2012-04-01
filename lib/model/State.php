<?php

/**
 * Subclasse de representação de objetos da tabela 'state'.
 *
 * 
 *
 * @package lib.model
 */ 
class State extends BaseState
{

	public static function getList(Criteria $criteria=null){
		
		if( !$criteria )
			$criteria = new Criteria();
			
		$criteria->addAscendingOrderByColumn( StatePeer::ORDER_SEQ );
		$criteria->addAscendingOrderByColumn( StatePeer::STATE_NAME );
		
		return StatePeer::doSelect($criteria);
	}

	public static function getOptionsForSelect($defaultValue=false, $returnArray=false){
		
		$stateObjList = self::getList();

		$optionList = array();
		$optionList[''] = __('select');
		foreach( $stateObjList as $stateObj )			
			$optionList[$stateObj->getId()] = $stateObj->getStateName();
			
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
}
