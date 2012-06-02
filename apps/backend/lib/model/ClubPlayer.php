<?php

/**
 * Subclasse de representação de objetos da tabela 'club_player'.
 *
 * 
 *
 * @package ...apps.backend.lib.model
 */ 
class ClubPlayer extends BaseClubPlayer
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('club_player', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('club_player', $this->getPrimaryKey(), $e);
        }
    }
}
