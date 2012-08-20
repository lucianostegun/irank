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

	return $this->renderText(get_partial('home/resume/events').get_partial('home/resume/quickResume'));
  }

  public function executeGetMenu($request){

    sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');

	$userSiteObj = UserSite::getCurrentUser();
	
	$options                    = array();
    $options['username']        = $userSiteObj->getUsername();
    $options['firstName']       = $userSiteObj->getPeople()->getFirstName();
    $options['isAuthenticated'] = true;
    $options['innerMenu']       = false;
    $options['innerObj']        = false;
	        
	return $this->renderText(get_partial('home/include/leftMenu').get_partial('home/include/quickResume', $options));
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
	exit;
  }

  public function executeSavePhotoContestVote($request){
	
	$photoSide  = $request->getParameter('photoSide');
	$isReported = $request->getParameter('isReported');
	
	$lockKey = MyTools::getCookie('eventPhotoContestKey');
	
	$eventPhotoContestObj = EventPhotoContestPeer::retriveByLockKey($lockKey);
	$eventPhotoIdList     = array();
	
	if( is_object($eventPhotoContestObj) ){
		
		if( $isReported )
			$photoSide = ($photoSide=='left'?'right':'left');
		
		$functionWinner = 'getEventPhotoId'.ucfirst($photoSide);
		$functionLoser  = 'getEventPhotoId'.ucfirst(($photoSide=='left'?'right':'left'));
		
		$eventPhotoIdWinner = $eventPhotoContestObj->$functionWinner();
		$eventPhotoIdLoser  = $eventPhotoContestObj->$functionLoser();
		
		$eventPhotoContestObj->setEventPhotoIdWinner($eventPhotoIdWinner);
		$eventPhotoContestObj->setIsReported(($isReported?true:false));
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
	
	if( sfConfig::get('sf_no_script_name') && !$isDebug )
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
  
  public function executeError404($request){
  	
  }

  public function executeSavePollAnswer($request){
  	
  	$pollId        = $request->getParameter('pollId');
  	$pollAnswerId  = $request->getParameter('pollAnswerId');
  	$pollAnswerObj = PollAnswerPeer::retrieveByPK($pollAnswerId);
  	
  	if(is_object($pollAnswerObj)){
  		
  		$userResponse = $pollAnswerObj->getUserResponse() | 0;
  		$pollAnswerObj->setUserResponse(($userResponse+1));
  		$pollAnswerObj->save();
  		
  		$pollObj = $pollAnswerObj->getPoll();
  		
  		$pollIdList   = MyTools::getAttribute('answeredPollIdList');
  		$pollIdList   = explode(',', $pollIdList);
  		$pollIdList[] = $pollId;
  		
  		MyTools::setAttribute('answeredPollIdList', implode(',', $pollIdList) );
  		
  		$totalAnswers = $pollObj->getTotalAnswers();
  		foreach($pollObj->getPollAnswerList() as $pollAnswerObj){
  			
  			$percentAnswer = (100*$pollAnswerObj->getUserResponse())/$totalAnswers;
  			$percentAnswer = Util::formatFloat($percentAnswer, true);
  			
  			$position = ($percentAnswer*145)/100;
  			$position = $position-145;
  			
 			echo '<div class="optionReport">'.$pollAnswerObj->getAnswer().' '.$percentAnswer.'%';
 			echo '	<div class="optionReportBar" style="background-position: '.$position.'px"></div>';
 			echo '</div>';
	  	}
  	}
  	
  	exit;
  }
  
  public function executeImages($request){
	
	$fileName   = $request->getParameter('fileName');
	$emailLogId = $request->getParameter('emailLogId');
	$emailLogId = Util::decodeId($emailLogId);
	
	$emailLogObj = EmailLogPeer::retrieveByPK($emailLogId);
	
	if(is_object($emailLogObj)){
		
		$emailLogObj->setReadAt( date('Y-m-d H:i:s') );
		$emailLogObj->save();
	}
	
	header('Content-Type: image/png');
	header('Expires: 0');
	header('Pragma: no-cache');
	print_r(file_get_contents(Util::getFilePath('images/email/'.$fileName)));
	
	exit;
  }
}
