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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('ranking_place', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('ranking_place', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('ranking_place', $this->getPrimaryKey());
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
}
