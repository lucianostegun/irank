<?php

/**
 * rankingLive actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class rankingLiveActions extends sfActions
{

  public function preExecute(){
    
    $this->rankingLiveId = $this->getRequestParameter('id');
    $this->rankingLiveId = $this->getRequestParameter('rankingLiveId', $this->rankingLiveId);
    
    $this->iRankAdmin = $this->getUser()->hasCredential('iRankAdmin');
	$this->clubId     = $this->getUser()->getAttribute('clubId');
    
    $this->pathList = array('Rakings'.($this->iRankAdmin?' ao vivo':'')=>'rankingLive/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeUpload($request){
    
  }

  public function executeNew($request){
    
    $requiredFieldList = array('gameStyleId'=>VirtualTable::getIdByTagName('gameStyle', 'tournament'),
    						   'gameTypeId'=>VirtualTable::getIdByTagName('gameType', 'holdem'),
    						   'rankingTypeId'=>VirtualTable::getIdByTagName('rankingType', 'score'));
    $this->rankingLiveObj = Util::getNewObject('rankingLive', $requiredFieldList);
    
    $this->pathList['Novo ranking'] = '#';
    $this->toolbarList = array('save');
    $this->setTemplate('edit');
  }
  
  public function executeEdit($request){
    
    $this->rankingLiveObj = $rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
    
    if( !$rankingLiveObj->isMyRanking() ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou acessar as informações do ranking <b>('.$rankingLiveObj->getId().') '.$rankingLiveObj->toString().'</b>.', 'RankingLive', array(), Log::LOG_CRITICAL);
    	$rankingLiveObj = null;
    }
    
    if( !is_object($rankingLiveObj) )
    	return $this->redirect('rankingLive/index');
    	
    $this->pathList[$rankingLiveObj->getRankingName()] = '#';
    $this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
	
    if( !$rankingLiveObj->isMyRanking() ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou editar as informações do ranking <b>('.$rankingLiveObj->getId().') '.$rankingLiveObj->toString().'</b>.', 'RankingLive', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse registro!');
    }
    
    $rankingLiveObj->quickSave($request);
    $rankingLiveObj->saveQuickEvents($request);

    echo Util::parseInfo($rankingLiveObj->getInfo());
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->rankingLiveId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( RankingLivePeer::ID, $this->rankingLiveId, Criteria::IN );
	    $criteria->add( RankingLivePeer::VISIBLE, true );
	    $criteria->add( RankingLivePeer::ENABLED, true );
	    $criteria->add( RankingLivePeer::DELETED, false );
    	$rankingLiveObjList = RankingLivePeer::doSelect($criteria);
    	
    	$rankingLiveIdList = array();
    	foreach($rankingLiveObjList as $rankingLiveObj){
    		
    		$rankingLiveObj->delete();
	    	$rankingLiveIdList[] = $rankingLiveObj->getId();
    	}
    	
    	echo implode(',', $rankingLiveIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
  
  public function executeUploadLogo($request){

	$userAdminId  = $request->getParameter('userAdminId');
    $userAdminObj = UserAdminPeer::retrieveByPK($userAdminId);
    
    $this->getUser()->setCulture('pt_BR');
    
    if( !is_object($userAdminObj) )
    	throw new Exception('Usuário não definido para carregamento da imagem');
    
	$allowedExtensionList = array('jpg', 'jpeg', 'png');
	$maxFileSize          = (1024*300);
	
	$fileName = $request->getFileName('Filedata');
	$fileName = preg_replace('/(\.[^\.]*)$/', '-'.$this->rankingLiveId.'\1', $fileName);
	
	$rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
	
    if( !$rankingLiveObj->isMyRanking($userAdminId) && !$userAdminObj->getMaster() ){
    	
	    $username = $userAdminObj->getUsername();

    	Log::doLog('Usuário <b>'.$username.'</b> tentou carregar o arquivo <b>'.$fileName.'</b> para o ranking <b>'.$rankingLiveObj->toString().'</b>.', 'RankingLive', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse registro!');
    }
	
	$options = array('allowedExtensionList'=>$allowedExtensionList,
					 'maxFileSize'=>$maxFileSize,
					 'noFile'=>true,
					 'fileName'=>$fileName,
					 'minWidth'=>150,
					 'maxWidth'=>150,
					 'minHeight'=>150,
					 'maxHeight'=>150);

	try {
		
		$fileObj = File::upload($request, 'Filedata', '/images/ranking', $options);
		$fileObj->createThumbnail('/images/ranking/small', 90, 90);
		$fileObj->createThumbnail('/images/ranking/thumb', 65, 65);
		
		$rankingLiveObj->setFileNameLogo($fileName);
		$rankingLiveObj->save();
	}catch( Exception $e ){
	
		Util::forceError($e);	
	}
	
	exit;
  }
  
  public function executeDownloadLogo($request){

	$rankingLiveObj   = RankingLivePeer::retrieveByPK($this->rankingLiveId);
	$fileName         = $rankingLiveObj->getFileNameLogo();
	$originalFileName = $rankingLiveObj->getFileNameLogo(true);
	$fileExtension    = File::getFileExtension($fileName);
	$filePath         = Util::getFilePath('/images/ranking/'.$fileName);

	Util::forceDownload($originalFileName, 'image/'.$fileExtension);
	
	echo file_get_contents($filePath);
	
  	exit;
  }

  public function executeGetSelectField($request){
    
    $clubId = $request->getParameter('clubId');
    $prefix = $request->getParameter('prefix');
    
    Util::getHelper('I18N');
    Util::getHelpers();
    
    echo select_tag('rankingLiveId', RankingLive::getOptionsForSelect($clubId, $this->rankingLiveId), array('id'=>$prefix.'RankingLiveId'));
    exit;
  }

  public function executeGetEventLiveList($request){
    
    $rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
    
//    $eventLiveList = array();
//    
//	foreach($rankingLiveObj->getEventLiveList() as $eventLiveObj){
//		
//		$eventLive = array();
////		$eventLive[] = $eventLiveObj->getId();
//		$eventLive[] = $eventLiveObj->getEventName(); 
//		$eventLive[] = $eventLiveObj->getClub()->toString(); 
//		$eventLive[] = $eventLiveObj->getEventDateTime('d/m/Y H:i'); 
//		$eventLive[] = Util::formatFloat($eventLiveObj->getBuyinInfo(), true); 
//		$eventLive[] = $eventLiveObj->getBlindTime(); 
//		$eventLive[] = $eventLiveObj->getStackChips(); 
//	
//		$eventLiveList[] = $eventLive;
//  }
//  
//  $eventList = array('aaData'=>$eventLiveList);
//  echo Util::parseInfo($eventList);exit;
//  echo '<Pre>';print_r($eventList);exit;  
	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('rankingLive/include/event', array('rankingLiveObj'=>$rankingLiveObj)));
  }
  
  public function executeGetClassifyList($request){
  	
  	$rankingDate    = $request->getParameter('rankingDate');
  	$rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
  	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('rankingLive/include/classify', array('rankingLiveObj'=>$rankingLiveObj, 'rankingDate'=>$rankingDate)));
  }

  public function executeGetCalendar($request){
    
	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('rankingLive/include/eventCalendar', array()));
  }

  public function executeGetInfo($request){
    
    $rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
    
    echo Util::parseInfo($rankingLiveObj->getInfo());
    exit;
  }

  public function executeUpdateHistory($request){
    
    $rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
    
    $rankingLiveObj->updateWholeHistory();
    exit;
  }
}
