<?php

/**
 * eventLive actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class eventLiveActions extends sfActions
{

  public function preExecute(){
    
    $this->eventLiveId = $this->getRequestParameter('id');
    $this->eventLiveId = $this->getRequestParameter('eventLiveId', $this->eventLiveId);
    
    $this->pathList = array('Eventos ao vivo'=>'eventLive/index');
  }

  public function executeIndex($request){
    
  }

  public function executeNew($request){
    
    $this->eventLiveObj = Util::getNewObject('eventLive');
    
    $this->pathList['Novo evento'] = '#';
    $this->setTemplate('edit');
  }
  
  public function executeEdit($request){
    
    $this->eventLiveObj = $eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
    
    if( !$eventLiveObj->isMyEvent() ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou acessar as informações do evento <b>('.$eventLiveObj->getId().') '.$eventLiveObj->toString().'</b>.', 'EventLive', array(), Log::LOG_CRITICAL);
    	$eventLiveObj = null;
    }
    
    if( !is_object($eventLiveObj) )
    	return $this->redirect('eventLive/index');
    	
    if( $eventLiveObj->getRankingLiveId() ){
    	
	    $rankingLiveObj = $eventLiveObj->getRankingLive();
	    $this->pathList[$rankingLiveObj->toString()] = 'rankingLive/edit/rankingLiveId/'.$rankingLiveObj->getId();
    }
    
    $this->pathList[$eventLiveObj->toString()] = '#';
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
    
    if( !$eventLiveObj->isMyEvent() ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou editar as informações do evento <b>('.$eventLiveObj->getId().') '.$eventLiveObj->toString().'</b>.', 'EventLive', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse registro!');
    }
    
    $eventLiveObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->eventLiveId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( EventLivePeer::ID, $this->eventLiveId, Criteria::IN );
	    $criteria->add( EventLivePeer::VISIBLE, true );
	    $criteria->add( EventLivePeer::ENABLED, true );
	    $criteria->add( EventLivePeer::DELETED, false );
    	$eventLiveObjList = EventLivePeer::doSelect($criteria);
    	
    	$eventLiveIdList = array();
    	foreach($eventLiveObjList as $eventLiveObj){
    		
    		$eventLiveObj->delete();
	    	$eventLiveIdList[] = $eventLiveObj->getId();
    	}
    	
    	echo implode(',', $eventLiveIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
}
	