<?php

class rankingLiveActions extends sfActions
{

  public function preExecute(){
  	
  	$this->rankingLiveId = $this->getRequestParameter('id');
  	$this->rankingLiveId = $this->getRequestParameter('rankingLiveId', $this->rankingLiveId);
  }
  
  public function executeIndex($request){
  	
  }

  public function executeDetails($request){
  	
  	if( !$this->rankingLiveId )
  		$this->rankingLiveId = Util::getDirectUrlId('rankingLive/details');
  	
  	$this->rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
  	
  	if( !is_object($this->rankingLiveObj) )
  		return $this->redirect('rankingLive/index');
  		
  	$this->rankingLiveObj->updateVisitCount();
  	
  	if( !is_object($this->rankingLiveObj) )
  		return $this->redirect('rankingLive/index');
  }

  public function executeGetTabContent($request){
  	
  	$tabId = $request->getParameter('tabId');
  	$tabId = strtolower($tabId);
  	
  	$rankingDate = $request->getParameter('rankingDate');
  	
  	$rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
  	
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag');
	return $this->renderText(get_partial('rankingLive/include/'.$tabId, array('rankingLiveObj'=>$rankingLiveObj, 'rankingDate'=>$rankingDate)));
  }

  public function executeGetInfo($request){
  	
  	$rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
  	echo Util::parseInfo($rankingLiveObj->getInfo());
  	exit;
  }

  public function executeChart($request){
  	
  	$this->rankingLiveId  = Util::decodeId($this->rankingLiveId);
  	
  	$this->rankingLiveObj = $rankingLiveObj = RankingLivePeer::retrieveByPK($this->rankingLiveId);
  	
  	$rankingDateList          = $rankingLiveObj->getDateList();
  	$rankingDateList          = array_values($rankingDateList);
  	$rankingDateList          = array_reverse($rankingDateList);
  	$rankingPositionList      = array();
  	$totalRankingPositionList = array();
  	
  	$peopleId = $this->getUser()->getAttribute('peopleId');
  	
  	foreach($rankingDateList as $rankingDate){
  		
  		$rankingPositionList[]      = $rankingLiveObj->getRankingPosition($peopleId, $rankingDate);
  		$totalRankingPositionList[] = $rankingLiveObj->getTotalRankingPosition($peopleId, $rankingDate);
  	}
  	
	$this->peopleId                 = $peopleId;
	$this->rankingDateList          = $rankingDateList;
	$this->rankingPositionList      = $rankingPositionList;
	$this->totalRankingPositionList = $totalRankingPositionList;
  }
}
