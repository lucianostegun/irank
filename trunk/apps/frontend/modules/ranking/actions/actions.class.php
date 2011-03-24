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
		
		if( !$this->rankingObj->isMyRanking() ){
			
			Util::getHelper('i18n');
			throw new Exception(__('ranking.exception.editionDenied'));
  		}
	}
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
  	$this->innerMenu   = 'ranking/include/mainMenuIndex';
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
	  
  	$this->innerMenu = 'ranking/include/mainMenu';
  	$this->innerObj  = $this->rankingObj;
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
	
	$rankingObj->addPlayer( $this->peopleId, true );
	
	if( $isNew ){
		
		$rankingObj->resetOptions();
	}else{
		
		$rankingObj->updateScores();
		$rankingObj->saveOptions($request);
		
		if( $updateHistory )
			$rankingObj->updateWholeHistory();
	}
	
	echo $rankingObj->getId();
	exit;
  }
  
  public function executeDelete($request){

	Util::getHelper('i18n');
	$rankingId  = $request->getParameter('rankingId');
	$rankingObj = RankingPeer::retrieveByPK( $rankingId );
	
	if( !is_object($rankingObj) )		
		throw new Exception(__('ranking.exception.rankingNotFound'));
	
	if( !$rankingObj->isMyRanking() ){
	
		Log::doLog('Tentou excluir ranking sem permissão', 'Ranking', array('PEOPLE_ID'=>$this->peopleId, 'RANKING_ID'=>$rankingId), array('severity'=>Log::LOG_CRITICAL));	
		Util::forceError(__('rankin.exception.deleteAttempt'), true);
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
	
	if( $rankingObj->getUserSite()->getPeopleId()==$peopleId ){
	
		Util::getHelper('i18n');	
		throw new Exception(__('ranking.exception.deletePlayerError'));
	}
	
	$rankingObj->deletePlayer( $peopleId );
	exit;
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

  public function executeGetOptionsList($request){

	$rankingObj = $this->rankingObj;
	
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('ranking/form/options', array('rankingObj'=>$rankingObj)));
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

	Util::getHelper('i18n');
	
	$rankingId = $request->getParameter('rankingId');
	$peopleId  = $request->getParameter('peopleId');
	
	$rankingPlayerObj = RankingPlayerPeer::retrieveByPK( $rankingId, $peopleId );
	$peopleIdOwner    = $rankingPlayerObj->getRanking()->getUserSite()->getPeopleId();
	
	if( $peopleIdOwner==$peopleId || $peopleId==$this->peopleId || !is_object($rankingPlayerObj) )
		throw new Exception(__('ranking.exception.shareError'));
	
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

  public function handleErrorImport(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeImport($request){

	$rankingId = $this->getRequestParameter('rankingId');
	
	$rankingObj = RankingPeer::retrieveByPK($rankingId);
	$rankingObj->importData($request);
	exit;
  }
  
  public function executeJavascript($request){
  	
  	Util::getHelper('i18n');
  	
    header('Content-type: text/x-javascript');
	
  	$nl = chr(10);
  	
  	echo 'var i18n_ranking_playerListLoadError          = "'.__('ranking.playerListLoadError').'";'.$nl;
  	echo 'var i18n_ranking_optionsListLoadError         = "'.__('ranking.optionsListLoadError').'";'.$nl;
  	echo 'var i18n_ranking_playersTab_playerDeleteError = "'.__('ranking.playersTab.playerDeleteError').'";'.$nl;
  	echo 'var i18n_ranking_playersTab_logLoadError      = "'.__('ranking.classifyTab.logLoadError').'";'.$nl;
  	echo 'var i18n_ranking_playersTab_shareError        = "'.__('ranking.classifyTab.shareError').'";'.$nl;
  	echo 'var i18n_ranking_deleteConfirm                = "'.__('ranking.deleteConfirm').'";'.$nl;
  	echo 'var i18n_ranking_deleteError                  = "'.__('ranking.deleteError').'";'.$nl;
  	echo 'var i18n_ranking_importSuccessMessage         = "'.__('ranking.importSuccessMessage').'";'.$nl;
  	exit;
  }
  
  public function executeDebug($request){
  	
  	$rankingObj = $this->rankingObj;

  	$rankingObj->updateWholeHistory();
  	$rankingObj->updateScores();
  	
  	echo 'ok ranking '.date('d/m/Y H:i:s');
  	exit;
  }
}
