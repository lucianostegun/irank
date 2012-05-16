<?php

/**
 * emailMarketing actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class emailMarketingActions extends sfActions
{

  public function preExecute(){
    
    $this->emailMarketingId = $this->getRequestParameter('id');
    $this->emailMarketingId = $this->getRequestParameter('emailMarketingId', $this->emailMarketingId);
   
    $this->pathList    = array('Marketings de e-mail'=>'emailMarketing/index');
    $this->toolbarList = array('new');
  }
  
  public function executeIndex($request){
    
  }

  public function executeNew($request){
    
    $this->emailMarketingObj = Util::getNewObject('emailMarketing');
    
    $this->pathList['Novo e-mail'] = '#';
    $this->toolbarList = array('save');
    $this->setTemplate('edit');
  }
  
  public function executeEdit($request){
    
    $this->emailMarketingObj = $emailMarketingObj = EmailMarketingPeer::retrieveByPK($this->emailMarketingId);
    
    if( !is_object($emailMarketingObj) )
    	return $this->redirect('emailMarketing/index');
    
    $this->pathList[$emailMarketingObj->toString()] = '#';
    $this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $emailMarketingObj = EmailMarketingPeer::retrieveByPK($this->emailMarketingId);
    
    $emailMarketingObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->emailMarketingId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( EmailMarketingPeer::ID, $this->emailMarketingId, Criteria::IN );
	    $criteria->add( EmailMarketingPeer::VISIBLE, true );
	    $criteria->add( EmailMarketingPeer::ENABLED, true );
	    $criteria->add( EmailMarketingPeer::DELETED, false );
    	$emailMarketingObjList = EmailMarketingPeer::doSelect($criteria);
    	
    	$emailMarketingIdList = array();
    	foreach($emailMarketingObjList as $emailMarketingObj){
    		
		    $emailMarketingObj->delete();
	    	$emailMarketingIdList[] = $emailMarketingObj->getId();
    	}
    	
    	echo implode(',', $emailMarketingIdList);
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
  
  public function executeUpload($request){
  }
  
  public function executeUploadFile($request){
  	
    $userAdminId  = $request->getParameter('userAdminId');
    $userAdminObj = UserAdminPeer::retrieveByPK($userAdminId);
    
    if( !is_object($userAdminObj) )
    	throw new Exception('Usuário não definido para carregamento do arquivo');
    
    $fileName = $request->getFileName('Filedata');
	$fileName = preg_replace('/(\.[^\.]*)$/', '-'.$this->clubId.'\1', $fileName);
	
    $allowedExtensionList = array('htm', 'html');
	$maxFileSize          = (1024*300);
	
	try {

		$emailMarketingObj = EmailMarketingPeer::retrieveByPK($this->emailMarketingId);
		
		$options = array('allowedExtensionList'=>$allowedExtensionList,
						 'maxFileSize'=>$maxFileSize,
						 'fileId'=>$emailMarketingObj->getFileId());
		
		$uploadDir = '/temp/emailMarketing';
		
		if( !$emailMarketingObj->getIsNew() ){
			
			$options['fileName'] = $emailMarketingObj->getTagName();
			$uploadDir = '/templates/email/marketing';
		}
					 
		$fileObj = File::upload($request, 'Filedata', $uploadDir, $options);

		$emailMarketingObj->setFileId($fileObj->getId());
		$emailMarketingObj->save();
	}catch( Exception $e ){

		Util::forceError($e);	
	}
	
	exit;
  }
  
  public function executeDownloadFile($request){

	$emailMarketingObj = EmailMarketingPeer::retrieveByPK($this->emailMarketingId);
	$emailMarketingObj->getFile()->download();
	
  	exit;
  }
  
  public function executeSendEmailPreview($request){

	$emailMarketingObj = EmailMarketingPeer::retrieveByPK($this->emailMarketingId);
	
	$emailAddress = Settings::getValue('emailDebug');
	$emailSubject = 'Preview: '.$emailMarketingObj->getEmailSubject();
	$emailContent = $emailMarketingObj->getContentPreview(false);
	$emailContent = Report::defaultReplace($emailContent);
	
	$options = array('emailMarketingObj'=>$emailMarketingObj);

	Report::sendMail($emailSubject, $emailAddress, $emailContent, $options);
	
  	exit;
  }

  public function executeGetTabContent($request){
    
    $tabName          = $request->getParameter('tabName'); 
    $emailMarketingObj = EmailMarketingPeer::retrieveByPK($this->emailMarketingId);

  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('emailMarketing/tab/'.$tabName, array('emailMarketingObj'=>$emailMarketingObj)));
  }

  public function executeGetPeopleList($request){
    
    $isUserSite      = $request->getParameter('isUserSite');
    $isRankingPlayer = $request->getParameter('isRankingPlayer');
    
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('emailMarketing/include/people', array('emailMarketingId'=>$this->emailMarketingId, 'isUserSite'=>$isUserSite, 'isRankingPlayer'=>$isRankingPlayer)));
  }
  
  public function executeSendEmail($request){
  	
  	$peopleId          = $request->getParameter('peopleId');
  	$emailMarketingObj = EmailMarketingPeer::retrieveByPK($this->emailMarketingId);
  	
  	if( !is_object($emailMarketingObj) )
	  	throw new Exception('E-mail não encontrado');
  	
  	try{
  		
	  	$emailMarketingObj->sendEmail($peopleId);
  	}catch(Exception $e){
  		
  		Util::forceError('Ocorreu um erro no envio desse e-mail!', false);
  		
  		if( Util::isDebug() )
  			echo $e->getMessage();
  	}
  	
  	exit;
  }
}
