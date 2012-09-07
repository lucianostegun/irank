<?php

class eventActions extends sfActions
{

  public function preExecute(){

	$this->userSiteId      = $this->getUser()->getAttribute('userSiteId');
	$this->peopleId        = $this->getUser()->getAttribute('peopleId');
	$this->isAuthenticated = $this->getUser()->isAuthenticated();
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$this->criteria    = new Criteria();
	
	$this->innerObj = new Event();
  }
  
  public function executeNew($request){

	return $this->forward('event', 'edit');
  }
  
  public function executeEdit($request){
  	
  	$viewComment = $request->getParameter('viewComment');
  	$viewComment = base64_decode(strrev($viewComment));
  	
  	$eventId       = $request->getParameter('id', $viewComment);
  	$eventId       = $request->getParameter('eventId', $eventId);
  	$this->isClone = $request->getParameter('isClone');
  	
  	if( $eventId ){
  		
		$this->eventObj = EventPeer::retrieveByPK( $eventId );

		if( !is_object($this->eventObj) )
			return $this->redirect('event/index');
		
		if( !$this->eventObj->isMyEvent() )
			$this->setTemplate('show');
  	}else{
		
		$this->eventObj = new Event();
  	}
	  	
  	$this->innerObj = $this->eventObj;
  }
  
  public function executeShow($request){
  	
  	$eventId = $request->getParameter('id');
  	$eventId = $request->getParameter('eventId', $eventId);
  	
	$this->eventObj = $this->innerObj = EventPeer::retrieveByPK( $eventId );

	if( !is_object($this->eventObj) )
		return $this->redirect('event/index');
  }

  public function handleErrorSave(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSave($request){

	Util::getHelper('I18N');
	
	$eventId         = $request->getParameter('eventId');
	$rankingId       = $request->getParameter('rankingId');
	$eventName       = $request->getParameter('eventName');
	$rankingPlaceId  = $request->getParameter('rankingPlaceId');
	$eventDate       = $request->getParameter('eventDate');
	$startTime       = $request->getParameter('startTime');
	$paidPlaces      = $request->getParameter('paidPlaces');
	$buyin           = $request->getParameter('buyin');
	$entranceFee     = $request->getParameter('entranceFee');
	$comments        = $request->getParameter('comments');
	$confirmPresence = $request->getParameter('confirmPresence');
	$sendEmail       = $request->getParameter('sendEmail');
	$isFreeroll      = $request->getParameter('isFreeroll');
	$prizePot        = $request->getParameter('prizePot');
	$isClone         = $request->getParameter('isClone');
	$allowRebuy      = $request->getParameter('allowRebuy');
	$allowAddon      = $request->getParameter('allowAddon');

	if( $eventId )		
		$eventObj  = EventPeer::retrieveByPK( $eventId );
	else
		$eventObj = new Event();
	
	$isNew = $eventObj->isNew();
	
	if( !$eventObj->isEditable() )
		Util::forceError('!'.__('event.lockedEvent'), true);
		
	$isClone = ($isClone && !$eventObj->getEnabled());

	$eventObj->setRankingId( $rankingId );
	$eventObj->setEventName( $eventName );
	$eventObj->setRankingPlaceId( $rankingPlaceId );
	$eventObj->setEventDate( Util::formatDate($eventDate) );
	$eventObj->setStartTime( $startTime );
	$eventObj->setPaidPlaces(nvl($paidPlaces));
	$eventObj->setBuyin( Util::formatFloat($buyin) );
	$eventObj->setEntranceFee( Util::formatFloat($entranceFee) );
	$eventObj->setIsFreeroll( ($isFreeroll?true:false) );
	$eventObj->setPrizePot( Util::formatFloat($prizePot) );
	$eventObj->setComments(nvl($comments));
	$eventObj->setAllowRebuy(($allowRebuy?true:false));
	$eventObj->setAllowAddon(($allowAddon?true:false));
	$eventObj->setVisible(true);
	$eventObj->setEnabled(true);
	$eventObj->buildPermalink();
	$eventObj->save();
	
	if( $isFreeroll )
		$eventObj->savePrizeConfig($request);
	else
		$eventObj->deletePrizeConfig();
	
	$rankingObj = $eventObj->getRanking();
	
	if( $isNew || $isClone )		
		$rankingObj->incraseEvents();
	
	$eventObj->importPlayers();

	if( $confirmPresence )
		$eventObj->addPlayer( $this->peopleId, true );

	if( $sendEmail )
		$eventObj->notify();
	else
		$eventObj->save();
	
    echo Util::parseInfo($eventObj->getInfo());
    exit;
  }
  
  public function executeDelete($request){

//	Util::getHelper('I18N');
	
	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	if( !is_object($eventObj) )
		throw new Exception(__('eventNotFound'));
	
	if( !$eventObj->isEditable() )
		Util::forceError('!'.__('event.lockedEvent'), true);
	
	$eventObj->delete();
	exit;
  }
  
  public function executeChoosePresence($request){

	Util::getHelper('I18N');
	
	$eventId     = $request->getParameter('eventId');
	$choice      = $request->getParameter('choice');
	$quickChoice = $request->getParameter('qc');

	$eventObj = EventPeer::retrieveByPK( $eventId );
	
//	if( !$eventObj->isEditable() )
//		Util::forceError('!'.__('event.lockedEvent'), true);

	$eventObj->togglePresence( $this->peopleId, $choice );
	
	if( $quickChoice )
		exit;
    return $this->forward('event', 'getPlayerList');
  }

  public function executeRemovePlayer($request){

	Util::getHelper('I18N');
	
	$eventId  = $request->getParameter('eventId');
	$peopleId = $request->getParameter('peopleId');
	
	$userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
	$eventObj    = EventPeer::retrieveByPK( $eventId );
	
	if( !$eventObj->isShared($peopleId) )
		Util::forceError('!'.__('event.playersTab.shareBeforeDelete'), true);
	
	if( !$eventObj->isEditable() )
		Util::forceError('!'.__('event.lockedEvent'), true);

	$eventObj->removePlayer( $peopleId );
    
    return $this->forward('event', 'getPlayerList');
  }
  
  public function executeTogglePresence($request){

	Util::getHelper('I18N');
	
	$eventId  = $request->getParameter('eventId');
	$peopleId = $request->getParameter('peopleId');
	$notify   = $request->getParameter('notify');
	$notify   = ($notify?true:false);
	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	if( !$eventObj->isMyEvent() )
		throw new Exception(__('event.exception.editionDenied'));
	
	if( !$eventObj->isConfirmed($peopleId) )
		$eventObj->togglePresence($peopleId, 'yes', $notify);
	else
		$eventObj->togglePresence($peopleId, 'no', $notify);
    
    exit;
  }

  public function executeGetPlayerList($request){

	$eventId  = $request->getParameter('eventId');
	$result   = $request->getParameter('result');
	$import   = $request->getParameter('import');
	$eventObj = EventPeer::retrieveByPK( $eventId );
	$pastDate = $eventObj->isPastDate();
	
	$path = ($pastDate && !$result?'show':'form');
	
	if( $import ){
		
		$path = ($pastDate && !$result?'show':'form');
		$result = false;
	}
	
	if( $pastDate && $result && !$import )
		$path = 'include';

  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('event/'.$path.'/player'.($result && ($path=='show' || $pastDate)?'Result':''), array('eventObj'=>$eventObj)));
  }

  public function executeGetResult($request){

	$eventId  = $request->getParameter('eventId');
	$readOnly = $request->getParameter('readOnly');
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('event/include/result'.($readOnly?'Ro':''), array('eventObj'=>$eventObj)));
  }
  
  public function executeGetResultWindow($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('event/dialog/result', array('eventObj'=>$eventObj, 'windowHeight'=>400)));
  }
  
  public function executeGetMainTab($request){

	$eventId  = $request->getParameter('eventId');
	$readOnly = $request->getParameter('readOnly');
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('event/'.($readOnly?'show':'form').'/main', array('eventObj'=>$eventObj)));
  }
  
  public function executeCloneEvent($request){
  	
  	$eventId = $request->getParameter('eventId');
  	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	$eventObj = $eventObj->getClone();
	
	$request->setParameter('eventId', $eventObj->getId());
	$request->setParameter('isClone', true);
	return $this->forward('event', 'edit');
  }
  
  public function executeToggleShare($request){

	Util::getHelper('I18N');
	
	$eventId  = $request->getParameter('eventId');
	$peopleId = $request->getParameter('peopleId');
	
	$eventPlayerObj = EventPlayerPeer::retrieveByPK( $eventId, $peopleId );
	$peopleIdOwner  = $eventPlayerObj->getEvent()->getRanking()->getUserSite()->getPeopleId();
	
	if( $peopleIdOwner==$peopleId || $peopleId==$this->peopleId || !is_object($eventPlayerObj) )
		throw new Exception(__('event.exception.shareError'));
	
	if( $eventPlayerObj->getAllowEdit() )
		$eventPlayerObj->share();
	else
		$eventPlayerObj->unshare();
	
    echo ($eventPlayerObj->getAllowEdit()?'lock':'unlock');
    exit;
  }

  public function handleErrorSaveResult(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSaveResult($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK($eventId);
	
	Util::getHelper('I18N');
	
	if( !$eventObj->isEditable() )
		Util::forceError('!'.__('event.lockedEvent'), true);

	$eventObj->saveResult($request);

	exit;
  }  
  
  public function executeSearch($request){
  	
  	$renderize      = $request->getParameter('isIE');
  	$eventName      = $request->getParameter('eventName');
  	$eventPlace     = $request->getParameter('eventPlace');
  	$eventDateStart = $request->getParameter('dateStart');
  	$eventDateEnd   = $request->getParameter('dateEnd');
  	$rankingId      = $request->getParameter('rankingId');
  	
  	if( !Validate::validateDate($eventDateStart) ) $eventDateStart = null;
  	if( !Validate::validateDate($eventDateEnd) ) $eventDateEnd = null;

  	$criteria = new Criteria();
  	if( $eventName ) $criteria->addAnd( EventPeer::EVENT_NAME, '%'.str_replace(' ', '%', $eventName).'%', Criteria::ILIKE );
  	if( $eventDateStart ) $criteria->addAnd( EventPeer::EVENT_DATE, Util::formatDate($eventDateStart), Criteria::GREATER_EQUAL );
  	if( $eventDateEnd ) $criteria->addAnd( EventPeer::EVENT_DATE, Util::formatDate($eventDateEnd), Criteria::LESS_EQUAL );
  	if( $rankingId ) $criteria->addAnd( EventPeer::RANKING_ID, $rankingId );
  	if( $eventPlace ){
  		
  		$criteria->addAnd( RankingPlacePeer::PLACE_NAME, '%'.$eventPlace.'%', Criteria::ILIKE );	
  		$criteria->addJoin( EventPeer::RANKING_PLACE_ID, RankingPlacePeer::ID, Criteria::INNER_JOIN );	
  	}

	if( $renderize ){
		
		$this->criteria = $criteria;
		$this->setTemplate('index');
	}else{
	  	
	  	sfConfig::set('sf_web_debug', false);
		sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
		return $this->renderText(get_partial('event/include/search', array('criteria'=>$criteria)));
	}  	
  }
  
  public function executeConfirmPresence($request){
  	
	$this->eventObj = $this->innerObj = Event::confirmPresence($request);
	
	if( !is_object($this->eventObj) )
		return $this->redirect('event/index');
  }

  public function handleErrorSaveComment(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSaveComment($request){

	$eventId = $request->getParameter('eventId');
	$comment = $request->getParameter('comment');
	$comment = urldecode($comment);

	$comment = str_replace('|n', chr(10), $comment);

	$eventCommentObj = new EventComment();
	$eventCommentObj->setPeopleId( $this->peopleId );
	$eventCommentObj->setEventId( $eventId );
	$eventCommentObj->setComment( $comment );
	$eventCommentObj->save();
	
	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text', 'I18n');
	
	$eventCommentObj->notify();
	
	$readOnly = (!$this->isAuthenticated || !$eventCommentObj->getEvent()->isMyEvent());

	return $this->renderText(get_partial('event/include/comment', array('eventCommentObj'=>$eventCommentObj, 'isPhoto'=>false, 'readOnly'=>$readOnly)));
  }
  
  public function executeDeleteComment($request){

	$eventCommentId = $request->getParameter('eventCommentId');
	
	$eventCommentObj = EventCommentPeer::retrieveByPK($eventCommentId);

	Util::getHelper('i18n');
	
	if( !$eventCommentObj->isMyComment() )
		throw new Exception(__('event.notYourComment'));
	
	$eventCommentObj->delete();
	exit;
  }
  
  public function executeGetCommentList($request){

	$eventId = $request->getParameter('eventId');
	
	$eventObj = EventPeer::retrieveByPK($eventId);
	$eventCommentObjList = $eventObj->getCommentList();
	$eventCommentObjList = array_reverse($eventCommentObjList);
	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	
	$readOnly = (!$this->isAuthenticated || !$eventObj->isMyEvent());
	
	foreach($eventCommentObjList as $eventCommentObj)
		$this->renderText(include_partial('event/include/comment', array('eventCommentObj'=>$eventCommentObj, 'isPhoto'=>false, 'readOnly'=>$readOnly)));
		
	exit;
  }
  
  public function executeUploadPhoto($request){

	Event::uploadPicture($request);
  	
  	exit;
  }
  
  public function executeGetPhotoList($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK($eventId);
	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	
	$this->renderText(include_partial('event/include/photoList', array('eventObj'=>$eventObj)));
		
	exit;
  }

  public function handleErrorSavePhotoComment(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeSavePhotoComment($request){

	$eventPhotoId = $request->getParameter('eventPhotoId');
	$eventId      = $request->getParameter('eventId');
	$comment      = $request->getParameter('comment');
	$comment      = urldecode($comment);

	$comment = str_replace('|n', chr(10), $comment);

	$eventPhotoCommentObj = new EventPhotoComment();
	$eventPhotoCommentObj->setPeopleId( $this->peopleId );
	$eventPhotoCommentObj->setEventPhotoId( $eventPhotoId );
	$eventPhotoCommentObj->setComment( $comment );
	$eventPhotoCommentObj->save();
	
	$eventPhotoCommentObj->notify();
	
	$readOnly = (!$this->isAuthenticated || !$eventPhotoCommentObj->getEvent()->isMyEvent());
	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	return $this->renderText(get_partial('event/include/comment', array('eventCommentObj'=>$eventPhotoCommentObj, 'isPhoto'=>true, 'readOnly'=>$readOnly)));
	exit;
  }
  
  public function executeDeletePhotoComment($request){

	Util::getHelper('I18N');
	
	$eventPhotoCommentId = $request->getParameter('eventPhotoCommentId');
	
	$eventPhotoCommentObj = EventPhotoCommentPeer::retrieveByPK($eventPhotoCommentId);
	
	if( !$eventPhotoCommentObj->isMyComment() )
		throw new Exception(__('event.notYourComment'));
	
	$eventPhotoCommentObj->delete();
	exit;
  }
  
  public function executeGetPhotoCommentList($request){

	$eventPhotoId = $request->getParameter('eventPhotoId');
	
	$eventPhotoObj = EventPhotoPeer::retrieveByPK($eventPhotoId);
	$rankingObj    = $eventPhotoObj->getEvent()->getRanking();
	
	if( !$this->isAuthenticated && $rankingObj->getIsPrivate() )
		throw new Exception('Os comentários deste evento não disponíveis para visualização');
		
	$eventPhotoCommentObjList = $eventPhotoObj->getCommentList();
	$eventPhotoCommentObjList = array_reverse($eventPhotoCommentObjList);
	
  	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	
	$readOnly = (!$this->isAuthenticated || !$eventPhotoObj->getEvent()->isMyEvent());
	
	foreach($eventPhotoCommentObjList as $eventPhotoCommentObj)
		$this->renderText(include_partial('event/include/comment', array('eventCommentObj'=>$eventPhotoCommentObj, 'isPhoto'=>true, 'readOnly'=>$readOnly)));
		
	exit;
  }
  
  public function executeGetPhotoInfo($request){

	Util::getHelper('I18N');
	
	$eventId      = $request->getParameter('eventId');
	$eventPhotoId = $request->getParameter('eventPhotoId');
	$direction    = $request->getParameter('direction');
	
	$eventPhotoObj = EventPhotoPeer::retrieveByPK($eventPhotoId);
	
	if( $direction=='next' )
		$eventPhotoObj = $eventPhotoObj->getNextPhoto();
	
	if( $direction=='previous' )
		$eventPhotoObj = $eventPhotoObj->getPreviousPhoto();

	if( !is_object($eventPhotoObj) )
		Util::forceError(__('event.endOfImages'), true);
				
	if( $eventPhotoObj->getEventId()!=$eventId )
		throw new Exception(__('event.exception.notImageEventBelong'));
	
	echo Util::parseInfo($eventPhotoObj->getInfo());
		
	exit;
  }
  
  public function executeGetPhoto($request){

	Util::getHelper('I18N');
	
	$shareId      = $request->getParameter('shareId');
	$shareId      = base64_decode($shareId);
	$eventId      = $request->getParameter('eventId');
	$eventPhotoId = $request->getParameter('eventPhotoId', $shareId);
	$maxWidth     = $request->getParameter('maxWidth');
	$maxHeight    = $request->getParameter('maxHeight');
	
	$eventPhotoObj = EventPhotoPeer::retrieveByPK($eventPhotoId);
	
	if( $eventPhotoObj->getEventId()!=$eventId && !$shareId )
		throw new Exception(__('event.exception.notImageEventBelong'));
	

	$fileObj = $eventPhotoObj->getFile();
	$fileObj->getResized($maxWidth, $maxHeight);
		
	exit;
  
  }
  
  public function executeDeletePhoto($request){

	Util::getHelper('I18N');
	
	$eventId      = $request->getParameter('eventId');
	$eventPhotoId = $request->getParameter('eventPhotoId');
	
	$eventPhotoObj = EventPhotoPeer::retrieveByPK($eventPhotoId);
	
	if( $eventPhotoObj->getEventId()!=$eventId )
		throw new Exception(__('event.exception.notImageEventBelong'));
	
	if( !$eventPhotoObj->getEvent()->isMyEvent() )
		throw new Exception(__('event.exception.imageDeleteDenied'));
	
	$eventPhotoObj->delete();
	
	return $this->forward('event', 'getPhotoList');
		
	exit;
  }
  
  public function executeResize($request){

	$fileObj = FilePeer::retrieveByPK(97);
	$fileObj->resizeMax(800, 600);
	exit;
  }

  public function executeGetRankingPlaceList($request){

	$rankingId      = $request->getParameter('rankingId');
	$rankingPlaceId = $request->getParameter('rankingPlaceId');
	
  	sfConfig::set('sf_web_debug', false);
	Util::getHelpers();
	Util::getHelper('i18n');
	echo select_tag('rankingPlaceId', RankingPlace::getOptionsForSelect($rankingId, $rankingPlaceId), array('class'=>'required', 'id'=>'eventRankingPlaceId'));
	exit;
  }
  
  public function executeImportPlayers($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	if( !is_object($eventObj) )
		throw new Exception(__('eventNotFound'));
	
	if( !$eventObj->isEditable() )
		Util::forceError('!'.__('event.lockedEvent'), true);
		
	if( !$eventObj->isMyEvent() )
		throw new Exception(__('event.exception.editionDenied'));
		
	$eventObj->importPlayers();
  	
	exit;
  }
  
  public function executeGetICal($request){

	$eventId  = $request->getParameter('eventId');
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	echo $eventObj->getICal('update', true);
	exit;
  }
  
  public function executeGetPaidPlaces($request){

	$eventId = $request->getParameter('eventId');
	$buyins  = $request->getParameter('buyins');
	
	$infoList = Ranking::getPaidPlaces($eventId, $buyins);
	
	echo Util::parseInfo($infoList);
	
	exit;
  }
  
  public function executeFacebookShareUrl($request){

  	$eventId  = $request->getParameter('eventId');
  	$eventObj = EventPeer::retrieveByPK($eventId);
  	
  	$url = $eventObj->getPermalink(true);
  	$url = 'http://www.facebook.com/sharer/sharer.php?u='.urlencode($url);

  	header('location: '.$url);
  	exit;
  }

  public function executeFacebookResultShareUrl($request){

  	$eventId  = $request->getParameter('eventId');
  	$peopleId = $this->getUser()->getAttribute('peopleId');
  	
  	$eventPlayerObj = EventPlayerPeer::retrieveByPK($eventId, $peopleId);
  	$shareId        = base64_encode($eventPlayerObj->getShareId());
  	
  	$url = 'http://'.$request->getHost().'/event/resultShare/'.$shareId;
  	$url = 'http://www.facebook.com/sharer/sharer.php?u='.urlencode($url);

  	header('location: '.$url);
  	exit;
  }

  public function executePermalink($request){

  	$rankingTag = $request->getParameter('rankingTag');
  	$eventDate  = $request->getParameter('eventDate');
  	$eventName  = $request->getParameter('eventName');
  	$permalink  = sprintf('%s/%s/%s', $rankingTag, $eventDate, $eventName);

  	$this->eventObj = EventPeer::retrieveByPermalink($permalink);
  	
  	if( !is_object($this->eventObj) )
  		return $this->redirect('event/index');
  	
  	$eventId = $this->eventObj->getId();
  	
  	$request->setParameter('eventId', $eventId);

  	if( $this->isAuthenticated && $this->eventObj->isMyEvent() )
		$this->forward('event', 'edit');
	else
		$this->forward('event', 'share');
  }

  public function executeShare($request){

  	$shareId = $request->getParameter('shareId');
  	$eventId = Util::decodeId($shareId);
  	$eventId = $request->getParameter('id', $eventId);
  	$eventId = $request->getParameter('eventId', $eventId);

	$this->eventObj = EventPeer::retrieveByPK($eventId);
	
	if( !is_object($this->eventObj) )
		return $this->redirect('home/index');

	$rankingObj = $this->eventObj->getRanking();
	
	if( !$this->eventObj->isMyEvent() && $rankingObj->getIsPrivate() )
		return $this->redirect('home/index');
	
	$uri = $request->getUri();
	$uri = str_replace('facebookResult', 'facebookResultImage', $uri);
	
	$host = $request->getHost();
	
	$eventName     = $this->eventObj->getEventName();
	$eventPlace    = $this->eventObj->getRankingPlace()->getPlaceName();
	$rankingName   = $this->eventObj->getRanking()->getRankingName();
	$eventDateTime = $this->eventObj->getEventDateTime('d/m/Y H:i');
	$buyinInfo     = $this->eventObj->getBuyinInfo();
	$allowRebuy    = $this->eventObj->getAllowRebuy();
	$allowAddon    = $this->eventObj->getAllowAddon();

	$description  = "Evento valendo pelo ranking $rankingName\nData/hora: $eventDateTime\nBuy-in: $buyinInfo";
	$description .= ($allowRebuy || $allowAddon)?"\n".(($allowRebuy && $allowAddon)?'Rebuy/Add-on':($allowRebuy?'Rebuy':'Add-on')):"";

	$this->facebookMetaList = array('title'=>$eventName.' @'.$eventPlace,
									'description'=>$description,
									'url'=>$this->eventObj->getPermalink(true));
	
	if( $this->isAuthenticated && $this->eventObj->isMyEvent() )
		$this->setTemplate('edit');
  }
  
  public function executeFacebookResultShare($request){

  	$shareId = $request->getParameter('shareId');
  	$shareId = base64_decode($shareId);

	$eventPlayerObj = EventPlayerPeer::retrieveByShareId($shareId);
	$peopleId = $eventPlayerObj->getPeopleId();
	$eventObj = $eventPlayerObj->getEvent();
  	
  	$shareId = base64_encode($shareId);
	
	$host           = $request->getHost();
	$url            = 'http://'.$host.'/event/resultShare/'.$shareId;
	$this->imageUrl = 'http://'.$host.'/event/facebookResultImage/shareId/'.$shareId;

	$this->facebookMetaList = array('url'=>$url,
									'title'=>'Resultados iRank',
									'description'=>'Fiquei em '.$eventPlayerObj->getEventPosition().'º lugar no evento '.$eventObj->getEventName().' realizado em '.$eventObj->getEventDate('d/m/Y').' valendo pelo ranking '.$eventObj->getRanking()->getRankingName(),
									'image'=>$this->imageUrl,
									);

	$this->setLayout('facebookShare');
	$this->setTemplate('none');
	return sfView::SUCCESS;
  }
  
  public function executeFacebookResultImage($request){

  	$thumb   = $request->getParameter('thumb');
  	$shareId = $request->getParameter('shareId');
  	$shareId = base64_decode($shareId);

  	if( $shareId ){
  		
  		$eventPlayerObj = EventPlayerPeer::retrieveByShareId($shareId);
  		
  		$peopleId = $eventPlayerObj->getPeopleId();
  		$eventObj = $eventPlayerObj->getEvent();
  	}else{
	  	
	  	$peopleId = $request->getParameter('peopleId');
	  	$eventId  = $request->getParameter('eventId');
		$eventObj = EventPeer::retrieveByPK($eventId);
  	}

	$eventObj->getFacebookResult($peopleId, $thumb);
	exit;
  }
  
  public function executeJavascript($request){
  	
  	Util::getHelper('i18n');
  	
    header('Content-type: text/x-javascript');
	
  	$nl = chr(10);
  	
  	echo 'var i18n_event_save_error                          = "'.__('event.saveError').'";'.$nl;
  	echo 'var i18n_event_commentsTab_intro                   = "'.__('event.commentsTab.intro').'";'.$nl;
  	echo 'var i18n_event_commentsTab_photoIntro              = "'.__('event.commentsTab.photoIntro').'";'.$nl;
  	echo 'var i18n_event_commentTab_commentText              = "'.__('event.commentTab.commentText').'";'.$nl;
  	echo 'var i18n_event_commentTab_typeSomething            = "'.__('event.commentTab.typeSomething').'";'.$nl;
  	echo 'var i18n_event_commentTab_publishing               = "'.__('event.commentTab.publishing').'";'.$nl;
  	echo 'var i18n_event_commentTab_publishingError          = "'.__('event.commentTab.publishingError').'";'.$nl;
  	echo 'var i18n_event_commentsTab_commentDeleteError      = "'.__('event.commentTab.commentDeleteError').'";'.$nl;
  	echo 'var i18n_event_commentsTab_photoUploadError        = "'.__('event.commentsTab.photoUploadError').'";'.$nl;
  	echo 'var i18n_event_commentsTab_photoDeleteError        = "'.__('event.commentsTab.photoDeleteError').'";'.$nl;
  	echo 'var i18n_event_commentsTab_photoDeleteConfirm      = "'.__('event.commentsTab.photoDeleteConfirm').'";'.$nl;
  	echo 'var i18n_event_commentsTab_photoPublishConfirm     = "'.__('event.commentsTab.photoPublishConfirm').'";'.$nl;
  	echo 'var i18n_event_commentsTab_showPhotoComments       = "'.__('event.commentsTab.showPhotoComments').'";'.$nl;
  	echo 'var i18n_leftChar                                  = "'.__('leftChar').'";'.$nl;
  	echo 'var i18n_leftChars                                 = "'.__('leftChars').'";'.$nl;
  	echo 'var i18n_event_saveResultConfirm                   = "'.__('event.saveResultConfirm').'";'.$nl;
  	echo 'var i18n_event_saveMyPresenceError                 = "'.__('event.saveMyPresenceError').'";'.$nl;
  	echo 'var i18n_event_playersTab_playerDeleteConfirm      = "'.__('event.playersTab.playerDeleteConfirm').'";'.$nl;
  	echo 'var i18n_event_playersTab_playerDeleteError        = "'.__('event.playersTab.playerDeleteError').'";'.$nl;
  	echo 'var i18n_event_playersTab_togglePresenceError      = "'.__('event.playersTab.togglePresenceError').'";'.$nl;
  	echo 'var i18n_event_playersTab_presenceNotifyConfirm    = "'.__('event.playersTab.presenceNotifyConfirm').'";'.$nl;
  	echo 'var i18n_event_mainTab_rankingPlaceLoadingError    = "'.__('event.mainTab.rankingPlaceLoadingError').'";'.$nl;
  	echo 'var i18n_event_cloneConfirm                        = "'.__('event.cloneConfirm').'";'.$nl;
  	echo 'var i18n_event_deleteConfirm                       = "'.__('event.deleteConfirm').'";'.$nl;
  	echo 'var i18n_event_deleteError                         = "'.__('event.deleteError').'";'.$nl;
  	echo 'var i18n_event_searchError                         = "'.__('event.searchError').'";'.$nl;
  	echo 'var i18n_event_playersTab_shareError               = "'.__('event.playersTab.shareError').'";'.$nl;
  	echo 'var i18n_event_players_importConfirm               = "'.__('event.players.importConfirm').'";'.$nl;
  	echo 'var i18n_event_players_importError                 = "'.__('event.players.importError').'";'.$nl;
  	echo 'var i18n_event_players_importSuccess               = "'.__('event.players.importSuccess').'";'.$nl;
  	echo 'var i18n_event_calculatePrizeError                 = "'.__('event.calculatePrizeError').'";'.$nl;
  	echo 'var i18n_event_place                               = "'.__('event.place').'";'.$nl;
  	echo 'var i18n_event_paidPlacesFormatError               = "'.__('event.paidPlacesFormatError').'";'.$nl;
  	exit;
  }
  
  public function executeDebug($request){
  	
  	$rankingId  = $request->getParameter('rankingId');
  	$rankingObj = RankingPeer::retrieveByPK($rankingId);

  	foreach($rankingObj->getEventDateList() as $eventDate)
  		$rankingObj->updateHistory($eventDate);
  	
  	echo 'ok event '.date('d/m/Y H:i:s');
  	exit;
  }
}
