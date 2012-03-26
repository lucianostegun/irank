<?php

/**
 * Subclasse de representação de objetos da tabela 'event_live_player'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventLivePlayer extends BaseEventLivePlayer
{
	
	public function togglePresence(){
		
		$this->setEnabled( !$this->getEnabled() );
		$this->save();
		
		Util::executeQuery('SELECT update_event_live_players('.$this->getEventLiveId().')');
	}

	public function getCurrentStatus(){
		
		return ($this->getEnabled()?'yes':'no');
	}
}
