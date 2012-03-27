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
		
		$this->updatePlayers();
	}
	
	public function confirmPresence(){
		
		$this->setEnabled(true);
		$this->save();
		
		$this->updatePlayers();
	}
	
	public function declinePresence(){
		
		$this->setEnabled(false);
		$this->save();
		
		$this->updatePlayers();
	}

	public function updatePlayers(){
		
		Util::executeQuery('SELECT update_event_live_players('.$this->getEventLiveId().')');
	}
	
	public function getCurrentStatus(){
		
		return ($this->getEnabled()?'yes':'no');
	}
}
