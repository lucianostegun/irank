<?php

/**
 * club actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class clubActions extends sfActions
{

  public function preExecute(){
    
    $this->clubId = $this->getRequestParameter('id');
    $this->clubId = $this->getRequestParameter('clubId', $this->clubId);
    $this->clubId = $this->getUser()->getAttribute('clubId', $this->clubId);
    
    $this->clubIdAttribute = $this->getUser()->getAttribute('clubId');
    
    $this->pathList = array('Clubes'=>'club/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeUpload($request){
    
  }

  public function executeNew($request){
  	
    $this->clubObj = Util::getNewObject('club');
    
    $this->pathList['Novo clube'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->clubObj = $clubObj = ClubPeer::retrieveByPK($this->clubId);
    
    if( !is_object($clubObj) )
    	return $this->redirect('club/index');
    	
    $this->visitCountValue = $clubObj->getVisitCount();
    
    $this->pathList[$clubObj->getClubName()] = '#';
    
    if( $this->clubIdAttribute )
    	$this->toolbarList = array('save');
    else
    	$this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $clubId = $this->getUser()->getAttribute('clubId');
	
    if( $clubId && $clubId!=$this->clubId ){
    	
	    $username = $this->getUser()->getAttribute('username');

    	Log::doLog('Usuário <b>'.$username.'</b> tentou editar as informações do clube <b>('.$clubObj->getId().') '.$clubObj->toString().'</b>.', 'Club', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse registro!');
    }
    
    $clubObj = ClubPeer::retrieveByPK($this->clubId);
    
    $clubObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->clubId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( ClubPeer::ID, $this->clubId, Criteria::IN );
	    $criteria->add( ClubPeer::VISIBLE, true );
	    $criteria->add( ClubPeer::ENABLED, true );
	    $criteria->add( ClubPeer::DELETED, false );
    	$clubObjList = ClubPeer::doSelect($criteria);
    	
    	$clubIdList = array();
    	foreach($clubObjList as $clubObj){
    		
    		$clubObj->delete();
	    	$clubIdList[] = $clubObj->getId();
    	}
    	
    	echo implode(',', $clubIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
  
  public function executeUploadLogo($request){
  	
    $userAdminId  = $request->getParameter('userAdminId');
    $userAdminObj = UserAdminPeer::retrieveByPK($userAdminId);
    
    if( !is_object($userAdminObj) )
    	throw new Exception('Usuário não definido para carregamento da imagem');
    
    $clubId   = $userAdminObj->getClubId();
	$fileName = $request->getFileName('Filedata');
	$fileName = preg_replace('/(\.[^\.]*)$/', '-'.$this->clubId.'\1', $fileName);
	
    if( $clubId && $clubId!=$this->clubId ){
    	
	    $username = $userAdminObj->getUsername();
	    $clubObj  = ClubPeer::retrieveByPK($this->clubId);

    	Log::doLog('Usuário <b>'.$username.'</b> tentou carregar o arquivo <b>'.$fileName.'</b> para o clube <b>('.$clubObj->getId().') '.$clubObj->toString().'</b>.', 'Club', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse registro!');
    }

	$allowedExtensionList = array('jpg', 'jpeg', 'png');
	$maxFileSize          = (1024*300);
	
	$options = array('allowedExtensionList'=>$allowedExtensionList,
					 'maxFileSize'=>$maxFileSize,
					 'noFile'=>true,
					 'fileName'=>$fileName,
					 'minWidth'=>122,
					 'maxWidth'=>122,
					 'minHeight'=>122,
					 'maxHeight'=>122);

	try {

		$fileObj = File::upload($request, 'Filedata', '/images/club', $options);

		Club::customizeLogo($fileName);

		$clubObj = ClubPeer::retrieveByPK($this->clubId);
		$clubObj->setFileNameLogo($fileName);
		$clubObj->save();
	}catch( Exception $e ){

		Util::forceError($e);	
	}
	
	exit;
  }
  
  public function executeCustomizeLogo($request){
  	
    $clubObj = ClubPeer::retrieveByPK($this->clubId);

    Club::customizeLogo($clubObj->getFileNameLogo());
		
	exit;
  }
  
  public function executeDownloadLogo($request){

	$clubObj          = ClubPeer::retrieveByPK($this->clubId);
	$fileName         = $clubObj->getFileNameLogo();
	$originalFileName = $clubObj->getFileNameLogo(true);
	$fileExtension    = File::getFileExtension($fileName);
	$filePath         = Util::getFilePath('/images/club/'.$fileName);

	header('Content-type: image/png');
	Util::forceDownload($originalFileName, 'image/'.$fileExtension);

	
	
	echo file_get_contents($filePath);
	
  	exit;
  }
  
  public function executeUploadPhotos($request){
	
	$clubPhotoObj = Club::uploadPhoto($request, $this->clubId);
	
	if( is_object($clubPhotoObj) ){
		
		$clubPhotoId = $clubPhotoObj->getId();
		echo '{"jsonrpc" : "2.0", "result" : "sucesso", "id" : "'.$clubPhotoId.'"}';
	}else{
		
		Util::forceError('Erro ao carregar a imagem');
	}
	
  	exit;
  }
  
  public function executeDeletePhoto($request){
	
	$clubPhotoId  = $request->getParameter('clubPhotoId');
	$clubPhotoObj = ClubPhotoPeer::retrieveByPK($clubPhotoId);
	
	$clubPhotoObj->delete();
	
  	exit;
  }

  public function executeGetCalendar($request){

	$eventList = array();
	
	$criteria = new Criteria();
	$criteria->add( EventLivePeer::EVENT_DATE, date('Y-m-d', mktime(0,0,0,date('m')-1, 1, date('Y'))), Criteria::GREATER_EQUAL );
	$criteria->addAnd( EventLivePeer::EVENT_DATE, date('Y-m-d', mktime(0,0,0,date('m')+3, 0, date('Y'))), Criteria::LESS_EQUAL );
	
	if( $this->clubId ){
		
		$clubObj = ClubPeer::retrieveByPK($this->clubId);
		$eventLiveObjList = $clubObj->getEventList($criteria);
	}else{
		
		$eventLiveObjList = EventLive::getList($criteria);
	}
	
	Util::getHelper('Url');
	
	foreach($eventLiveObjList as $eventLiveObj){
		
		$event = array('title'=>$eventLiveObj->toString(), 
					   'start'=>date('r', $eventLiveObj->getEventDateTime(null)), 
					   'allDay'=>false, 
					   'color'=>'#d57656', 
					   'url'=>url_for('eventLive/edit?id='.$eventLiveObj->getId()));
		$eventList[] = $event;
	}
	
	echo Util::parseInfo($eventList);

  	exit;
  }
}
