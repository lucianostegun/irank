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
    
    $this->iRankAdmin = $this->getUser()->hasCredential('iRankAdmin');
	$this->clubId     = $this->getUser()->getAttribute('clubId');
    
    $this->pathList = array('Eventos ao vivo'=>'eventLive/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeNew($request){
    
    $this->eventLiveObj = Util::getNewObject('eventLive');
    
    $this->eventLiveObj->setDescription('<descrição do ranking>');
    
    $this->pathList['Novo evento'] = '#';
    $this->toolbarList = array('save');
    $this->setTemplate('edit');
  }
  
  public function executeEdit($request){
    
    $this->eventLiveObj = $eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
    
    if( !$eventLiveObj->isMyEvent() ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou acessar as informações do evento <b>('.$eventLiveObj->getId().') '.$eventLiveObj->toString().'</b>.', 'EventLive', array(), Log::LOG_CRITICAL);
    	$eventLiveObj = null;
    }
    
    $this->mainBalanceLabel   = 'Total arrecadado';
    $this->mainBalanceValue   = $this->eventLiveObj->getTotalBuyin(true);
    $this->mainBalanceBase    = $this->eventLiveObj->getTotalBuyin();
    $this->mainBalancePercent = 0;
    
    if( !is_object($eventLiveObj) )
    	return $this->redirect('eventLive/index');
    
    $this->numStatList = array('Visitas'=>$eventLiveObj->getVisitCount(),
    						   'Inscrições'=>$eventLiveObj->getPlayers(false, true),
    						   'Confirm.'=>$eventLiveObj->getPlayers());
    	
    if( $eventLiveObj->getRankingLiveId() ){
    	
	    $rankingLiveObj = $eventLiveObj->getRankingLive();
	    $this->pathList[$rankingLiveObj->toString()] = '#goToPage("rankingLive", "edit", "rankingLiveId", '.$rankingLiveObj->getId().', true)';
    }
    
    $this->pathList[$eventLiveObj->toString()] = '#';
    $this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
    
    if( !$eventLiveObj->isMyEvent() ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou editar as informações do evento <b>('.$eventLiveObj->getId().') '.$eventLiveObj->toString().'</b>.', 'EventLive', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse evento!');
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
  
  public function executeFacebookShare($request){
  	
  	$eventLiveId = $request->getParameter('eventLiveId');
  	
  	if(!$eventLiveId)
  		Util::forceError('Parametros inv&aacute;lidos');
  	
  	$this->redirect('http://www.facebook.com/sharer.php?u='.urlencode('http://'.$request->getHost().'/index.php/eventLive/details/eventLiveId/'.$eventLiveId));
  	
  	exit;	
  }
  
  public function executeAutoComplete($request){
    
	$peopleName   = $request->getParameter('term');
	$instanceName = $request->getParameter('instanceName');
	$suggestNew   = $request->getParameter('suggestNew');

	$nl = chr(10);

	$emailAddress = null;
	
	if( preg_match('/,/', $peopleName) )
		list($peopleName, $emailAddress) = explode(',', $peopleName);
		
	$peopleName   = str_replace(' ', '%', trim($peopleName));
	$emailAddress = str_replace(' ', '%', trim($emailAddress));
	
	$table      = 'people INNER JOIN event_live_player ON event_live_player.PEOPLE_ID=people.ID AND event_live_player.EVENT_LIVE_ID='.$this->eventLiveId.' AND event_live_player.ENABLED';
	$fieldId    = 'id';
	$fieldName  = "FULL_NAME||', '||COALESCE(EMAIL_ADDRESS, 'Não informado')$nl";
	$fieldValue = "FULL_NAME$nl";
	$condition  = "people.ENABLED AND people.VISIBLE AND NOT people.DELETED $nl";
	$condition .= "AND (event_live_player.EVENT_POSITION IS NULL OR event_live_player.EVENT_POSITION=0) $nl";
	$condition .= "AND ((no_accent(full_name) ILIKE no_accent('%$peopleName%') OR no_accent(email_address) ILIKE no_accent('%$peopleName%'))";
	
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
    
    $eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
    
    if( !$eventLiveObj->isMyEvent() ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou editar as informações do evento <b>('.$eventLiveObj->getId().') '.$eventLiveObj->toString().'</b>.', 'EventLive', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse evento!');
    }
    
    $eventLiveObj->saveResult($request);

	exit;
  }
  
  public function executeCalculateResult($request){
    
	$eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
	$totalRebuys  = $request->getParameter('totalRebuys');
	$prizeSplit   = $request->getParameter('prizeSplit');
	$prizeConfig   = split(EventLive::PRIZE_SPLIT_PATTERN, $prizeSplit);
	$paidPlaces   = count($prizeConfig);
	$players      = $eventLiveObj->getPlayers();
	
    $eventLiveObj->setTotalRebuys(Util::formatFloat($totalRebuys));
    $eventLiveObj->setPrizeSplit($prizeSplit);
    $eventLiveObj->save();
	
	$buyin        = $eventLiveObj->getBuyin();
	$rakePercent  = $eventLiveObj->getRakePercent();
	$totalPrize   = $eventLiveObj->getTotalBuyin()+Util::formatFloat($totalRebuys);
	$totalPrize  -= ($totalPrize*$rakePercent/100);
	
	$totalBuyins = $totalPrize/$buyin;
	
	$prizeConfigList = array();
	$prizeConfigList['players'] = $players;
	
	$eventPosition = 0;
	foreach($eventLiveObj->getEventLivePlayerList() as $eventLivePlayerObj){
		
		$eventPosition++;
		
		$prize  = ($eventPosition <= $paidPlaces?$totalPrize*$prizeConfig[$eventPosition-1]/100:0);
		$events = 1; // Mudar para o cálculo da quantidade de eventos que o jogador já participou 
		$score  = $eventLiveObj->parseScore($eventPosition, $events, $prize, $players, $totalBuyins, $buyin, $prize);
		
		$prizeConfigList[$eventPosition] = array('score'=>$score, 'prize'=>$prize);
	}
	
	echo Util::parseInfo($prizeConfigList);
	exit;
  }
  
  public function executeUploadPhotos($request){
	
	$eventLiveObj = EventLivePeer::retrieveByPK($this->eventLiveId);
	
	if( !$eventLiveObj->isMyEvent() ){
    	
	    $username = $this->getUser()->getAttribute('username');
	    
	    $options  = array('noFile'=>true, 'noLog'=>true, 'maxFileSize'=>'4m');
	    $fileObj  = File::upload( $request, 'file', 'error', $options );
	    $fileName = $fileObj->getFileName();

    	Log::doLog('Usuário <b>'.$username.'</b> tentou enviar a imagem "'.$fileName.'" para o evento <b>('.$eventLiveObj->getId().') '.$eventLiveObj->toString().'</b>.', 'EventLive', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para enviar fotos para esse evento!');
    }
	
	$eventLivePhotoObj = EventLive::uploadPhoto($request, $this->eventLiveId);
	
	if( is_object($eventLivePhotoObj) ){
		
		$eventLivePhotoId = $eventLivePhotoObj->getId();
		echo '{"jsonrpc" : "2.0", "result" : "sucesso", "id" : "'.$eventLivePhotoId.'"}';
	}else{
		
		Util::forceError('Erro ao carregar a imagem');
	}
	
  	exit;
  }
  
  public function executeDeletePhoto($request){
	
	$eventLivePhotoId  = $request->getParameter('eventLivePhotoId');
	$eventLivePhotoObj = EventLivePhotoPeer::retrieveByPK($eventLivePhotoId);
	
	$eventLivePhotoObj->delete();
	
  	exit;
  }

  public function executeGetPhotoList($request){
    
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('eventLive/include/photos', array('eventLiveId'=>$this->eventLiveId)));
  }
}
