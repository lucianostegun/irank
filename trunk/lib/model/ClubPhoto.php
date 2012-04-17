<?php

/**
 * Subclasse de representação de objetos da tabela 'club_photo'.
 *
 * 
 *
 * @package lib.model
 */ 
class ClubPhoto extends BaseClubPhoto
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('club_photo', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('club_photo', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
	}
}
