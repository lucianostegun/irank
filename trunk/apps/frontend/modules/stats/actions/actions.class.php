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
  	
  	if( $format=='report' )
  		return $this->forward('stats', 'exportReport');
  	if( $format=='chart' )
  		return $this->forward('stats', 'exportChart');
  }
  
  public function executeExportReport($request){
  	
  	$reportType = $request->getParameter('reportType');

  	$this->rankingId = $request->getParameter('rankingId');
  	
  	switch($reportType){
  		case 'rankHistory':
  			$reportTemplate = 'rankHistory';
  			break;
  		case 'playersBalance':
  			$reportTemplate = 'playersBalance';
  			break;
  		case 'myPerformance':
  			$reportTemplate = 'myPerformance';
  			break;
  		case 'myBalance':
  			$reportTemplate = 'myBalance';
  			break;
  		default:
  			throw new Exception('Relatório "'.$reportType.'" não encontrado');
  	}
  	
  	$this->setTemplate('report/'.$reportTemplate);
  }
  
  public function executeExportChart($request){
  	
  	$reportType = $request->getParameter('reportType');
  	
  	$this->rankingId = $request->getParameter('rankingId');
  	
  	switch($reportType){
  		case 'playersBalance':
  			$reportTemplate = 'playersBalance';
  			break;
  		case 'myPerformance':
  			$reportTemplate = 'myPerformance';
  			break;
  		case 'myBalance':
  			$reportTemplate = 'myBalance';
  			break;
  		default:
  			throw new Exception('Gráfico "'.$reportType.'" não encontrado');
  	}
  	
  	$this->setTemplate('chart/'.$reportTemplate);
  }
}
