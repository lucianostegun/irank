<?php

class rankingActions extends sfActions
{

  public function preExecute(){
	
	Util::getHelper('I18N');
	
	$this->title = __('ranking.title');
	
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
  }
  
  public function executeEdit($request){
  	
  	$rankingId = $request->getParameter('rankingId');
  	$this->title .= '/'.__('ranking.title.viewing');
  	
  	if( $rankingId ){
  		
		$this->rankingObj = RankingPeer::retrieveByPK( $rankingId );
		
		if( !is_object($this->rankingObj) )
			return $this->redirect('ranking/index');
		
			$this->setTemplate('show');
  	}
  }
}
