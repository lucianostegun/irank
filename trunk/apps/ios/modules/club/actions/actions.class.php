<?php

/**
 * club actions.
 *
 * @package    sf_sandbox
 * @subpackage club
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class clubActions extends sfActions
{
	
  public function preExecute(){
  	
	$this->userSiteId = $this->getRequestParameter('userSiteId');
  	$this->language   = $this->getRequestParameter('language');
  }
    
  /**
   * Executes index action
   *
   */
  public function executeGetXml($request){
  	
  	$userSiteId  = $request->getParameter('userSiteId');
  	$model       = $request->getParameter('model');
	
	switch( $model ){
		case 'club':
			
			$clubObjList = Club::getList();
			$host        = $request->getHost();
		
			foreach($clubObjList as $clubObj){
				
				$clubNode = array();
				
				$fileNameLogo = $clubObj->getFileNameLogo();
				$description  = $clubObj->getDescription();
				$description  = strip_tags($description);
				
				$clubNode['@attributes']    = array('id'=>$clubObj->getId(), 'latitude'=>$clubObj->getLatitude(), 'longitude'=>$clubObj->getLongitude());
				$clubNode['clubName']       = $clubObj->toString();
				$clubNode['addressName']    = $clubObj->getAddressName();
				$clubNode['addressNumber']  = $clubObj->getAddressNumber();
				$clubNode['addressQuarter'] = $clubObj->getAddressQuarter();
				$clubNode['city']           = $clubObj->getCity()->getCityName();
				$clubNode['state']          = $clubObj->getCity()->getState()->getInitial();
				$clubNode['description']    = $description;
				$clubNode['clubSite']       = str_ireplace('http://', '', $clubObj->getClubSite());
				$clubNode['phoneNumber']    = $clubObj->getPhoneNumber1();
				$clubNode['fileNameLogo']   = $fileNameLogo;
				$clubNode['logoUrl']        = "http://$host/images/club/$fileNameLogo";

				$clubList[] = $clubNode;
			}
			
			echo Club::getXml($clubList);
			break;
	}
	exit;
  }
}
