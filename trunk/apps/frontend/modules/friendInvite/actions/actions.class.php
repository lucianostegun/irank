<?php

class friendInviteActions extends sfActions
{

  public function executeIndex($request){

	$this->criteria = null;
	
	$this->peopleName   = null;
	$this->emailAddress = null;
	
	$peopleObj = People::getCurrentPeople();
	
	if( is_object($peopleObj) ){
		
		$this->peopleName   = $peopleObj->getFullName();
		$this->emailAddress = $peopleObj->getEmailAddress();
	}
  }

  public function handleErrorSendInvite(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSendInvite($request){
  	
  	Util::getHelper('I18N');
  	
  	$peopleName   = $request->getParameter('peopleName');
  	$emailAddress = $request->getParameter('emailAddress');
  	
	$emailContent = AuxiliarText::getContentByTagName('friendInvite');
  	
  	$resultList = array();
  	for($i=1; $i<=10; $i++){
  		
	  	$friendName         = $request->getParameter('friendName'.$i);
	  	$friendEmailAddress = $request->getParameter('emailAddress'.$i);

	  	if( !$friendName || !$friendEmailAddress ){
	  		
	  		$resultList[] = '';
	  		continue;
	  	}
	  	
	  	$peopleObj = PeoplePeer::retrieveByEmailAddress($friendEmailAddress);
	  	if( is_object($peopleObj) && $peopleObj->isPeopleType('userSite') ){
	  	
	  		$userSiteObj  = $peopleObj->getUserSite();
	  		$resultList[] = $userSiteObj->getUsername();
	  		continue;
	  	}
	  	
	  	$emailContentTmp = $emailContent;
	  	$emailContentTmp = str_replace('<peopleName>', $peopleName, $emailContentTmp);
	  	$emailContentTmp = str_replace('<friendName>', $friendName, $emailContentTmp);
	  	$emailContentTmp = str_replace('<emailAddress>', $emailAddress, $emailContentTmp);
	  	
	  	$invite = Report::sendMail(__('email.subject.friendInvite'), $friendEmailAddress, $emailContentTmp);
	  	if($invite)
	  		$resultList[] = 'ok';
	  	else
	  		$resultList[] = 'error';
  	}
  	
  	echo implode('<info>', $resultList);
  	exit;
  }
  
  public function executeJavascript($request){
  	
  	Util::getHelper('i18n');
  	
    header('Content-type: text/x-javascript');
	
  	$nl = chr(10);
  	
  	echo 'var i18n_friendInvite_inviteError       = "'.__('friendInvite.inviteError').'";'.$nl;
  	echo 'var i18n_friendInvite_status.inviteSent = "'.__('friendInvite.status.inviteSent').'";'.$nl;
  	echo 'var i18n_friendInvite_inviteError       = "'.__('friendInvite.status.inviteError').'";'.$nl;
  	echo 'var i18n_friendInvite_alreadyUser       = "'.__('friendInvite.status.alreadyUser').'";'.$nl;
  	echo 'var i18n_friendInvite_warningMessage    = "'.__('friendInvite.warningMessage').'";'.$nl;
  	echo 'var i18n_friendInvite_successMessage    = "'.__('friendInvite.successMessage').'";'.$nl;
  	
  	exit;
  }
}
