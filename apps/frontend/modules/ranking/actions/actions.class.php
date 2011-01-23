<?php

class rankingActions extends sfActions
{

  public function preExecute(){

	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
	$this->peopleId   = $this->getUser()->getAttribute('peopleId');
	
	$freeActionList = array('edit', 'getDefaultBuyin', 'getRankingHistory');
	$actionName     = sfContext::getInstance()->getActionName();
		
	$rankingId = $this->getRequestParameter('rankingId');
	
	if( $rankingId && !in_array( $actionName, $freeActionList ) ){

		$this->rankingObj = RankingPeer::retrieveByPK( $rankingId );
		
		if( !$this->rankingObj->isMyRanking() )
			throw new Exception('Você não está autorizado a editar as informações deste ranking!');
	}
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
		
		$this->rankingObj = new Ranking();
  	}
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSave($request){

	$rankingId     = $this->getRequestParameter('rankingId');
	$rankingName   = $request->getParameter('rankingName');
	$gameStyleId   = $request->getParameter('gameStyleId');
	$startDate     = $request->getParameter('startDate');
	$finishDate    = $request->getParameter('finishDate');
	$isPrivate     = $request->getParameter('isPrivate');
	$rankingTypeId = $request->getParameter('rankingTypeId');
	$defaultBuyin  = $request->getParameter('defaultBuyin');

	$rankingObj = $this->rankingObj;

	if( !$rankingId ){
		
		$rankingObj = new Ranking();
		$rankingObj->setUserSiteId($this->userSiteId);
	}
	
	$isNew = $rankingObj->isNew();

	$updateHistory = ($rankingTypeId!=$rankingObj->getRankingTypeId());

	$rankingObj->setRankingName( $rankingName );
	$rankingObj->setGameStyleId( $gameStyleId );
	$rankingObj->setStartDate( Util::formatDate($startDate) );
	$rankingObj->setFinishDate( Util::formatDate($finishDate) );
	$rankingObj->setDefaultBuyin( Util::formatFloat($defaultBuyin) );
	$rankingObj->setIsPrivate( ($isPrivate?true:false) );
	$rankingObj->setRankingTypeId( $rankingTypeId );
	$rankingObj->setVisible(true);
	$rankingObj->setEnabled(true);
	$rankingObj->save();
	
	$rankingObj->addPlayer( $this->peopleId );
	
	if( !$isNew ){
		
		$rankingObj->updateScores();
		
		if( $updateHistory )
			$rankingObj->updateWholeHistory();
	}
	
	echo $rankingObj->getId();
	exit;
  }
  
  public function executeDelete($request){

	$rankingId  = $request->getParameter('rankingId');
	$rankingObj = RankingPeer::retrieveByPK( $rankingId );
	
	if( !is_object($rankingObj) )
		throw new Exception('Ranking não encontrado!');
	
	if( !$rankingObj->isMyRanking() ){
	
		Log::doLog('Tentou excluir ranking sem permissão', 'Ranking', array('PEOPLE_ID'=>$this->peopleId, 'RANKING_ID'=>$rankingId), array('severity'=>Log::LOG_CRITICAL));	
		Util::forceError('Você não tem permissão para excluir este ranking', true);
	}
	
	$rankingObj->delete();
	exit;
  }

  public function handleErrorSavePlayer(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSavePlayer($request){

	$peopleId     = $request->getParameter('peopleId');
  	$firstName    = $request->getParameter('firstName');
  	$lastName     = $request->getParameter('lastName');
  	$emailAddress = $request->getParameter('emailAddress');
	
	$rankingObj = $this->rankingObj;

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

	$peopleId  = $request->getParameter('peopleId');
	
	$rankingObj = $this->rankingObj;
	
	if( $rankingObj->getUserSite()->getPeopleId()==$peopleId )
		throw new Exception('Não é possível remover este membro do ranking');
	
	$rankingObj->deletePlayer( $peopleId );
	
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('ranking/include/player', array('rankingObj'=>$rankingObj)));
  }
  
  public function executeGetPlayerList($request){

	$rankingObj = $this->rankingObj;
	
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('ranking/include/player', array('rankingObj'=>$rankingObj)));
  }

  public function executeGetClassifyList($request){

	$rankingDate = $request->getParameter('rankingDate', null);
	$rankingObj  = $this->rankingObj;
	
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('ranking/include/classify', array('rankingObj'=>$rankingObj, 'rankingDate'=>$rankingDate)));
  }

  public function handleErrorSavePlace(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSavePlace($request){

  	$rankingPlaceId = $request->getParameter('rankingPlaceId');
  	$rankingId      = $request->getParameter('rankingId');
  	$placeName      = $request->getParameter('placeName');
  	$mapsLink       = $request->getParameter('mapsLink');
	
	if( $rankingPlaceId ){
		
		$rankingPlaceObj = RankingPlacePeer::retrieveByPK($rankingPlaceId);
	}else{
		
		$rankingPlaceObj = new RankingPlace();
		$rankingPlaceObj->setRankingId( $rankingId );
	}
		
	$rankingPlaceObj->setPlaceName( $placeName );
	$rankingPlaceObj->setMapsLink( $mapsLink );
	$rankingPlaceObj->save();
	
	echo $rankingPlaceObj->getId();
	exit;	
  }
  
  public function executeToggleShare($request){

	$rankingId = $request->getParameter('rankingId');
	$peopleId  = $request->getParameter('peopleId');
	
	$rankingPlayerObj = RankingPlayerPeer::retrieveByPK( $rankingId, $peopleId );
	$peopleIdOwner    = $rankingPlayerObj->getRanking()->getUserSite()->getPeopleId();
	
	if( $peopleIdOwner==$peopleId || $peopleId==$this->peopleId || !is_object($rankingPlayerObj) )
		throw new Exception('Não é possível habilitar/desabilitar a edição do ranking para esta pessoa');
	
	$rankingPlayerObj->setAllowEdit( !$rankingPlayerObj->getAllowEdit() );
	$rankingPlayerObj->save();
	
    echo ($rankingPlayerObj->getAllowEdit()?'lock':'unlock');
    exit;
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
  	
  	$rankingObj = $this->rankingObj;

  	$rankingObj->updateWholeHistory();
  	$rankingObj->updateScores();
  	
  	echo 'ok ranking '.date('d/m/Y H:i:s');
  	exit;
  }
}
