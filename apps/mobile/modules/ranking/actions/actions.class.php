<?php

class rankingActions extends sfActions
{

  public function preExecute(){
	
	$this->title = 'Meus rankings';
	
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
  }
  
  public function executeEdit($request){
  	
  	$rankingId = $request->getParameter('rankingId');
  	$this->title .= '/Visualização';
  	
  	if( $rankingId ){
  		
		$this->rankingObj = RankingPeer::retrieveByPK( $rankingId );
		
		if( !is_object($this->rankingObj) )
			return $this->redirect('ranking/index');
		
			$this->setTemplate('show');
  	}
  }
}
