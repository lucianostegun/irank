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
    
    $this->pathList = array('Rakings ao vivo'=>'rankingLive/index');
  }

  public function executeIndex($request){
    
  }

  public function executeNew($request){
    
    $this->rankingLiveObj = Util::getNewObject('rankingLive');
    
    $this->pathList['Novo ranking'] = '#';
    $this->setTemplate('edit');
  }
  
  public function executeEdit($request){
    
    $this->rankingLiveObj = $rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
    
    if( !is_object($rankingLiveObj) )
    	return $this->redirect('rankingLive/index');
    	
    $this->pathList[$rankingLiveObj->getRankingName()] = '#';
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
    
    $rankingLiveObj->quickSave($request);
    
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

	$allowedExtensionList = array('jpg', 'jpeg', 'png');
	$maxFileSize          = (1024*300);
	
	$fileName = $request->getFileName('Filedata');
	$fileName = preg_replace('/(\.[^\.]*)$/', '-'.$this->rankingLiveId.'\1', $fileName);
	
	$options = array('allowedExtensionList'=>$allowedExtensionList,
					 'maxFileSize'=>$maxFileSize,
					 'noFile'=>true,
					 'fileName'=>$fileName,
					 'minWidth'=>90,
					 'maxWidth'=>90,
					 'minHeight'=>90,
					 'maxHeight'=>90);

	try {
		
		$fileObj = File::upload($request, 'Filedata', '/images/ranking', $options);
		
		$rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
		
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
}
