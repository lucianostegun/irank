<?php

/**
 * controlPanel actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class controlPanelActions extends sfActions
{

  public function preExecute(){
    
    $this->hiddenToolbarList = array('new', 'cancel', 'delete');
    $this->pathList = array('Painel de controle'=>'controlPanel/index');
  }
  
  public function executeIndex($request){
    
  }

  public function executeSave($request){
    
	Config::saveConfig('smtpHostname', $request);
	Config::saveConfig('smtpUsername', $request);
	Config::saveConfig('smtpPassword', $request);
	Config::saveConfig('emailSenderName', $request);
	Config::saveConfig('encodeEmailToUTF8', $request);
	Config::saveConfig('decodeEmailFromUTF8', $request);

	Config::saveConfig('htpasswdFilePath', $request);
	exit;
  }
}
