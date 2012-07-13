<?php

/**
 * emailTemplate actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class emailTemplateActions extends sfActions
{

  public function preExecute(){
    
    $this->emailTemplateId = $this->getRequestParameter('id');
    $this->emailTemplateId = $this->getRequestParameter('emailTemplateId', $this->emailTemplateId);
   
    $this->pathList    = array('Templates de e-mail'=>'emailTemplate/index');
    $this->toolbarList = array('new');
  }
  
  public function executeIndex($request){
    
  }

  public function executeNew($request){
    
    $this->emailTemplateObj = Util::getNewObject('emailTemplate');
    
    $this->pathList['Novo template'] = '#';
    $this->toolbarList = array('save');
    $this->setTemplate('edit');
  }
  
  public function executeEdit($request){
    
    $this->emailTemplateObj = $emailTemplateObj = EmailTemplatePeer::retrieveByPK($this->emailTemplateId);
    
    if( !is_object($emailTemplateObj) )
    	return $this->redirect('emailTemplate/index');
    
    $this->pathList[$emailTemplateObj->toString()] = '#';
    $this->toolbarList = array('new', 'save', 'delete');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSave($request){
    
    $emailTemplateObj = EmailTemplatePeer::retrieveByPK($this->emailTemplateId);
    
    $emailTemplateObj->quickSave($request);
    
    exit;
  }

  public function executeDelete($request){
    
    if( empty($this->emailTemplateId) )
    	Util::forceError('!Nenhum registro foi selecionado!');
    
    try{
    	
	    $criteria = new Criteria();
	    $criteria->add( EmailTemplatePeer::ID, $this->emailTemplateId, Criteria::IN );
	    $criteria->add( EmailTemplatePeer::VISIBLE, true );
	    $criteria->add( EmailTemplatePeer::ENABLED, true );
	    $criteria->add( EmailTemplatePeer::DELETED, false );
    	$emailTemplateObjList = EmailTemplatePeer::doSelect($criteria);
    	
    	$emailTemplateIdList = array();
    	foreach($emailTemplateObjList as $emailTemplateObj){
    		
		    $emailTemplateObj->delete();
	    	$emailTemplateIdList[] = $emailTemplateObj->getId();
    	}
    	
    	echo implode(',', $emailTemplateIdList);
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

		$emailTemplateObj = EmailTemplatePeer::retrieveByPK($this->emailTemplateId);
		
		$options = array('allowedExtensionList'=>$allowedExtensionList,
						 'maxFileSize'=>$maxFileSize,
						 'fileId'=>$emailTemplateObj->getFileId());
		
		$uploadDir = '/temp/emailTemplate';
		
		if( !$emailTemplateObj->getIsNew() ){
			
			$options['fileName'] = $emailTemplateObj->getTagName();
			$uploadDir = '/templates/email';
		}
					 
		$fileObj = File::upload($request, 'Filedata', $uploadDir, $options);

		$emailTemplateObj->setFileId($fileObj->getId());
		$emailTemplateObj->save();
	}catch( Exception $e ){

		Util::forceError($e);	
	}
	
	exit;
  }
  
  public function executeDownloadFile($request){

	$emailTemplateObj = EmailTemplatePeer::retrieveByPK($this->emailTemplateId);
	$emailTemplateObj->getFile()->download();
	
  	exit;
  }
  
  public function executeSendEmailPreview($request){

	$emailTemplateObj = EmailTemplatePeer::retrieveByPK($this->emailTemplateId);
	
	$emailAddress = Settings::getValue('emailDebug');
	$emailSubject = 'Preview: '.$emailTemplateObj->toString();
	$emailContent = $emailTemplateObj->getContentPreview(false);
	$emailContent = Report::defaultReplace($emailContent);
	
	$options = array('emailTemplateObj'=>$emailTemplateObj);

	Report::sendMail($emailSubject, $emailAddress, $emailContent, $options);
	
  	exit;
  }

  public function executeGetTabContent($request){
    
    $tabName          = $request->getParameter('tabName'); 
    $emailTemplateObj = EmailTemplatePeer::retrieveByPK($this->emailTemplateId);

  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('emailTemplate/tab/'.$tabName, array('emailTemplateObj'=>$emailTemplateObj)));
  }
}
