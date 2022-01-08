<?php

class emailOptionActions extends sfActions
{

  public function preExecute(){

	$isAuthenticated = $this->getUser()->isAuthenticated();
	
	if( $isAuthenticated )
		return $this->redirect('myAccount/index?tab=email');
  }

  public function executeIndex($request){

	$this->emailAddress = $request->getParameter('emailAddress');
	$emailToken         = $request->getParameter('emailToken');
	$emailTokenCheck    = Util::getToken($this->emailAddress);
	
	if( $emailTokenCheck!=$emailToken )
		return $this->redirect('home/index');
		
	$this->emailToken = $emailToken;
  }

  public function executeSave($request){

	$emailAddress    = $request->getParameter('emailAddress');
	$emailToken      = $request->getParameter('emailToken');
	$emailTokenCheck = Util::getToken($emailAddress);
	
	if( $emailTokenCheck!=$emailToken )
		throw new Exception('invalidToken');
		
	try{
			
		People::saveEmailOption($request);
		exit('success');
	}catch(Exception $e){
		
		Util::forceError('!'.$e->getMessage());
	}
	
	exit;
  }
}
