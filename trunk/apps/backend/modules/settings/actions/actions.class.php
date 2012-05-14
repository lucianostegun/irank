<?php

/**
 * settings actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class settingsActions extends sfActions
{

  public function preExecute(){
    
    $this->pathList    = array('Configurações'=>'settings/index');
  	$this->toolbarList = array('save');
  	
  	$this->clubId      = $this->getUser()->getAttribute('clubId');
  	$this->userAdminId = $this->getUser()->getAttribute('userAdminId');
  	
  	if( $this->clubId )
  		$this->genericObj = ClubPeer::retrieveByPK($this->clubId);
  	else
  		$this->genericObj = UserAdminPeer::retrieveByPK($this->userAdminId);
  }
  
  public function executeIndex($request){
    
  }

  public function executeSave($request){
    
    $attribute = ($this->clubId?'club':'userAdmin');
    
	Settings::saveValue('hoursToPending', $request, $attribute);
	Settings::saveValue('emailDebug', $request, $attribute);

	// Configurações da aba Template
	Settings::saveValue('emailTemplateIdEventCreateNotify', $request, $attribute);
	Settings::saveValue('facebookTemplate', $request, $attribute);
	Settings::saveValue('twitterTemplate', $request, $attribute);
	exit;
  }
}
