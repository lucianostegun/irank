<?php

class statsActions extends sfActions
{

  public function preExecute(){
	
	$this->userSiteId = $this->getUser()->getAttribute('userSiteId');
	$this->peopleId   = $this->getUser()->getAttribute('peopleId');
  }

  public function executeIndex($request){

	$this->userSiteObj = UserSitePeer::retrieveByPK( $this->userSiteId );
  }

  public function handleErrorExport(){

  	$this->handleFormFieldError( $this->getRequest()->getErrors() );
  }
  
  public function executeExport($request){
  	
  	$export = $request->getParameter('export');
  	$format = $request->getParameter('format');
  	
  	if( !$export ){
  		
  		echo 'validado';
  		exit;
  	}
  	
  	if( $format=='chart' )
  		return $this->forward('stats', 'exportChart');
  }
  
  public function executeExportChart($request){
  	
  	$reportType = $request->getParameter('reportType');
  	
  	$this->rankingId = $request->getParameter('rankingId');
  	
  	switch($reportType){
  		case 'rankHistory':
  			return $this->setTemplate('rankHistoryChart');
  		case 'playersBalance':
  			return $this->setTemplate('playersBalanceChart');
  		case 'myPerformance':
  			return $this->setTemplate('myPerformanceChart');
  		case 'myBalance':
  			return $this->setTemplate('myBalanceChart');
  		default:
  			throw new Exception('Relatório "'.$reportType.'" não encontrado');
  			exit;
  	}
  	
  }
}
