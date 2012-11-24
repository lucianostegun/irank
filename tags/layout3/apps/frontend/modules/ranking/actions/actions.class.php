<?php

class rankingActions extends sfActions
{

  public function preExecute(){

	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
	$this->peopleId   = $this->getUser()->getAttribute('peopleId');
	
	$this->rankingId = $this->getRequestParameter('id');
	$this->rankingId = $this->getRequestParameter('rankingId', $this->rankingId);
	
	$freeActionList = array('edit', 'getBuyin', 'getRankingHistory', 'validateUnsubscribe', 'unsubscribe', 'saveMobile', 'share', 'requestSubscription');
	$actionName     = sfContext::getInstance()->getActionName();
		
	$rankingId = $this->getRequestParameter('rankingId');
	
	if( $rankingId && !in_array( $actionName, $freeActionList ) ){

		$this->rankingObj = RankingPeer::retrieveByPK( $rankingId );
		
		if( is_object($this->rankingObj) && !$this->rankingObj->isMyRanking() ){
			
			Util::getHelper('i18n');
			throw new Exception(__('ranking.exception.editionDenied'));
  		}
	}
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
  	$this->innerObj    = new Ranking();
  	
	$this->criteria = new Criteria();
	$this->criteria->addAnd( RankingPeer::FINISH_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
  }
  
  public function executeNew($request){

	return $this->forward('ranking', 'edit');
  }
  
  public function executeEdit($request){
  	
  	$rankingId = $request->getParameter('id');
  	$rankingId = $request->getParameter('rankingId', $rankingId);
  	
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
		$this->rankingObj->setIsPrivate(true);
  	}
	  
  	$this->innerObj  = $this->rankingObj;
  }
  
  public function executeShare($request){
  	
  	$shareId   = $request->getParameter('share');
  	$rankingId = Util::decodeId($shareId);
  	$rankingId = $request->getParameter('id', $rankingId);
  	$rankingId = $request->getParameter('rankingId', $rankingId);
  	
	$this->rankingObj = RankingPeer::retrieveByPK( $rankingId );

	if( !is_object($this->rankingObj) )
		return $this->redirect('ranking/index');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSave($request){

	$rankingId        = $request->getParameter('rankingId');
	$rankingName      = $request->getParameter('rankingName');
	$buildEmailGroup  = $request->getParameter('buildEmailGroup');
	$rankingTag       = $request->getParameter('rankingTag');
	$gameStyleId      = $request->getParameter('gameStyleId');
	$startDate        = $request->getParameter('startDate');
	$finishDate       = $request->getParameter('finishDate');
	$isPrivate        = $request->getParameter('isPrivate');
	$rankingTypeId    = $request->getParameter('rankingTypeId');
	$buyin            = $request->getParameter('buyin');
	$startTime        = $request->getParameter('startTime');
	$entranceFee      = $request->getParameter('entranceFee');
	$scoreSchema      = $request->getParameter('scoreSchema');
	$scoreFormula     = $request->getParameter('scoreFormula');
	$recalculateScore = $request->getParameter('recalculateScore');

	$rankingObj = $this->rankingObj;

	if( !$rankingId ){
		
		$rankingObj = new Ranking();
		$rankingObj->setUserSiteId($this->userSiteId);
	}
	
	$isNew = $rankingObj->isNew();

	$scoreFormula = ($scoreSchema=='custom'?$scoreFormula:null);

	$updateHistory = ($rankingTypeId!=$rankingObj->getRankingTypeId());

	$rankingObj->setRankingName( $rankingName );
	$rankingObj->setGameStyleId( $gameStyleId );
	$rankingObj->setStartDate( Util::formatDate($startDate) );
	$rankingObj->setFinishDate( Util::formatDate($finishDate) );
	$rankingObj->setBuyin( Util::formatFloat($buyin) );
	$rankingObj->setEntranceFee( Util::formatFloat($entranceFee) );
	$rankingObj->setStartTime( $startTime );
	$rankingObj->setIsPrivate( ($isPrivate?true:false) );
	$rankingObj->setRankingTypeId( $rankingTypeId );
	$rankingObj->setScoreSchema( $scoreSchema );
	$rankingObj->setScoreFormula( $scoreFormula );
	$rankingObj->setVisible(true);
	$rankingObj->setEnabled(true);
	
	$buildEmailGroup = false;
	
	if( is_null($rankingObj->getRankingTag()) ){
		
		$rankingObj->setRankingTag($rankingTag);
		$buildEmailGroup = true;
	}
		
	$rankingObj->save();
	
	if( $buildEmailGroup )
		$rankingObj->createEmailGroup();
	
	$rankingObj->addPlayer( $this->peopleId, true );
	
	if( $isNew ){
		
		$rankingObj->resetOptions();
	}else{
		
		if( $recalculateScore ){
			
			$rankingObj->updateWholeScore();
			$rankingObj->updateScores();
		}
		
		$rankingObj->saveOptions($request);
		
		if( $updateHistory || $recalculateScore )
			$rankingObj->updateWholeHistory();
	}
	
	echo $rankingObj->getId();
	exit;
  }
  
  
  
  public function executeSaveMobile($request){

	$rankingId       = $request->getParameter('rankingId');
	$rankingName     = $request->getParameter('rankingName');
	$buildEmailGroup = $request->getParameter('buildEmailGroup');
	$rankingTag      = $request->getParameter('rankingTag');
	$gameStyleId     = $request->getParameter('gameStyleId');
	$startDate       = $request->getParameter('startDate');
	$finishDate      = $request->getParameter('finishDate');
	$isPrivate       = $request->getParameter('isPrivate');
	$rankingTypeId   = $request->getParameter('rankingTypeId');
	$buyin           = $request->getParameter('buyin');

//	$rankingObj = $this->rankingObj;
//
//	if( !$rankingId ){
//		
//		$rankingObj = new Ranking();
//		$rankingObj->setUserSiteId($this->userSiteId);
//	}
	
	echo $rankingName;
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
	
	$rankingObj->deleteEmailGroup();
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
  	$eventId      = $request->getParameter('eventId');
	
	$rankingObj = $this->rankingObj;

	$peopleObj = PeoplePeer::retrieveByEmailAddress($emailAddress);
	
	if( !is_object($peopleObj) ){
		
		$peopleObj = People::getQuickPeople($firstName, $lastName, 'rankingPlayer', $peopleId );
		
		$peopleObj->setEmailAddress(nvl($emailAddress));
		$peopleObj->save();
	}
	
	$rankingObj->addPlayer( $peopleObj->getId() );
	$rankingObj->addToOpenEvents($peopleObj->getId(), $eventId);
	
    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('ranking/include/player', array('rankingObj'=>$rankingObj, 'readOnly'=>false)));
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

	return $this->renderText(get_partial('ranking/include/player', array('rankingObj'=>$rankingObj, 'readOnly'=>false)));
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
	
	if( $rankingPlaceId )
		$rankingPlaceObj = RankingPlacePeer::retrieveByPK($rankingPlaceId);
	else
		$rankingPlaceObj = new RankingPlace();
	
	$rankingPlaceObj->quickSave($request);
	
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
  
  public function executeGetBuyin($request){

	$rankingId  = $request->getParameter('rankingId');
	$rankingObj = RankingPeer::retrieveByPK( $rankingId );

	echo Util::formatFloat($rankingObj->getBuyIn(), true);
	
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
  
  public function executeGetInfo($request){

	$rankingId  = $request->getParameter('rankingId');
	$rankingObj = RankingPeer::retrieveByPK( $rankingId );
	
	echo Util::parseInfo($rankingObj->getInfo());
	exit;
  }
  
  public function executeValidateUnsubscribe($request){

	$peopleId   = $this->getUser()->getAttribute('peopleId');
	$userSiteId = $this->getUser()->getAttribute('userSiteId');
	$rankingId  = $request->getParameter('rankingId');

	$rankingObj = RankingPeer::retrieveByPK($rankingId);

	$count = Util::executeOne('SELECT COUNT(1) FROM ranking_player WHERE ranking_id = '.$rankingId.' AND enabled AND allow_edit');
	
	if( $rankingObj->getUserSiteId()==$userSiteId && $count < 2 )
		// <!-- I18N -->
		Util::forceError("!Você é o único moderador do ranking.\nSelecione um ou mais jogadores para controlarem este ranking.");

	exit;
  }

  public function executeUnsubscribe($request){

	$peopleId  = $this->getUser()->getAttribute('peopleId');
	$rankingId = $request->getParameter('rankingId');

	$rankingPlayerObj = RankingPlayerPeer::retrieveByPK($rankingId, $peopleId);
	
	if( !is_object($rankingPlayerObj) )
		throw new Exception('Você não faz parte deste ranking!');
		
	$rankingPlayerObj->setEnabled(false);
	$rankingPlayerObj->save();
	
	$rankingPlayerObj->getRanking()->updatePlayers();

	return $this->redirect('ranking/index');
  }
  
  public function executeSearch($request){
  	
  	$renderize        = $request->getParameter('isIE');
  	$rankingName      = $request->getParameter('rankingName');
  	$rankingDateStart = $request->getParameter('dateStart');
  	$rankingDateEnd   = $request->getParameter('dateEnd');
  	$status           = $request->getParameter('status');
  	$eventsStart      = $request->getParameter('eventsStart');
  	$eventsEnd        = $request->getParameter('eventsEnd');
  	$playersStart     = $request->getParameter('playersStart');
  	$playersEnd       = $request->getParameter('playersEnd');
  	
  	if( !Validate::validateDate($rankingDateStart) ) $rankingDateStart = null;
  	if( !Validate::validateDate($rankingDateEnd) ) $rankingDateEnd = null;
  	
  	$userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );

  	$criteria = new Criteria();
  	if( $rankingName ) $criteria->addAnd( RankingPeer::RANKING_NAME, '%'.str_replace(' ', '%', $rankingName).'%', Criteria::ILIKE );
  	if( $rankingDateStart ) $criteria->addAnd( RankingPeer::START_DATE, Util::formatDate($rankingDateStart), Criteria::GREATER_EQUAL );
  	if( $rankingDateEnd ) $criteria->addAnd( RankingPeer::FINISH_DATE, Util::formatDate($rankingDateEnd), Criteria::LESS_EQUAL );
  	if( $eventsStart ) $criteria->addAnd( RankingPeer::EVENTS, $eventsStart, Criteria::GREATER_EQUAL );
  	if( $eventsEnd ) $criteria->addAnd( RankingPeer::EVENTS, $eventsEnd, Criteria::LESS_EQUAL );
  	if( $playersStart ) $criteria->addAnd( RankingPeer::PLAYERS, $playersStart, Criteria::GREATER_EQUAL );
  	if( $playersEnd ) $criteria->addAnd( RankingPeer::PLAYERS, $playersEnd, Criteria::LESS_EQUAL );
  	
  	switch( $status ){
  		case 'active':
  		default:
  			$criteria->addAnd( RankingPeer::FINISH_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
			break;
  		case 'old':
  			$criteria->addAnd( RankingPeer::FINISH_DATE, date('Y-m-d'), Criteria::LESS_THAN );
			break;
  		case 'all':
			break;
  	}

	if( $renderize ){
		
		$this->criteria = $criteria;
		$this->setTemplate('index');
	}else{
	  	
	  	sfConfig::set('sf_web_debug', false);
		sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
		return $this->renderText(get_partial('ranking/include/search', array('criteria'=>$criteria, 'userSiteObj'=>$userSiteObj)));
	}  	
  }
  
  public function executeRequestSubscription($request){
  	
  	if( !$this->getUser()->isAuthenticated() )
  		Util::forceError('!É necessário estar logado para enviar seu pedido de inscrição.');
  	
  	$rankingId  = $request->getParameter('rankingId');
  	$cancel     = $request->getParameter('cancel');
  	$userSiteId = $this->getUser()->getAttribute('userSiteId');
  	
  	$rankingObj = RankingPeer::retrieveByPK($rankingId);
  	
  	if( $rankingObj->getIsPrivate() )
  		Util::forceError('!Este ranking não aceita pedidos de inscrição.');
  	
  	if( $cancel )
  		$rankingObj->cancelSubscriptionRequest($userSiteId);
  	else
  		$rankingObj->addSubscriptionRequest($userSiteId);
  	
  	echo 'success';
  	
  	exit;
  }
  
  public function executeToggleSubscriptionRequest($request){
  	
  	$userSiteId      = $request->getParameter('userSiteId');
  	$toggleAction    = $request->getParameter('toggleAction');
  	$userSiteIdOwner = $this->getUser()->getAttribute('userSiteId');
  	
  	$rankingSubscriptionRequestObj = $this->rankingObj->hasPendingSubscriptionRequest($userSiteId, true);
  	$rankingSubscriptionRequestObj->$toggleAction($userSiteIdOwner);
  	
  	echo 'success';
  	
  	exit;
  }
  
  public function executeCheckRankingTag($request){
  	
  	$rankingTag = RankingPeer::checkRankingTag($this->rankingId);
  	
  	if( !$rankingTag )
  		Util::forceError('noRankingTag');
  	
  	exit;
  }

  public function executeGetRankingPlace($request){
  	
  	$rankingPlaceId  = $request->getParameter('rankingPlaceId');
  	$rankingPlaceObj = RankingPlacePeer::retrieveByPK($rankingPlaceId);
  	
  	echo Util::parseInfo($rankingPlaceObj->getInfo());
  	
  	exit;
  }

  public function executeCheckRankingPlace($request){
  	
  	$rankingPlaceId  = $request->getParameter('rankingPlaceId');
  	$rankingPlaceObj = RankingPlacePeer::retrieveByPK($rankingPlaceId);
  	
  	if( $rankingPlaceObj->getStateId() && $rankingPlaceObj->getCityName() && $rankingPlaceObj->getQuarter() )
  		exit('complete');
  	else
  		exit('incomplete');
  	
  	exit;
  }

  public function executeParseMapsInfo($request){
  	
  	$mapsLink = $request->getParameter('mapsLink');
  	
  	try{
  		
  		echo Util::parseInfo( RankingPlace::parseMapsLink($mapsLink) );
  	}catch(Exception $e){
  		
  		Util::forceError($e->getMessage());
  	}
  	
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
  	echo 'var i18n_rankingScoreRecalculateConfirm       = "'.__('ranking.scoreRecalculateConfirm').'";'.$nl;
  	echo 'var i18n_ranking_searchError                  = "'.__('ranking.searchError').'";'.$nl;
  	exit;
  }
  
  public function executeDebug($request){
  	
  	$rankingObj = $this->rankingObj;
  	
  	set_time_limit(120);

  	$rankingObj->updateWholeScore();
  	$rankingObj->updateWholeHistory();
  	
  	echo 'ok ranking '.date('d/m/Y H:i:s');
  	exit;
  }
  
  public function executeGetiPhoneAppXml($request){
  	
  	$userSiteId  = $request->getParameter('userSiteId');
  	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
  	$peopleId    = $userSiteObj->getPeopleId();
	
	$criteria = new Criteria();
	$criteria->add( RankingPeer::ENABLED, true );
	$criteria->add( RankingPeer::VISIBLE, true );
	$criteria->add( RankingPeer::DELETED, false );
	
	$criterion = $criteria->getNewCriterion( RankingPlayerPeer::PEOPLE_ID, $peopleId );
	$criterion->addOr( $criteria->getNewCriterion( RankingPeer::USER_SITE_ID, $userSiteId ) );
	$criteria->add($criterion);

	$criteria->addJoin( RankingPeer::ID, RankingPlayerPeer::RANKING_ID, Criteria::LEFT_JOIN );
			
	$criteria->addAscendingOrderByColumn( RankingPeer::RANKING_NAME );
	$criteria->setDistinct( RankingPeer::ID );
	$rankingObjList = RankingPeer::doSelect( $criteria );
	
	header('content-type: text/xml; charset=UTF-8');
	
	$rankingList = array();

	
	foreach($rankingObjList as $rankingObj){
		
		$ranking = array();
		$ranking['attributeList'] = array('id'=>$rankingObj->getId(),
											  'rankingTypeId'=>$rankingObj->getRankingTypeId(),
											  'gameStyleId'=>$rankingObj->getGameStyleId(),
											  );
											  
		$ranking['rankingName']  = $rankingObj->getRankingName();
		$ranking['rankingType']  = $rankingObj->getRankingType()->getDescription();
		$ranking['gameStyle']    = $rankingObj->getGameStyle()->getDescription();
		$ranking['credit']       = Util::formatFloat($rankingObj->getCredit(), true);
		$ranking['startDate']    = $rankingObj->getStartDate('d/m/Y');
		$ranking['finishDate']   = $rankingObj->getFinishDate('d/m/Y');
		$ranking['isPrivate']    = ($rankingObj->getIsPrivate()?'1':'0');
		$ranking['buyin']        = Util::formatFloat($rankingObj->getBuyin(), true);
		$ranking['players']      = $rankingObj->getPlayers();
		$ranking['events']       = $rankingObj->getEvents();
		
		$rankingList[] = $ranking;
	}

	$nl = chr(10);	
	$xmlString  = '<?xml version="1.0"?>'.$nl;
	$xmlString .= '<rankings>'.$nl;
	foreach($rankingList as $ranking){
		
		$xmlString .= '<ranking '.Util::implode_with_key($ranking['attributeList'], '="', '" ', '"').'>'.$nl;
		
		unset($ranking['attributeList']);
		
		foreach($ranking as $key=>$value)
			$xmlString .= '<'.$key.'>'.htmlspecialchars($value).'</'.$key.'>'.$nl;
		
		$xmlString .= '</ranking>'.$nl;
	}
	
	$xmlString .= '</rankings>'.$nl;
	echo $xmlString;
	exit;
  }
}
