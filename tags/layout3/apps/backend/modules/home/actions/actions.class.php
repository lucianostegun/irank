<?php

/**
 * home actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class homeActions extends sfActions
{

  public function preExecute(){

  	$this->pathList = array('Resumo geral'=>'home/index');
  }
  
  public function executeIndex($request){
  	
  }
  
  public function executeOriginal($request){
  	
  }

  public function executeError404($request){
  	
  }
  
  public function executeJavascript($request){
	
	Util::getHelper('i18n');
	
    header('Content-type: text/x-javascript');
		
	$nl = chr(10);
	
	$isAuthenticated = $this->getUser()->isAuthenticated();
	
	$scriptName = $request->getScriptName();
	$hostname   = $request->getHost();
	$isDebug    = $request->getParameter('debug');
	
	if( $isDebug )
		$scriptName = '/backend_dev.php';
	else
		$scriptName = '/backend.php';
		
	$scriptNameFrontend = ($isDebug?'/frontend_dev.php':'/index.php');

	$isDebug    = ($isDebug?'true':'false');
	
	$peopleId   = $this->getUser()->getAttribute('peopleId');
	
	echo 'var _CurrentPeopleId = "'.$peopleId.'";'.$nl.$nl;
	
	echo "var _webRoot         = '$scriptName';".$nl;
	echo "var _webRootFrontend = '$scriptName';".$nl;
	echo "var _imageRoot       = 'http://$hostname/images';".$nl;
	echo "var _isDebug         = $isDebug;".$nl;
	echo "var _isMobile        = false;".$nl;
	echo "var i18n_culture     = 'pt_BR';".$nl.$nl;
	
	if( $isAuthenticated ){
		
		$emailDebug = Settings::getValue('emailDebug');
		echo "var _emailDebug  = '$emailDebug';".$nl.$nl;
	}
	
	exit;
  }
}
