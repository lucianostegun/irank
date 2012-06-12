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
	
	public function togglePresence($enrollmentStatus='enrolled'){

		// Se estiver confirmado (enabled=true) marca como desconfirmado		
		if( $this->isEnrollmentStatus(array('enrolled', 'confirmed')) ){
			
			$this->setEnrollmentStatus('declined');
			$this->setEnabled(false);
			$this->setDeleted(true);
		}else{
			
			// Se não estiver confirmado, apenas marca como inscrito e não como confirmado
			$this->setEnrollmentStatus($enrollmentStatus);
			$this->setDeleted(false);
			
			if( $enrollmentStatus=='confirmed' )
				$this->setEnabled(true);
		}
		
		$this->save();
		
		$this->updatePlayers();
	}
	
	public function confirmPresence(){
		
		if( $this->getEventLive()->getSavedResult() )
			throw new Exception('Não é possível incluir jogadores de um evento já publicado');
		
		$con = Propel::getConnection();
		$con->begin();
		
		try{
			
			$eventLiveObj       = $this->getEventLive();
    		$enabled            = $this->getEnabled();
    		$enrollmentMode     = $eventLiveObj->getEnrollmentMode();
    	
	    	if( $enabled )
	    		return 'noChange';
    	
			$this->setEnabled(($enrollmentMode=='enrollment'?false:true));
			$this->setEnrollmentStatus(($enrollmentMode=='enrollment'?'enrolled':'confirmed'));
			$this->save($con);
			
			$clubId = $this->getEventLive()->getClubId();
			
			if( $clubId )
				$this->getPeople()->addToClub($clubId);
			
			$this->updatePlayers();
			$con->commit();
		}catch(Exception $e){
			
			$con->rollback();
		}
	}
	
	public function declinePresence(){
		
		if( $this->getEventLive()->getSavedResult() )
			throw new Exception('Não é possível remover jogadores de um evento já publicado');
		
		$this->setEnrollmentStatus('declined');
		$this->setEnabled(false);
		$this->save();
		
		$this->updatePlayers();
	}
	
	public function eliminate($eventPosition){
		
		$eventLiveId = $this->getEventLiveId();
		
		Util::executeQuery("UPDATE event_live_player SET event_position = 0 WHERE event_live_id = $eventLiveId AND event_position = $eventPosition");
		
		$this->setEventPosition($eventPosition);
		$this->save();
	}

	public function updatePlayers(){
		
		Util::executeQuery('SELECT update_event_live_players('.$this->getEventLiveId().')');
	}
	
	public function getCurrentStatus(){
		
		$enrollmentStatus = $this->getEnrollmentStatus();
		
		return (in_array($enrollmentStatus, array('enrolled', 'confirmed'))?'yes':'no');
	}
	
	public function getEnrollmentStatus($description=false){
		
		$enrollmentStatus = parent::getEnrollmentStatus();
		
		if( $description ){
			switch($enrollmentStatus){
				case 'enrolled':
					$enrollmentStatus = 'Inscrito';
					break;
				case 'confirmed':
					$enrollmentStatus = 'Confirmado';
					break;
				case 'canceled':
					$enrollmentStatus = 'Cancelado';
					break;
			}
		}
		
		return $enrollmentStatus;
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
	
	public function isEnrollmentStatus($enrollmentStatusList){
		
		$enrollmentStatus = $this->getEnrollmentStatus();
		
		return in_array($enrollmentStatus, $enrollmentStatusList);
	}
}
