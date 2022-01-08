<?php

/**
 * Subclasse de representação de objetos da tabela 'ranking_place'.
 *
 * 
 *
 * @package lib.model
 */ 
class RankingPlace extends BaseRankingPlace
{

	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
	}
	
	public function quickSave($request){
		
		$rankingId = $request->getParameter('rankingId');
	  	$placeName = $request->getParameter('placeName');
	  	$mapsLink  = $request->getParameter('mapsLink');
	  	$stateId   = $request->getParameter('stateId');
	  	$cityName  = $request->getParameter('cityName');
	  	$quarter   = $request->getParameter('quarter');
  	
  		if( $this->isNew() )
			$this->setRankingId( $rankingId );
		
		$this->setPlaceName( $placeName );
		$this->setMapsLink( $mapsLink );
		$this->setStateId( $stateId );
		$this->setCityName( $cityName );
		$this->setQuarter( $quarter );
		$this->save();
	}
	
	public static function getList($rankingId){
		
		$criteria = new Criteria();
		$criteria->add( RankingPlacePeer::RANKING_ID, $rankingId );
		$criteria->add( RankingPlacePeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( RankingPlacePeer::PLACE_NAME );
		
		return RankingPlacePeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect( $rankingId, $defaultValue=false, $returnArray=false ){
		
		$rankingPlaceObjList = self::getList($rankingId);

		$optionList = array();
		$optionList[''] = __('select');
		foreach( $rankingPlaceObjList as $rankingPlaceObj )			
			$optionList[$rankingPlaceObj->getId()] = $rankingPlaceObj->getPlaceName();
			
		if( $rankingId )
			$optionList['new'] = __('event.createNewPlace');
		
		if( $returnArray )
			return $optionList;

		return options_for_select( $optionList, $defaultValue );
	}
	
	public function getClone(){
		
		$rankingPlaceObj = new RankingPlace();
		$rankingPlaceObj->setPlaceName( $this->getPlaceName() );
		$rankingPlaceObj->setMapsLink( $this->getMapsLink() );
		$rankingPlaceObj->setStateId( $this->getStateId() );
		$rankingPlaceObj->setCityName( $this->getCityName() );
		$rankingPlaceObj->setQuarter( $this->getQuarter() );
		
		return $rankingPlaceObj;
	}
	
	public function getState($con=null){
		
		$stateObj = parent::getState($con);
		
		if( !is_object($stateObj) )
			$stateObj = new State();
		
		return $stateObj;
	}
	
	public function updatePlaceInfo(){
		
		$mapsLink = $this->getMapsLink();
		$stateId  = $this->getStateId();
		$cityName = $this->getCityName();
		$quarter  = $this->getQuarter();
		
		if( $mapsLink && !$stateId && !$cityName && !$quarter ){
			
			try{
				
				$addressInfo = RankingPlace::parseMapsLink($mapsLink);
				
				$this->setStateId($addressInfo['stateId']);
				$this->setCityName($addressInfo['cityName']);
				$this->setQuarter($addressInfo['quarter']);
				$this->save();
			}catch(Exception $e){
				
			}
		}
	}
	
	public static function parseMapsLink($mapsLink){

		preg_match('/[\?&]q=([^&]*)&?/i', $mapsLink, $matches);
		
		if( count($matches) < 2 )
			Util::forceError('invalidUrl');
		
		$addressUrl = $matches[1];
		$addressUrl = utf8_encode($addressUrl);
//		$addressUrl = 'r.+minas+gerais,+89,+fernand%C3%B3polis,+sp,+15600-000,+brazil';
		
		$geoUrl = "http://maps.google.com/maps/geo?q=$addressUrl&hl=pt&ie=UTF8&output=json";
		$json   = file_get_contents($geoUrl);
		
		$getObj = json_decode($json);
		
		if( !property_exists($getObj, 'Placemark') )
			throw new Exception('invalidAddressInfo');
		
		$placemark = $getObj->Placemark;
		
		if( empty($placemark) )
			throw new Exception('emptyAddressInfo');
		  		
		  	$addressDetailsObj = $placemark[0]->AddressDetails->Country;
		  
		  	$stateName = @$addressDetailsObj->AdministrativeArea->AdministrativeAreaName;
		  	$cityName  = @$addressDetailsObj->AdministrativeArea->Locality->LocalityName;
		  	$quarter   = @$addressDetailsObj->AdministrativeArea->Locality->DependentLocality->DependentLocalityName;
		
			$stateName = utf8_decode($stateName);  	
		  	$stateName = preg_replace('/[^a-zA-Z\ ]/', '%', $stateName);
		
		$stateObj = StatePeer::retrieveByStateName($stateName);
		
		if( !is_object($stateObj) )
			throw new Exception('stateNotFound');
			
		if( !$stateName || !$cityName )
			throw new Exception('incompleteAddressInfo');
			
		return array('stateId'=>$stateObj->getId(), 'state'=>$stateObj->getInitial(), 'cityName'=>$cityName, 'quarter'=>$quarter);
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']        = $this->getId();
		$infoList['rankingId'] = $this->getRankingId();
		$infoList['ranking']   = $this->getRanking()->getRankingName();
		$infoList['placeName'] = $this->getPlaceName();
		$infoList['mapsLink']  = $this->getMapsLink();
		$infoList['stateId']   = $this->getStateId();
		$infoList['cityName']  = $this->getCityName();
		$infoList['quarter']   = $this->getQuarter();
		
		return $infoList;
	}
}
