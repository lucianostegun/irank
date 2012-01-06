<?php

class contactActions extends sfActions
{

  public function executeIndex($request){
	
  }

  public function handleErrorSend(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSend($request){

	$userSiteObj  = UserSite::getCurrentUser();
	$fullName     = $request->getParameter('fullName');
	$emailAddress = $request->getParameter('emailAddress');
	$subject      = $request->getParameter('subject');
	$message      = $request->getParameter('message');
	
	$emailContent = AuxiliarText::getContentByTagName('contactMessage', false, 'pt_BR');
	$emailContent = str_replace('<fullName>', $fullName, $emailContent);
	$emailContent = str_replace('<emailAddress>', $emailAddress, $emailContent);
	$emailContent = str_replace('<subject>', $subject, $emailContent);
	$emailContent = str_replace('<message>', $message, $emailContent);
	
	if( is_object($userSiteObj))
		$emailContent = str_replace('<username>', $userSiteObj->getUserName(), $emailContent);
	
	$emailAddress = 'lucianostegun@gmail.com';
	$options      = array();
	
	$options['emailTemplate']  = 'emailTemplateAdmin';
	$options['contentType']    = 'text/plain';
	$options['entitiesEncode'] = false;
	
	Report::sendMail('Contato iRank', $emailAddress, $emailContent, $options);
	exit;
  }
}
