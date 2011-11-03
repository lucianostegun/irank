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
  /**
   * Executes index action
   *
   */
  public function executeGetXml($request){
  	
  	$userSiteId  = $request->getParameter('userSiteId');
  	$userSiteObj = UserSitePeer::retrieveByPK($userSiteId);
  	$peopleId    = $userSiteObj->getPeopleId();
	
	$criteria = new Criteria();
	$criteria->setNoFilter(true);
//	$eventObjList = Event::getList($criteria, false, $userSiteId);

	$eventObjList = Event::getNextList($criteria, null, $userSiteId);
	
	header('content-type: text/xml; charset=UTF-8');
	
	$nl = chr(10);
	
	$xmlString  = '<?xml version="1.0"?>'.$nl;
	$xmlString .= '<events>'.$nl;
	
	foreach($eventObjList as $eventObj){
		
		$xmlString .= '<event id="'.$eventObj->getId().'" rankingId="'.$eventObj->getRankingId().'">'.$nl;
		$xmlString .= '	<eventName>'.htmlspecialchars($eventObj->getEventName()).'</eventName>'.$nl;
		$xmlString .= '	<eventDate>'.$eventObj->getEventDate('d/m/Y').'</eventDate>'.$nl;
		$xmlString .= '	<startTime>'.$eventObj->getStartTime('H:i').'</startTime>'.$nl;
		$xmlString .= '	<rankingName>'.$eventObj->getRanking()->getRankingName().'</rankingName>'.$nl;
		$xmlString .= '	<eventPlace>'.$eventObj->getRankingPlace()->getPlaceName().'</eventPlace>'.$nl;
		$xmlString .= '</event>'.$nl;
	}
	
	$xmlString .= '</events>'.$nl;
	
	echo $xmlString;
	exit;
  }
}
