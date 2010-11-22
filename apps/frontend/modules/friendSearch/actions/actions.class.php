<?php

class friendSearchActions extends sfActions
{

  public function executeIndex($request){

	$this->criteria = null;
	
	$this->peopleName   = null;
	$this->emailAddress = null;
	
	$peopleObj = People::getCurrentPeople();
	
	$this->peopleName   = $peopleObj->getFullName();
	$this->emailAddress = $peopleObj->getEmailAddress();
  }

  public function handleErrorInviteFriends(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeInviteFriends($request){
  	
  }
  
  public function executeSearch($request){
  	
  	$renderize    = $request->getParameter('isIE');
  	$username     = $request->getParameter('username');
  	$emailAddress = $request->getParameter('emailAddress');

  	$criteria = new Criteria();
  	if( $username ) $criteria->addAnd( UserSitePeer::USERNAME, '%'.$username.'%', Criteria::ILIKE );
  	if( $emailAddress ) $criteria->addAnd( PeoplePeer::EMAIL_ADDRESS, '%'.$emailAddress.'%', Criteria::ILIKE );

	if( !$username && !$emailAddress )
		$criteria = null;

	if( $renderize ){
		
		$this->criteria = $criteria;
		$this->setTemplate('index');
	}else{
	  	
	  	sfConfig::set('sf_web_debug', false);
		sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
		return $this->renderText(get_partial('friendSearch/include/search', array('criteria'=>$criteria)));
	}  	
  }
}
