<?php

/**
 * eventLive actions.
 *
 * @package    sf_sandbox
 * @subpackage eventLive
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class eventLiveActions extends sfActions
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
  
  /**
   * Executes index action
   *
   */
  public function executeGetXml($request){
  	
  	$userSiteId  = $request->getParameter('userSiteId');
  	$clubId      = $request->getParameter('clubId');
  	$eventId     = $request->getParameter('eventId');
  	$model       = $request->getParameter('model');
  	$limit       = $request->getParameter('limit', null);
  	$userSiteObj = $this->userSiteObj;
  	
  	$host = $request->getHost();
	
	switch( $model ){
		case 'nextEvents':
  			$clubObj = ClubPeer::retrieveByPK($clubId);
  			
  			$criteria = new Criteria();
			$criteria->add( EventLiveViewPeer::EVENT_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
			$criteria->setLimit($limit);
		
			$eventList = array();
			foreach($clubObj->getSchedule($criteria) as $eventLiveObj){
				
				$eventNode = array();
				
				$description = $eventLiveObj->getDescription();
				$description = strip_tags($description);
				
				$eventNode['@attributes']   = array('id'=>$eventLiveObj->getId());
				$eventNode['eventName']     = $eventLiveObj->toString();
				$eventNode['eventDate']     = $eventLiveObj->getEventDate('d/m/Y');
				$eventNode['weekDay']       = $eventLiveObj->getWeekDay();
				$eventNode['description']   = $description;
				$eventNode['startTime']     = $eventLiveObj->getStartTime('H:i');
				$eventNode['rankingName']   = $eventLiveObj->getRankingLive()->getRankingName();
				$eventNode['buyin']         = $eventLiveObj->getBuyin();
				$eventNode['entranceFee']   = $eventLiveObj->getEntranceFee();
				$eventNode['stackChips']    = $eventLiveObj->getStackChips(true);
				$eventNode['blindTime']     = $eventLiveObj->getBlindTime('H:i');
				$eventNode['players']       = $eventLiveObj->getPlayers();
				$eventNode['gameStyle']     = $eventLiveObj->getGameStyle()->getDescription();
				$eventNode['gameType']      = $eventLiveObj->getGameType()->getDescription();
				$eventNode['savedResult']   = $eventLiveObj->getSavedResult()?'true':'false';
				$eventNode['isFreeroll']    = $eventLiveObj->getIsFreeroll()?'true':'false';
				$eventNode['isPastDate']    = $eventLiveObj->isPastDate()?'true':'false';
				$eventNode['allowedRebuys'] = $eventLiveObj->getAllowedRebuys()?'true':'false';
				$eventNode['allowedAddons'] = $eventLiveObj->getAllowedAddons()?'true':'false';
				$eventNode['logoUrl']       = 'http://'.$host.'/images/'.$eventLiveObj->getFileNameLogo();
				
				$eventList[] = $eventNode;
			}
			
			echo EventLive::getXml($eventList);
			break;
		case 'eventPhoto':

			$eventObj = EventPeer::retrieveByPK($eventId);
			$host = $request->getHost();

			$eventPhotoList = array();
			foreach($eventObj->getPhotoList() as $eventPhotoObj){
				
				$fileObj  = $eventPhotoObj->getFile();
				$imageUrl = 'http://'.$host.'/'.$fileObj->getFilePath();
				$fileName = Util::getFileName($imageUrl);
				
				$width  = $eventPhotoObj->getWidth();
				$height = $eventPhotoObj->getHeight();
				$orientation = ($width > $height?'landscape':'portrait');
				
				$eventPhotoNode = array();
				$eventPhotoNode['@attributes'] = array('eventPhotoId'=>$eventPhotoObj->getId(), 'fileId'=>$eventPhotoObj->getFileId(), 'width'=>$width, 'height'=>$height, 'orientation'=>$orientation);
				$eventPhotoNode['imageUrl']    = 'http://'.$host.'/ios.php/event/imageThumb/eventPhotoId/'.$eventPhotoObj->getId().'/thumb/1';
				$eventPhotoNode['thumbUrl']    = str_replace($fileName, 'thumb/'.$fileName, $imageUrl);
				
				$eventPhotoList[] = $eventPhotoNode;
			}
			
			echo EventPhoto::getXml($eventPhotoList);
			break;
	}
	exit;
  }
}
