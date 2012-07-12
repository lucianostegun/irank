<?php

/**
 * Subclasse de representação de objetos da tabela 'club_settings'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class ClubSettings extends BaseClubSettings
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('club_settings', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('club_settings', $this->getPrimaryKey(), $e);
        }
    }
}
