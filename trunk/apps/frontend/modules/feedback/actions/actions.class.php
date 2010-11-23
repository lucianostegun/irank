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
	$message      = str_replace(chr(10), '<br/>', $message);
	
	$emailContent = AuxiliarText::getContentByTagName('feedbackMessage');
	$emailContent = str_replace('<fullName>', $fullName, $emailContent);
	$emailContent = str_replace('<emailAddress>', $emailAddress, $emailContent);
	$emailContent = str_replace('<message>', $message, $emailContent);
	
	if( is_object($userSiteObj))
		$emailContent = str_replace('<username>', $userSiteObj->getUserName(), $emailContent);

	$emailAddress = 'lucianostegun@gmail.com';
	$options      = array();
	
	$options['emailTemplate'] = 'emailTemplateAdmin';
	
	Report::sendMail('Feedback iRank', $emailAddress, $emailContent, $options);
	exit;
  }
}
