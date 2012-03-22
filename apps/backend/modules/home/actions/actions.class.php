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
	
	$scriptName = $request->getScriptName();
	$hostname   = $request->getHost();
	$isDebug    = $request->getParameter('debug');
	
	if( $isDebug )
		$scriptName = '/backend_dev.php';
	
	$isDebug    = ($isDebug?'true':'false');
	
	$peopleId   = $this->getUser()->getAttribute('peopleId');
	
	echo 'var _CurrentPeopleId = "'.$peopleId.'";'.$nl.$nl;
	
	echo "var _webRoot   = '$scriptName';".$nl;
	echo "var _imageRoot = 'http://$hostname/images';".$nl;
	echo "var _isDebug   = $isDebug;".$nl;
	echo "var _isMobile  = false;".$nl.$nl;
	exit;
  }
}
