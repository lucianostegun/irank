<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live_photo'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePhoto extends BaseEventLivePhoto
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('event_live_photo', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event_live_photo', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
	}
}
