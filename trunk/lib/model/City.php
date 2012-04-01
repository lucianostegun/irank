<?php

/**
 * Subclasse de representação de objetos da tabela 'city'.
 *
 * 
 *
 * @package lib.model
 */ 
class City extends BaseCity
{

	public static function getList(Criteria $criteria=null, $stateId=null){
		
		if( !$criteria )
			$criteria = new Criteria();
		
		$criteria->add( CityPeer::STATE_ID, $stateId );
			
		$criteria->addAscendingOrderByColumn( CityPeer::ORDER_SEQ );
		$criteria->addAscendingOrderByColumn( CityPeer::CITY_NAME );
		
		return CityPeer::doSelect($criteria);
	}

	public static function getOptionsForSelect($stateId, $defaultValue=false, $returnArray=false){
		
		$cityObjList = self::getList(null, $stateId);

		$optionList = array();
		$optionList[''] = __('select');
		foreach( $cityObjList as $cityObj )			
			$optionList[$cityObj->getId()] = $cityObj->getCityName();
			
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
}
