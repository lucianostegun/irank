<?php

class faqActions extends sfActions
{

  public function executeIndex($request){

  }

  public function handleErrorSend(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }

  public function executeSend($request){

	$question = $request->getParameter('question');

	$faqObj = new Faq();
	$faqObj->setQuestion($question);
	$faqObj->setVisible(false);
	$faqObj->save();
	
	$faqObj->notify();
	exit;
  }
}
