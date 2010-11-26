<?php

class rankingActions extends sfActions
{

  public function preExecute(){
	
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
  }
  
  public function executeNew($request){

	return $this->forward('ranking', 'edit');
  }
  
  public function executeEdit($request){
  	
  	$rankingId = $request->getParameter('rankingId');
  	
  	if( $rankingId ){
  		
		$this->rankingObj = RankingPeer::retrieveByPK( $rankingId );
		
		if( !is_object($this->rankingObj) )
			return $this->redirect('ranking/index');
		
		if( !$this->rankingObj->isMyRanking() )
			$this->setTemplate('show');
  	}else{
		
		$rankingTypeId     = VirtualTable::getIdByTagName('rankingType', 'position');
		$requiredFieldList = array('userSiteId'=>$this->userSiteId, 'rankingTypeId'=>$rankingTypeId );
		
		$this->rankingObj = Util::getNewObject('ranking', $requiredFieldList);
		
		if( !is_object($this->rankingObj) )
			return $this->redirect('ranking/index');
  	}
	
	$this->rankingObj->addPlayer( $this->rankingObj->getUserSite()->getPeopleId() );
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSave($request){

	$rankingId     = $request->getParameter('rankingId');
	$rankingName   = $request->getParameter('rankingName');
	$gameStyleId   = $request->getParameter('gameStyleId');
	$startDate     = $request->getParameter('startDate');
	$finishDate    = $request->getParameter('finishDate');
	$isPrivate     = $request->getParameter('isPrivate');
	$rankingTypeId = $request->getParameter('rankingTypeId');
	$defaultBuyin  = $request->getParameter('defaultBuyin');

	$rankingObj = RankingPeer::retrieveByPK( $rankingId );

	$updateHistory = ($rankingTypeId!=$rankingObj->getRankingTypeId());

	$rankingObj->setRankingName( $rankingName );
	$rankingObj->setGameStyleId( $gameStyleId );
	$rankingObj->setUserSiteId( $this->userSiteId );
	$rankingObj->setStartDate( Util::formatDate($startDate) );
	$rankingObj->setFinishDate( Util::formatDate($finishDate) );
	$rankingObj->setDefaultBuyin( Util::formatFloat($defaultBuyin) );
	$rankingObj->setIsPrivate( $isPrivate );
	$rankingObj->setRankingTypeId( $rankingTypeId );
	$rankingObj->setVisible(true);
	$rankingObj->setEnabled(true);
	$rankingObj->save();
	
	$rankingObj->updateScores();
	
	if( $updateHistory )
		$rankingObj->updateWholeHistory();

	echo $rankingObj->getId();
	exit;
  }

  public function handleErrorSavePlayer(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSavePlayer($request){

	$rankingId    = $request->getParameter('rankingId');
	$peopleId     = $request->getParameter('peopleId');
  	$firstName    = $request->getParameter('firstName');
  	$lastName     = $request->getParameter('lastName');
  	$emailAddress = $request->getParameter('emailAddress');
	
	$rankingObj = RankingPeer::retrieveByPK( $rankingId );

	$peopleObj = PeoplePeer::retrieveByEmailAddress($emailAddress);
	
	if( !is_object($peopleObj) ){
		
		$peopleObj = People::getQuickPeople($firstName, $lastName, 'rankingPlayer', $peopleId );
		
		$peopleObj->setEmailAddress($emailAddress);
		$peopleObj->save();
	}
	
	$rankingObj->addPlayer( $peopleObj->getId() );
	$rankingObj->addToOpenEvents($peopleObj->getId());
	
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('ranking/include/player', array('rankingObj'=>$rankingObj)));
  }
  
  public function executeDeletePlayer($request){

	$rankingId = $request->getParameter('rankingId');
	$peopleId  = $request->getParameter('peopleId');
	
	$rankingObj = RankingPeer::retrieveByPK( $rankingId );
	
	if( $rankingObj->getUserSite()->getPeopleId()==$peopleId )
		throw new Exception('Não é possível remover este membro do ranking');
	
	$rankingObj->deletePlayer( $peopleId );
	
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('ranking/include/player', array('rankingObj'=>$rankingObj)));
  }
  
  public function executeGetDefaultBuyin($request){

	$rankingId  = $request->getParameter('rankingId');
	$rankingObj = RankingPeer::retrieveByPK( $rankingId );

	echo Util::formatFloat($rankingObj->getDefaultBuyIn(), true);
	
	exit;
  }
  
  public function executeGetRankingHistory($request){

	$rankingId   = $request->getParameter('rankingId');
	$rankingDate = $request->getParameter('rankingDate');
	
	$rankingObj = RankingPeer::retrieveByPK( $rankingId );

    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('ranking/include/classify', array('rankingObj'=>$rankingObj, 'rankingDate'=>$rankingDate)));
  }
  
  public function executeJavascript($request){
  }
  
  
  
  public function executeDebug($request){
  	
  	$rankingId  = $request->getParameter('rankingId');
  	$rankingObj = RankingPeer::retrieveByPK($rankingId);
  	
  	$rankingObj->updateWholeHistory();
  	
  	echo 'ok '.date('d/m/D H:i:s');
  	exit;
  }
}
