<?php

/**
 * poll actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Guilherme Sathler
 */
class pollActions extends sfActions
{

  public function preExecute(){
    
    $this->pollId = $this->getRequestParameter('id');
    $this->pollId = $this->getRequestParameter('pollId', $this->pollId);
    
    $this->pathList = array('Enquetes'=>'poll/index');
    $this->toolbarList = array('new');
  }

  public function executeIndex($request){
    
  }

  public function executeUpload($request){
    
  }
 
  public function executeNew($request){
  	
    $this->pollObj = Util::getNewObject('poll');
    
    $this->pathList['Nova enquete'] = '#';
    $this->setTemplate('edit');
    
    $this->toolbarList = array('new', 'save');
  }
  
  public function executeEdit($request){
    
    $this->pollObj = $pollObj = PollPeer::retrieveByPK($this->pollId);
    
    if( !is_object($pollObj) )
    	return $this->redirect('poll/index');
    	
    $this->pathList[$pollObj->getQuestion()] = '#';
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $pollObj = PollPeer::retrieveByPK($this->pollId);
    
    $pollObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->pollId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( PollPeer::ID, $this->pollId, Criteria::IN );
	    $criteria->add( PollPeer::VISIBLE, true );
	    $criteria->add( PollPeer::ENABLED, true );
	    $criteria->add( PollPeer::DELETED, false );
    	$pollObjList = PollPeer::doSelect($criteria);
    	
    	$pollIdList = array();
    	foreach($pollObjList as $pollObj){
    		
    		$pollObj->delete();
	    	$pollIdList[] = $pollObj->getId();
    	}
    	
    	echo implode(',', $pollIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
  
  public function executeUploadImage($request){
	
    $userAdminId  = $request->getParameter('userAdminId');
    $userAdminObj = UserAdminPeer::retrieveByPK($userAdminId);
    
    if( !is_object($userAdminObj) )
    	throw new Exception('Usuário não definido para carregamento da imagem');
    
    $fileName = $request->getFileName('Filedata');
	$fileName = preg_replace('/(\.[^\.]*)$/', '-'.$this->pollId.'\1', $fileName);
	
    if( !$userAdminObj->getMaster() ){
    	
	    $username = $userAdminObj->getUsername();
	    $pollObj  = PollPeer::retrieveByPK($this->pollId);

    	Log::doLog('Usuário <b>'.$username.'</b> tentou carregar o arquivo <b>'.$fileName.'</b> para a enquete <b>'.$pollObj->getId().'</b>.', 'Poll', array(), Log::LOG_CRITICAL);
    	throw new Exception('Você não tem permissão para editar esse registro!');
    }

	$allowedExtensionList = array('jpg', 'jpeg', 'png');
	$maxFileSize          = (1024*300);
	
	$options = array('allowedExtensionList'=>$allowedExtensionList,
					 'maxFileSize'=>$maxFileSize,
					 'noFile'=>true,
					 'fileName'=>$fileName);

	try {

		$fileObj = File::upload($request, 'Filedata', '/images/poll', $options);

		$pollObj = PollPeer::retrieveByPK($this->pollId);
		$pollObj->setPollImage($fileName);
		$pollObj->save();
	}catch( Exception $e ){

		Util::forceError($e);	
	}
	
	exit;
  }
  
  public function executeDownloadImage($request){

	$pollObj          = PollPeer::retrieveByPK($this->pollId);
	$fileName         = $pollObj->getFileNameLogo();
	$originalFileName = $pollObj->getFileNameLogo(true);
	$fileExtension    = File::getFileExtension($fileName);
	$filePath         = Util::getFilePath('/images/poll/'.$fileName);

	header('Content-type: image/png');
	Util::forceDownload($originalFileName, 'image/'.$fileExtension);

	echo file_get_contents($filePath);
	
  	exit;
  }
  
}