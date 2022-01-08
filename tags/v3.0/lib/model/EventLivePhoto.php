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
	
    public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
	}
}
