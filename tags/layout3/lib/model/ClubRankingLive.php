<?php

/**
 * Subclasse de representação de objetos da tabela 'club_ranking_live'.
 *
 * 
 *
 * @package lib.model
 */ 
class ClubRankingLive extends BaseClubRankingLive
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

//    		$this->postOnWall();
    		
			parent::save();
			
       		Log::quickLog('club_ranking_live', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('club_ranking_live', $this->getPrimaryKey(), $e);
        }
    }
}
