<?php

class eventPersonalActions extends sfActions
{

  public function preExecute(){

	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
	$this->peopleId   = $this->getUser()->getAttribute('peopleId');
	
	$eventPersonalId = $this->getRequestParameter('eventPersonalId');
	
	if( $eventPersonalId )
		$this->eventPersonalObj = EventPersonalPeer::retrieveByPK( $eventPersonalId );
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$this->criteria    = new Criteria();
  	$this->innerMenu   = 'eventPersonal/include/mainMenuIndex';
  	$this->innerObj    = new EventPersonal();
  }

  public function executeNew($request){

	return $this->forward('eventPersonal', 'edit');
  }
  
  public function executeEdit($request){
  	
  	$viewComment   = $request->getParameter('viewComment');
  	$viewComment   = base64_decode(strrev($viewComment));
  	
  	$eventPersonalId = $request->getParameter('eventPersonalId', $viewComment);
  	$this->isClone   = $request->getParameter('isClone');
  	
  	if( $eventPersonalId ){
  		
		$this->eventPersonalObj = EventPersonalPeer::retrieveByPK( $eventPersonalId );

		if( !is_object($this->eventPersonalObj) )
			return $this->redirect('eventPersonal/index');
		
		if( !$this->eventPersonalObj->isMyEvent() )
			$this->setTemplate('show');
  	}else{
		
		$this->eventPersonalObj = new EventPersonal();
  	}
	  	
  	$this->innerObj = $this->eventPersonalObj;
  }
  
  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSave($request){

	Util::getHelper('I18N');
	
	$eventPersonalId = $request->getParameter('eventPersonalId');
	$gameStyleId     = $request->getParameter('gameStyleId');
	$eventName       = $request->getParameter('eventName');
	$eventPlace      = $request->getParameter('eventPlace');
	$eventDate       = $request->getParameter('eventDate');
	$eventPosition   = $request->getParameter('eventPosition');
	$players         = $request->getParameter('players');
	$paidPlaces      = $request->getParameter('paidPlaces');
	$buyin           = $request->getParameter('buyin');
	$rebuy           = $request->getParameter('rebuy');
	$addon           = $request->getParameter('addon');
	$prize           = $request->getParameter('prize');
	$comments        = $request->getParameter('comments');
	$isClone         = $request->getParameter('isClone');

	if( $eventPersonalId )		
		$eventPersonalObj  = EventPersonalPeer::retrieveByPK( $eventPersonalId );
	else
		$eventPersonalObj = new EventPersonal();
	
	$isNew = $eventPersonalObj->isNew();
	
	if( !$eventPersonalObj->isEditable() )
		Util::forceError('!'.__('event.lockedEvent'), true);
		
	$isClone = ($isClone && !$eventPersonalObj->getEnabled());
	
	if( !$eventPersonalObj->getUserSiteId() )
		$eventPersonalObj->setUserSiteId( $this->userSiteId );
		
	$eventPersonalObj->setEventName( $eventName );
	$eventPersonalObj->setGameStyleId( $gameStyleId );
	$eventPersonalObj->setEventPlace( $eventPlace );
	$eventPersonalObj->setEventDate( Util::formatDate($eventDate) );
	$eventPersonalObj->setEventPosition( $eventPosition );
	$eventPersonalObj->setPaidPlaces( ($paidPlaces?$paidPlaces:0) );
	$eventPersonalObj->setPlayers( ($players?$players:0) );
	$eventPersonalObj->setBuyin( Util::formatFloat($buyin) );
	$eventPersonalObj->setRebuy( Util::formatFloat($rebuy) );
	$eventPersonalObj->setAddon( Util::formatFloat($addon) );
	$eventPersonalObj->setPrize( Util::formatFloat($prize) );
	$eventPersonalObj->setComments(nvl($comments));
	$eventPersonalObj->setVisible(true);
	$eventPersonalObj->setEnabled(true);
	$eventPersonalObj->save();
	
    echo Util::parseInfo($eventPersonalObj->getInfo());
    exit;
  }
  
  public function executeDelete($request){

//	Util::getHelper('I18N');
	
	$eventPersonalId  = $request->getParameter('eventPersonalId');
	$eventPersonalObj = EventPersonalPeer::retrieveByPK( $eventPersonalId );
	
	if( !is_object($eventPersonalObj) )
		throw new Exception(__('eventNotFound'));
	
	$eventPersonalObj->delete();
	exit;
  }
  
  public function executeCloneEvent($request){
  	
  	$eventPersonalId = $request->getParameter('eventPersonalId');
  	
	$eventPersonalObj = EventPersonalPeer::retrieveByPK( $eventPersonalId );
	$eventPersonalObj = $eventPersonalObj->getClone();
	
	$request->setParameter('eventPersonalId', $eventPersonalObj->getId());
	$request->setParameter('isClone', true);
	return $this->forward('eventPersonal', 'edit');
  }

  public function executeSearch($request){
  	
  	$renderize  = $request->getParameter('isIE');
  	$eventName  = $request->getParameter('eventName');
  	$eventPlace = $request->getParameter('eventPlace');
  	$eventDate  = $request->getParameter('eventDate');
  	
  	if( !Validate::validateDate($eventDate) )
  		$eventDate = null;

  	$criteria = new Criteria();
  	if( $eventName )  $criteria->addAnd( EventPersonalPeer::EVENT_NAME, '%'.$eventName.'%', Criteria::ILIKE );
  	if( $eventDate )  $criteria->addAnd( EventPersonalPeer::EVENT_DATE, Util::formatDate($eventDate) );
  	if( $eventPlace ) $criteria->addAnd( EventPersonalPeer::EVENT_PLACE, '%'.$eventPlace.'%', Criteria::ILIKE );	

	if( $renderize ){
		
		$this->criteria = $criteria;
		$this->setTemplate('index');
	}else{
	  	
	  	sfConfig::set('sf_web_debug', false);
		sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
		return $this->renderText(get_partial('eventPersonal/include/search', array('criteria'=>$criteria)));
	}  	
  }
}
