<?php

/**
 * Subclasse de representação de objetos da tabela 'club_check'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class ClubCheck extends BaseClubCheck
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('club_check', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('club_check', $this->getPrimaryKey(), $e);
        }
    }
}
