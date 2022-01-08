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
	
	public static function getQuickCity($cityName, $stateId){
		
		$cityName = trim($cityName);
		
		$orderSeq = Util::executeOne('SELECT MAX(order_seq) FROM city WHERE state_id='.$stateId);
		$orderSeq++;
		
		$cityObj = new City();
		$cityObj->setStateId($stateId);
		$cityObj->setCityName($cityName);
		$cityObj->setOrderSeq($orderSeq);
		$cityObj->save();
		
		return $cityObj;
	}
	
	public function getState($con=null){
		
		$stateObj = parent::getState($con);
		
		if( !is_object($stateObj) )
			$stateObj = new State();
		
		return $stateObj;
	}
	
	public function toString(){
		
		if( $this->isNew() )
			return null;
		
		return $this->getCityName().', '.$this->getState()->getInitial();
	}
}
