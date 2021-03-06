<?php

/**
 * event actions.
 *
 * @package    sf_sandbox
 * @subpackage event
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class eventActions extends sfActions
{
	
  public function preExecute(){
  	
	$userSiteId = $this->getRequestParameter('userSiteId');
  	$language   = $this->getRequestParameter('language');
	
	$this->userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	
  	$culture = Util::getConvertCulture($language);
  	
  	MyTools::setCulture($culture);
	
	if( is_object($this->userSiteObj) )
		$this->getUser()->setAttribute('peopleId', $this->userSiteObj->getPeopleId());
		
	$this->getUser()->setAttribute('userSiteId', $userSiteId);
  }
  
  public function executeSaveResult($request){
  	
  	$xmlString = $request->getParameter('eventResultXml');
  	
//	$file = fopen(Util::getFilePath('/xml.xml'), 'w+');
//	fwrite($file, $xmlString);
//	fclose($file);
//	exit;
//	$xmlString = file_get_contents(Util::getFilePath('/xml.xml'));

	$xmlString   = simplexml_load_string( $xmlString );
	$eventResultList = array();	
	
    $validate = new DOMDocument;
    $validate->loadXML($xmlString->asXml());
    
    $eventId  = (int)$xmlString->attributes()->eventId;
    $eventObj = EventPeer::retrieveByPK($eventId);

	Util::getHelper('I18N');
	    
    if( !$eventObj->isEditable(true) )
		Util::forceError('!'.__('event.lockedEvent'), true);

    $rowList = array();
    foreach( $xmlString->eventResult as $eventResultNode ){
    	
    	$eventResult = array();
    	
    	$peopleId = (int)$eventResultNode->attributes()->peopleId;
    	
    	foreach( $eventResultNode as $key=>$cellNode )
    		$eventResult[$key] = (float)$cellNode;
    	
    	$eventResultList[$peopleId] = $eventResult;
    }

  	foreach($eventResultList as $peopleId=>$eventResult){
  		
		$request->setParameter('buyin'.$peopleId, $eventResult['buyin']);
		$request->setParameter('rebuy'.$peopleId, $eventResult['rebuy']);
		$request->setParameter('addon'.$peopleId, $eventResult['addon']);
		$request->setParameter('eventPosition'.$peopleId, $eventResult['eventPosition']);
		$request->setParameter('prize'.$peopleId, $eventResult['prize']);
  	}

  	$eventObj->saveResult($request);
  	
  	// A aplica????o espera receber este retorno!
  	echo 'saveSuccess';
  	exit;
  }
  
  public function executeUploadPhoto($request){
  	
	Event::uploadPicture($request, true);
	echo 'uploadSuccess';
  	exit;
  }

  public function executeThumbnail($request){
  	
  	$fileObj = FilePeer::retrieveByPK(185);
	$fileObj->resizeMax(800,600);

  	exit;
  }
  
  public function executeComments($request){
  	
  	$this->eventId = $request->getParameter('eventId');

	$criteria = new Criteria();

	sfConfig::set('sf_web_debug', false);
  }
  
  public function executeSaveComment($request){

	$eventId    = $request->getParameter('eventId');
	$userSiteId = $request->getParameter('userSiteId');
	$comment    = $request->getParameter('comment');
	$comment    = urldecode($comment);

	$comment = (strlen($comment)>140?substr($comment, 0, 140):$comment);

	$userSiteObj = $this->userSiteObj;

	$eventCommentObj = new EventComment();
	$eventCommentObj->setPeopleId( $userSiteObj->getPeopleId() );
	$eventCommentObj->setEventId( $eventId );
	$eventCommentObj->setComment( $comment );
	$eventCommentObj->save();
	
	$eventCommentObj->notify();
	
	echo 'saveSuccess';
	
	exit;
  }
  
  public function executePhotos($request){
  	
  	$this->eventId = $request->getParameter('eventId');

	sfConfig::set('sf_web_debug', false);
  }
  
  public function executeUpdateInviteStatus($request){
  	
  	$userSiteId   = $request->getParameter('userSiteId');
  	$eventId      = $request->getParameter('eventId');
  	$inviteStatus = $request->getParameter('inviteStatus');
  	$userSiteObj  = $this->userSiteObj;
  	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
  	try{
  		
  		MyTools::setAttribute('peopleId', $userSiteObj->getPeopleId());
  		MyTools::setCulture('pt_BR');
  		$eventObj->togglePresence( $userSiteObj->getPeopleId(), $inviteStatus );
  		echo $inviteStatus;	
  	}catch(Exception $e){
  	
  		echo 'error';
  	}
  	
  	exit;
  }
  
  public function executeTogglePresence($request){

	Util::getHelper('i18n');
	
	$eventId  = $request->getParameter('eventId');
	$peopleId = $request->getParameter('peopleId');
	$choice   = $request->getParameter('choice');
	
	$eventObj = EventPeer::retrieveByPK( $eventId );
	
	$notify = (!$eventObj->isPastDate());
	
	if( $choice=='yes' && !$eventObj->isConfirmed($peopleId) )
		$eventObj->togglePresence($peopleId, 'yes', $notify);
	else
		$eventObj->togglePresence($peopleId, 'no', $notify);
    
    echo 'toggleSuccess';
    
    exit;
  }
  
  public function executeGetPaidPlaces($request){

	$eventId = $request->getParameter('eventId');
	$buyins  = $request->getParameter('buyins');
	
	$eventObj     = EventPeer::retrieveByPK($eventId);
	$isPercent    = true;
	$buyin        = $eventObj->getBuyin();
	
	if( $eventObj->getIsFreeroll() ){
		
		$prizeConfig = $eventObj->getPrizeConfig();

		if( ereg('[0-9]*(,[0-9])*%', $prizeConfig) ){
			
			$prizeConfig = str_replace('%', '', $prizeConfig);
		}else{
			
			$isPercent = false;
		}
		
		$buyin        = $eventObj->getRanking()->getBuyin();
		
		$prizeConfigList = explode(';', $prizeConfig);
		$infoList = array('percentList'=>implode(',', $prizeConfigList), 'paidPlaces'=>count($prizeConfigList));
		$totalPrize  = $buyins+$eventObj->getPrizePot();
	}else{
		
		$infoList = Ranking::getPaidPlaces($eventId, $buyins);
		$totalPrize  = ($buyins*$buyin)+$eventObj->getPrizePot();
	}
	
	$infoList['paidPlaces'] *= 1;

	$percentList = explode(',', $infoList['percentList']);
	
	foreach($percentList as $key=>$percent)
		if( $isPercent )
			$infoList[$key+1] = $totalPrize*$percent/100;
		else
			$infoList[$key+1] = $percent;
	
	echo Util::parseInfo($infoList);
	
	exit;
  }
  
  public function executePhoto($request){
  	
  	$eventId  = $request->getParameter('eventId');
  	$fileName = $request->getParameter('fileName');
  	$filePath = Util::getFilePath('/uploads/eventPhoto/event-'.$eventId.'/thumb/'.$fileName);
  	
	$newImg = @imagecreatefromjpeg( $filePath );
	
	header('Content-type: file/jpeg');
	
	$srcW = imagesx($newImg);
	$srcH = imagesy($newImg);
	
	$width  = 75;
	$height = 56;
	
	$img = imagecreatetruecolor($width, $height);
	imagecopyresampled($img, $newImg, 0, 0, 0, 0, $width, $height, $srcW, $srcH);
	imagejpeg($img);
	imagedestroy($img);
	imagedestroy($newImg);
	exit;
  }
  
  public function executePhotoView($request){
  	
  	$this->eventPhotoId = $request->getParameter('eventPhotoId');
  }
  
  public function executeImageThumb($request){

  	$eventPhotoId  = $request->getParameter('eventPhotoId');
  	$width         = $request->getParameter('width', 300);
  	$eventPhotoObj = EventPhotoPeer::retrieveByPK($eventPhotoId);
  	
  	$filePath = $eventPhotoObj->getFile()->getFilePath(true);
  	
	$newImg = @imagecreatefromjpeg( $filePath );
	
	header('Content-type: image/jpeg');
	
	$srcW = imagesx($newImg);
	$srcH = imagesy($newImg);
	
	$height = ($srcH*$width/$srcW);
	
	$img = imagecreatetruecolor($width, $height);
	imagecopyresampled($img, $newImg, 0, 0, 0, 0, $width, $height, $srcW, $srcH);
	imagejpeg($img, null, 100);
	imagedestroy($img);
	imagedestroy($newImg);
	exit;
  }
  
  public function executeGetInfo($request)
  {

	$userSiteId = $request->getParameter('userSiteId');
	
	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
	echo Util::parseInfo($userSiteObj->getInfo(true));
		
	exit;
  }
  
  /**
   * Executes index action
   *
   */
  public function executeGetXml($request){
  	
  	$userSiteId  = $request->getParameter('userSiteId');
  	$rankingId   = $request->getParameter('rankingId');
  	$eventId     = $request->getParameter('eventId');
  	$model       = $request->getParameter('model');
  	$userSiteObj = $this->userSiteObj;
	
	switch( $model ){
		case 'listEvents':
		case 'nextEvents':
		case 'previousEvents':
		case 'resumeEvents':
			$criteria = new Criteria();
			$criteria->setNoFilter(true);
		
  			$limit = $request->getParameter('limit');
  			
  			if( $rankingId )
  				$criteria->add( EventPeer::RANKING_ID, $rankingId);
  			
			switch($model){
				case 'listEvents':
					$eventObjList = Event::getList($criteria, 30, $userSiteId);
					break;
				case 'nextEvents':
					$eventObjList = Event::getNextList($criteria, $limit, $userSiteId);
					break;
				case 'previousEvents':
					$eventObjList = Event::getPreviousList($criteria, $limit, $userSiteId);
					break;
				case 'resumeEvents':
					$eventObjList = Event::getResumeList($limit, $userSiteId);
					break;
			}
		
			$eventList = array();
			foreach($eventObjList as $eventObj){
				
				$eventNode = array();
				
				$eventNode['@attributes']  = array('id'=>$eventObj->getId(), 'rankingId'=>$eventObj->getRankingId());
				$eventNode['eventName']    = $eventObj->getEventName();
				$eventNode['eventDate']    = $eventObj->getEventDate('d/m/Y');
				$eventNode['startTime']    = $eventObj->getStartTime('H:i');
				$eventNode['rankingName']  = $eventObj->getRanking()->getRankingName();
				$eventNode['eventPlace']   = $eventObj->getRankingPlace()->getPlaceName();
				$eventNode['paidPlaces']   = $eventObj->getPaidPlaces();
				$eventNode['players']      = $eventObj->getPlayers();
				$eventNode['entranceFee']  = $eventObj->getEntranceFee();
				$eventNode['buyin']        = $eventObj->getBuyin();
				$eventNode['rankingBuyin'] = $eventObj->getRanking()->getBuyin();
				$eventNode['savedResult']  = $eventObj->getSavedResult()?'true':'false';
				$eventNode['comments']     = $eventObj->getComments();
				$eventNode['inviteStatus'] = $eventObj->getInviteStatus($userSiteObj->getPeopleId());
				$eventNode['isMyEvent']    = $eventObj->isMyEvent()?'true':'false';
				$eventNode['isFreeroll']   = $eventObj->getIsFreeroll()?'true':'false';
				$eventNode['isEditable']   = $eventObj->isEditable()?'true':'false';
				$eventNode['isPastDate']   = $eventObj->isPastDate()?'true':'false';
				$eventNode['allowRebuy']   = $eventObj->getAllowRebuy()?'true':'false';
				$eventNode['allowAddon']   = $eventObj->getAllowAddon()?'true':'false';
				$eventNode['gameStyle']    = $eventObj->getRanking()->getGameStyle()->getTagName();
				
				$eventList[] = $eventNode;
			}
			
			echo Event::getXml($eventList);
			break;
		case 'eventPlayer':

			$eventObj = EventPeer::retrieveByPK($eventId);
			
			$eventPlayerList = array();
			foreach($eventObj->getEventPlayerList() as $eventPlayerObj){
				
				$peopleObj = $eventPlayerObj->getPeople();
				
				$eventPlayerNode = array();
				$eventPlayerNode['@attributes']   = array('playerId'=>$peopleObj->getId(), 'eventId'=>$eventPlayerObj->getEventId());
				$eventPlayerNode['enabled']       = ($eventPlayerObj->getEnabled()?'true':'false');
				$eventPlayerNode['inviteStatus']  = $eventPlayerObj->getInviteStatus();
				$eventPlayerNode['eventPosition'] = $eventPlayerObj->getEventPosition();
				$eventPlayerNode['buyin']         = $eventPlayerObj->getBuyin();
				$eventPlayerNode['rebuy']         = $eventPlayerObj->getRebuy();
				$eventPlayerNode['addon']         = $eventPlayerObj->getAddon();
				$eventPlayerNode['prize']         = $eventPlayerObj->getPrize();
				$eventPlayerNode['score']         = $eventPlayerObj->getScore();
				$eventPlayerNode['player']        = array('firstName'=>$peopleObj->getFirstName(), 'lastName'=>$peopleObj->getLastName(), 'emailAddress'=>$peopleObj->getEmailAddress());
				
				$eventPlayerList[] = $eventPlayerNode;
			}
			
			echo EventPlayer::getXml($eventPlayerList);
			break;
		case 'eventPhoto':
		case 'photo':

			$appVersion = $request->getParameter('appVersion');
			$eventObj   = EventPeer::retrieveByPK($eventId);
			$host       = $request->getHost();
			
			$tagName = ($appVersion?'photo':'eventPhoto');

			$photoList = array();
			foreach($eventObj->getPhotoList() as $eventPhotoObj){
				
				$fileObj  = $eventPhotoObj->getFile();
				$imageUrl = 'http://'.$host.'/'.$fileObj->getFilePath();
				$fileName = Util::getFileName($imageUrl);
				
				$width  = $eventPhotoObj->getWidth();
				$height = $eventPhotoObj->getHeight();
				$orientation = ($width > $height?'landscape':'portrait');
				
				$eventPhotoNode = array();
				$eventPhotoNode['@attributes'] = array($tagName.'Id'=>$eventPhotoObj->getId(), 'fileId'=>$eventPhotoObj->getFileId(), 'width'=>$width, 'height'=>$height, 'orientation'=>$orientation);
				$eventPhotoNode['imageUrl']    = 'http://'.$host.'/ios.php/event/imageThumb/eventPhotoId/'.$eventPhotoObj->getId().'/thumb/1';
				$eventPhotoNode['thumbUrl']    = str_replace($fileName, 'thumb/'.$fileName, $imageUrl);
				
				$photoList[] = $eventPhotoNode;
			}
			
			echo EventPhoto::getXml($photoList, $tagName);
			break;
	}
	exit;
  }
}
