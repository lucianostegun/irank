<?php

/**
 * Subclasse de representação de objetos da tabela 'event_photo'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPhoto extends BaseEventPhoto
{
	
	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('event_photo', $this->getPrimaryKey());
	}
	
	public function getNextPhoto(){
		
		$criteria = new Criteria();
		$criteria->add( EventPhotoPeer::EVENT_ID, $this->getEventId() );
		$criteria->add( EventPhotoPeer::ID, $this->getId(), Criteria::GREATER_THAN );
		$criteria->add( EventPhotoPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( EventPhotoPeer::ID );
		return EventPhotoPeer::doSelectOne($criteria);
	}
	
	public function getPreviousPhoto(){
		
		$criteria = new Criteria();
		$criteria->add( EventPhotoPeer::EVENT_ID, $this->getEventId() );
		$criteria->add( EventPhotoPeer::ID, $this->getId(), Criteria::LESS_THAN );
		$criteria->add( EventPhotoPeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( EventPhotoPeer::ID );
		return EventPhotoPeer::doSelectOne($criteria);
	}
	
	public function getInfo(){
		
		$fileObj = $this->getFile();
		
		$dimensions = $fileObj->getDimensions();
		$filePath   = $fileObj->getFilePath();
		$filePath   = str_replace('\\', '/', $filePath);
		
		$infoList = array();
		$infoList['id']       = $this->getId();
		$infoList['eventId']  = $this->getEventId();
		$infoList['fileId']   = $this->getFileId();
		$infoList['fileName'] = $fileObj->getFileName();
		$infoList['filePath'] = $filePath;
		$infoList['width']    = $dimensions['width'];
		$infoList['height']   = $dimensions['height'];
		
		return $infoList;
	}
}
