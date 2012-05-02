<?php

class homeActions extends sfActions
{

  public function preExecute(){

	$hasCredentials        = MyTools::hasCredential('iRankSite');
	$this->isAuthenticated = ($this->getUser()->isAuthenticated() && $hasCredentials);
  }
  
  public function executeIndex($request){

  }

  public function executeGetEventResume($request){

	$offset    = $request->getParameter('offset');
	$eventDate = $request->getParameter('eventDate');
	
	if( !Util::formatDate($eventDate) )
		$eventDate = null;
	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');

	return $this->renderText(get_partial('home/resume/event/eventList', array('offset'=>$offset, 'eventDate'=>$eventDate)));
  }

  public function executeGetCredit($request){

	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');

	return $this->renderText(get_partial('home/component/generalCredit'));
  }

  public function executeGetResume($request){

    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	return $this->renderText(get_partial('home/resume/events'));
  }

  public function executeGetResumeChart($request){

    $this->peopleId = $this->getUser()->getAttribute('peopleId');
  }
  
  public function executeChangeLanguage($request){
	
	$culture = $request->getParameter('culture');
	$this->getUser()->setCulture($culture);
	$this->getUser()->setAttribute('culture', $culture);
	exit;
  }
  
//  public function executePhotoView($request){
//	
//	$share   = $request->getParameter('share');
//	$shareId = $request->getParameter('shareId');
//	
//	$photoUrl = '';
//	
//	switch($share){
//		case 'eventPhoto':
//			$photoUrl = '/index.php/event/getPhoto/shareId/'.$shareId.'/maxWidth/775';
//			break;
//		case 'eventResult':
//			$photoUrl = '/index.php/event/facebookResultImage/shareId/'.$shareId;
//			break;
//	}
//	
//	$this->photoUrl = $photoUrl;
//  }

  public function executeEventPhoto($request){
	
	$id   = $request->getParameter('id');
	$zoom = $request->getParameter('zoom');

	$eventPhotoObj = EventPhotoPeer::retrieveByPK($id);
	
	if( !$eventPhotoObj->getIsShared() )
		throw new Exception(__('event.exception.notSharedImage'));
	
	$fileObj = $eventPhotoObj->getFile();
	$fileObj->getResized(($zoom?750:366));
  }

  public function executeSavePhotoContestVote($request){
	
	$photoSide = $request->getParameter('photoSide');
	
	$lockKey = MyTools::getCookie('eventPhotoContestKey');
	
	$eventPhotoContestObj = EventPhotoContestPeer::retriveByLockKey($lockKey);
	$eventPhotoIdList     = array();
	
	if( is_object($eventPhotoContestObj) ){
		
		$functionWinner = 'getEventPhotoId'.ucfirst($photoSide);
		$functionLoser  = 'getEventPhotoId'.ucfirst(($photoSide=='left'?'right':'left'));
		
		$eventPhotoIdWinner = $eventPhotoContestObj->$functionWinner();
		$eventPhotoIdLoser  = $eventPhotoContestObj->$functionLoser();
		
		$eventPhotoContestObj->setEventPhotoIdWinner($eventPhotoIdWinner);
		$eventPhotoContestObj->save();
		
		Util::executeQuery("SELECT update_photo_contest($eventPhotoIdWinner, $eventPhotoIdLoser)");
		
		$eventPhotoIdList[] = $eventPhotoContestObj->getEventPhotoIdLeft();
		$eventPhotoIdList[] = $eventPhotoContestObj->getEventPhotoIdRight();
	}
	
	$eventPhotoContestObj = EventPhotoContest::getPhotoPair($eventPhotoIdList);
	echo Util::parseInfo($eventPhotoContestObj->getInfo());

	exit;	
  }
  
  public function executeMobile($request){
  	
  	$this->getUser()->setAttribute('forceClassic', null);

    echo '<html><head><meta http-equiv="refresh" content="0;url=/index.php"/></head></html>';
  	exit;
  }
  
  public function executeJavascript($request){
	
	Util::getHelper('i18n');
	
    header('Content-type: text/x-javascript');
		
	$nl = chr(10);
	
	$scriptName = $request->getScriptName();
	$hostname   = $request->getHost();
	$isDebug    = $request->getParameter('debug');
	
	if( $isDebug )
		$scriptName = '/frontend_dev.php';
	
	$isDebug    = ($isDebug?'true':'false');
	$peopleId   = $this->getUser()->getAttribute('peopleId');
	
	if( sfConfig::get('sf_no_script_name') )
		$scriptName = '';
	
	echo 'var _CurrentPeopleId = "'.$peopleId.'";'.$nl.$nl;
	
	echo "var _webRoot    = '$scriptName';".$nl;
	echo "var _imageRoot  = 'http://$hostname/images';".$nl;
	echo "var _isDebug    = $isDebug;".$nl;
	echo "var _isMobile   = false;".$nl.$nl;
	
	echo 'var i18n_culture                = "'.$this->getUser()->getCulture().'";'.$nl;
	echo 'var i18n_record_exitAlert       = "'.__('record.exitAlert').'";'.$nl;
	echo 'var i18n_tryAgain               = "'.__('tryAgain').'";'.$nl;
	echo 'var i18n_disable                = "'.__('disable').'";'.$nl;
	echo 'var i18n_enable                 = "'.__('enable').'";'.$nl;
	echo 'var i18n_zero_zeroZero          = "'.__('zero.zeroZero').'";'.$nl;
	echo 'var i18n_innerLoading           = "'.__('layout.innerLoading').'";'.$nl;
	echo 'var i18n_changeLanguageError    = "'.__('layout.changeLanguageError').'";'.$nl;
	echo 'var i18n_formErrorRequiredField = "'.__('form.error.requiredField').'";'.$nl;
	exit;
  }
}
