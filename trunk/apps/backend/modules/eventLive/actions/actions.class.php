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
    
    $this->eventLiveObj->setDescription('<descrição do ranking>');
    
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
	    $this->pathList[$rankingLiveObj->toString()] = '#goToPage("rankingLive", "edit", "rankingLiveId", '.$rankingLiveObj->getId().', true)';
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

  public function executeAddPlayer($request){
    
    $peopleId    = $request->getParameter('peopleId');
    $eventLiveId = $this->eventLiveId;

    try{
    	
    	$eventLivePlayerObj = EventLivePlayerPeer::retrieveByPK($eventLiveId, $peopleId);
    	
    	if( $eventLivePlayerObj->getEnabled() ){
    		
    		echo 'noChange';
    		exit;
    	}
    		
	    $eventLivePlayerObj->confirmPresence();
    }catch(Exception $e){
    	
    	Util::forceError('!Erro ao incluir o jogador ao evento.'.Util::isDebug()?$e->getMessage():'');
    }
    
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('eventLive/include/players', array('eventLiveObj'=>$eventLivePlayerObj->getEventLive())));
  }

  public function executeRemovePlayer($request){
    
    $peopleId    = $request->getParameter('peopleId');
    $eventLiveId = $this->eventLiveId;

    try{
    	
    	$eventLivePlayerObj = EventLivePlayerPeer::retrieveByPK($eventLiveId, $peopleId);
	    $eventLivePlayerObj->declinePresence();
    }catch(Exception $e){
    	
    	Util::forceError('!Erro ao remover o jogador ao evento.'.Util::isDebug()?$e->getMessage():'');
    }
    
    exit;
  }
  
  public function executeAutoComplete($request){
    
	$peopleName   = $request->getParameter('term');
	$instanceName = $request->getParameter('instanceName');
	$suggestNew   = $request->getParameter('suggestNew');

	$emailAddress = null;
	
	if( preg_match('/,/', $peopleName) )
		list($peopleName, $emailAddress) = explode(',', $peopleName);
		
	$peopleName   = str_replace(' ', '%', trim($peopleName));
	$emailAddress = str_replace(' ', '%', trim($emailAddress));
	
	$table      = 'people INNER JOIN event_live_player ON event_live_player.PEOPLE_ID=people.ID AND event_live_player.EVENT_LIVE_ID='.$this->eventLiveId.' AND event_live_player.ENABLED';
	$fieldId    = 'id';
	$fieldName  = "FULL_NAME||', '||COALESCE(EMAIL_ADDRESS, 'Não informado')";
	$fieldValue = "FULL_NAME";
	$condition  = "people.ENABLED AND people.VISIBLE AND NOT people.DELETED AND ((no_accent(full_name) ILIKE no_accent('%$peopleName%') OR no_accent(email_address) ILIKE no_accent('%$peopleName%'))";
	
	if( $emailAddress )
		$condition .= " OR email_address ILIKE '%$emailAddress%'";
		
	$condition .= ")";

	$fieldOrder = 'full_name';

	$options = array('suggestNew'=>$suggestNew,
					 'quickName'=>$peopleName,
					 'fieldValue'=>$fieldValue,
					 'jquery'=>true);	
	
	echo Util::getAutoCompleteResults($table, $fieldId, $fieldName, $condition, $fieldOrder, $instanceName, $options );
	exit;
  }

  public function executeSavePlayerPosition($request){
    
    $peopleId      = $request->getParameter('peopleId');
    $eventPosition = $request->getParameter('eventPosition');

    try{
    	
    	$eventLivePlayerObj = EventLivePlayerPeer::retrieveByPK($this->eventLiveId, $peopleId);
    	
    	$eventPositionOld = $eventLivePlayerObj->getEventPosition();
    	
    	Util::executeQuery('UPDATE event_live_player SET event_position = NULL WHERE event_live_id = '.$this->eventLiveId.' AND event_position='.$eventPosition);
    	
	    $eventLivePlayerObj->setEventPosition($eventPosition);
	    $eventLivePlayerObj->save();
	    
	    $peopleObj = $eventLivePlayerObj->getPeople();
    }catch(Exception $e){
    	
    	Util::forceError('!Erro ao remover o jogador ao evento.'.Util::isDebug()?$e->getMessage():'');
    }
    
    $infoList = array();
    $infoList['peopleName']   = $peopleObj->getFullName();
    $infoList['emailAddress'] = $peopleObj->getEmailAddress();
    $infoList['eventPosition']    = $eventPosition;
    $infoList['eventPositionOld'] = $eventPositionOld;
    
    echo Util::parseInfo($infoList);
    
    exit;
  }

  public function executeResetEventPosition($request){
    
    $peopleId      = $request->getParameter('peopleId');
    $eventPosition = $request->getParameter('eventPosition');

	Util::executeQuery('UPDATE event_live_player SET event_position = NULL WHERE event_live_id = '.$this->eventLiveId.' AND event_position='.$eventPosition);
    
    exit;
  }
  
  public function executeSaveResult($request){
    
    $publish      = $request->getParameter('publish');
    $eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
	
	$players      = $eventLiveObj->getPlayers();
	$peopleIdList = array(0);
	
	$lastValidEventPosition = 0;
	
	for($eventPosition=1; $eventPosition <= $players; $eventPosition++){
		
		$peopleId = $request->getParameter('peopleIdPosition-'.$eventPosition);
		$prize    = $request->getParameter('prize-'.$eventPosition);
		$score    = $request->getParameter('score-'.$eventPosition);
		
		if( !$peopleId )
			continue;
		
		$lastValidEventPosition = $eventPosition;
		
		$prize = Util::formatFloat($prize);
		$score = Util::formatFloat($score);
			
		$peopleIdList[] = $peopleId;
		Util::executeQuery('UPDATE event_live_player SET event_position = '.$eventPosition.', prize='.$prize.', score='.$score.' WHERE event_live_id = '.$this->eventLiveId.' AND people_id='.$peopleId);
	}
	
	Util::executeQuery('UPDATE event_live_player SET event_position = null, prize=0 WHERE event_live_id = '.$this->eventLiveId.' AND people_id NOT IN ('.implode(',', $peopleIdList).')');

	if( $publish ){
		
		// Coloca por últimos os jogadores que não marcaram em que posição sairam
		$criteria = new Criteria();
		$criteria->add( EventLivePlayerPeer::PEOPLE_ID, $peopleIdList, Criteria::NOT_IN );
		foreach($eventLiveObj->getEventLivePlayerList($criteria) as $eventLivePlayerObj){
			$eventLivePlayerObj->setEventPosition(++$lastValidEventPosition);
			$eventLivePlayerObj->save();
		}
	}
	
	exit;
  }
  
//  public function executeCalculateResult($request){
//    
//    $eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
//	
//	$scoreList = array();
//	foreach($eventLiveObj->getEventLivePlayerList() as $eventLivePlayerObj){
//		
//		$eventPosition = $eventLivePlayerObj->getEventPosition();
//		$score         = $eventLiveObj->parseScore($eventPosition, $events, $prize, $players, $totalBuyins, $defaultBuyin, $itm);
//		$scoreList[$eventPosition] = $score;
//	}
//	
//	echo '<pre>';
//	print_r($scoreList);
//	
//	exit;
//  }
}
