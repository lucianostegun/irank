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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

//    		$this->postOnWall();
    		
			parent::save();
			
       		Log::quickLog('event_live_player', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event_live_player', $this->getPrimaryKey(), $e);
        }
    }
	
	public function togglePresence(){
		
		$this->setEnabled( !$this->getEnabled() );
		$this->save();
		
		$this->updatePlayers();
	}
	
	public function confirmPresence(){
		
		if( $this->getEventLive()->getSavedResult() )
			throw new Exception('Não é possível incluir jogadores de um evento já publicado');
			
		$this->setEnabled(true);
		$this->save();
		
		$this->updatePlayers();
	}
	
	public function declinePresence(){
		
		if( $this->getEventLive()->getSavedResult() )
			throw new Exception('Não é possível remover jogadores de um evento já publicado');
		
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
	
	public function getScoreList($returnArray=false){
		
		$criteria = new Criteria();
		$criteria->add( EventLivePlayerScorePeer::EVENT_LIVE_ID, $this->getEventLiveId() );
		$criteria->add( EventLivePlayerScorePeer::PEOPLE_ID, $this->getPeopleId() );
		$criteria->addAscendingOrderByColumn( EventLivePlayerScorePeer::ORDER_SEQ );
		
		if( $returnArray ){
			
			$eventLivePlayerScoreObjList = EventLivePlayerScorePeer::doSelect($criteria);
			$eventLivePlayerScoreList = array();
			
			foreach($eventLivePlayerScoreObjList as $eventLivePlayerScoreObj)
				$eventLivePlayerScoreList[String::removeAccents(strtolower($eventLivePlayerScoreObj->getLabel()))] = $eventLivePlayerScoreObj->getScore();
				
			return $eventLivePlayerScoreList;
		}
		
		return EventLivePlayerScorePeer::doSelect($criteria);
	}
}
