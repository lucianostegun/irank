<?php

/**
 * Subclasse de representação de objetos da tabela 'event_personal'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPersonal extends BaseEventPersonal
{
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
        	Log::quickLog('event_personal', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event_personal', $this->getPrimaryKey(), $e);
        }
        
    }
	
	public function delete($con=null){
		
		$deleted = $this->getDeleted();
		
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('event_personal', $this->getPrimaryKey());
	}
	
	public function getCode(){
		
		return '#'.sprintf('%04d', ($this->getId()+1985));
	}
	
	public static function getList($criteria=null, $limit=null){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		
		if( !is_object($criteria) )
			$criteria = new Criteria();

		$criteria->add( EventPersonalPeer::ENABLED, true );
		$criteria->add( EventPersonalPeer::VISIBLE, true );
		$criteria->add( EventPersonalPeer::DELETED, false );
		$criteria->add( EventPersonalPeer::USER_SITE_ID, $userSiteId );
		$criteria->addDescendingOrderByColumn( EventPersonalPeer::EVENT_DATE );
		
		$criteria->setLimit($limit);
		
		return EventPersonalPeer::doSelect( $criteria );
	}
	
	public function isMyEvent(){
		
		$userSiteId = MyTools::getAttribute('userSiteId');
		return ($this->getUserSiteId()==$userSiteId || $this->isNew());
	}
	
	public function isEditable(){
		
		return true;
	}
	
	public function isPastDate(){
		
		$eventDateTime   = $this->getEventDate('Y-m-d');
		$currentDateTime = time();
		
		return $currentDateTime > strtotime($eventDateTime);
	}
	
	public function getGameStyle(){
		
		$virtualTableObj = $this->getVirtualTable();
		
		if( !is_object($virtualTableObj) )
			$virtualTableObj = new VirtualTable();
		
		return $virtualTableObj;
	}
	
	public function getBRA(){
		
		return $this->getBuyin()+$this->getRebuy()+$this->getAddon();
	}
	
	public function getClone(){
		
		$eventName   = $this->getEventName();
		$eventNumber = preg_replace('/^[^0-9]*/', '', $eventName);
		
		if( !$eventNumber )
			$eventNumber = ' #1';
		else{
		
			$eventName   = preg_replace('/[0-9]*$/', '', $eventName);
			$eventNumber = $eventNumber+1;
		}
		
		$eventPersonalObj = new EventPersonal();
		$eventPersonalObj->setUserSiteId($this->getUserSiteId());
		$eventPersonalObj->setGameStyleId($this->getGameStyleId());
		$eventPersonalObj->setEventName($eventName.$eventNumber);
		$eventPersonalObj->setEventPlace($this->getEventPlace());
		$eventPersonalObj->setEventDate($this->getEventDate());
		$eventPersonalObj->setEventPosition($this->getEventPosition());
		$eventPersonalObj->setPaidPlaces($this->getPaidPlaces());
		$eventPersonalObj->setPlayers($this->getPlayers());
		$eventPersonalObj->setBuyin($this->getBuyin());
		$eventPersonalObj->setRebuy($this->getRebuy());
		$eventPersonalObj->setAddon($this->getAddon());
		$eventPersonalObj->setPrize($this->getPrize());
		$eventPersonalObj->setComments($this->getComments());
		$eventPersonalObj->setVisible(false);
		$eventPersonalObj->setEnabled(false);
		$eventPersonalObj->setLocked(true);
		$eventPersonalObj->save();
		
		return $eventPersonalObj;
	}
	
	public function getInfo(){
		
		$peopleId = MyTools::getAttribute('peopleId');
		
		$infoList = array();
		$infoList['eventPersonalId'] = $this->getId();
		$infoList['pastDate']        = $this->isPastDate();
		$infoList['isEditable']      = $this->isEditable();
		
		return $infoList;
	}
}
