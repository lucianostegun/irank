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
    	
		$this->setEventDateTime($this->getEventDate('Y-m-d').' '.$this->getStartTime());

		parent::save();
    }
}
