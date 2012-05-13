<?php

class feedbackActions extends sfActions
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
	$message      = $request->getParameter('message');
	
	$emailContent = EmailTemplate::getContentByTagName('feedbackMessage', false, 'pt_BR');

	$emailContent = str_replace('<fullName>', $fullName, $emailContent);
	$emailContent = str_replace('<emailAddress>', $emailAddress, $emailContent);
	$emailContent = str_replace('<message>', $message, $emailContent);
	
	if( is_object($userSiteObj))
		$emailContent = str_replace('<username>', $userSiteObj->getUserName(), $emailContent);

	$emailAddress = 'lucianostegun@gmail.com';
	$options      = array();
	
	$options['emailTemplate']  = 'emailTemplateAdmin';
	$options['contentType']    = 'text/plain';
	$options['entitiesEncode'] = false;
	
	Report::sendMail('Feedback iRank', $emailAddress, $emailContent, $options);
	exit;
  }
}
