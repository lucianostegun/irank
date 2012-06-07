<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live_schedule'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLiveSchedule extends BaseEventLiveSchedule
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

    		$this->setEventDateTime($this->getEventDate('Y-m-d').' '.$this->getStartTime());

			parent::save();
			
        	Log::quickLog('event_live_schedule', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event_live_schedule', $this->getPrimaryKey(), $e);
        }
    }
}
