<?php

class homeActions extends sfActions
{

  public function executeIndex($request){

  }

  public function executeGetNewId($request)
  {

	$className          = $request->getParameter('className');
	$requiredField      = $request->getParameter('requiredField');
	$requiredFieldValue = $request->getParameter('requiredFieldValue');
	$getObject          = $request->getParameter('getObject');
	
	$requiredFieldList = array();
	
	if( $requiredField && $requiredFieldValue )
		$requiredFieldList[$requiredField] = $requiredFieldValue;
	
	$newObj = Util::getNewObject( $className, $requiredFieldList );
	
	if( $getObject )
		echo Util::parseInfo($newObj->getInfo());
	else
		echo $newObj->getId();
	
	exit;
  }
  
  public function executeAccessDenied($request)
  {
  }
  
  public function executeGetTab($request){
  	
  	$tabAddress = $request->getParameter('tabAddress');
  	$options    = $request->getParameter('options');
  	$options    = unserialize($options);

	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	
	return $this->renderText(get_partial($tabAddress, $options));
  }
  
  public function executeGetWindow($request){
  	
  	$windowAddress = $request->getParameter('windowAddress');
  	$options       = $request->getParameter('options');
  	$options       = unserialize($options);

	sfConfig::set('sf_web_debug', false);
	sfLoader::loadHelpers('Partial', 'Object', 'Asset', 'Tag', 'Javascript', 'Form', 'Text');
	
	return $this->renderText(get_partial($windowAddress, $options));
  }
  
  public function executeJavascript($request){
  	
    header('Content-type: text/x-javascript');
	
  	$nl = chr(10);
	
	exit;
  }
  
  public function executeStylesheet($request){
  	
    header('Content-type: text/stylesheet');
	
  	$nl = chr(10);
	
	exit;
  }
  
  public function executeGetXml($request){
    
    $model = $request->getParameter('model');
	
	$data = array();
	    	
    switch( $model ){
    	case 'module':	
			echo DhtmlxMenu::getXml();
			break;
		case 'toolbar':
			
			$moduleId            = $request->getParameter('moduleId');
			$actionName          = $request->getParameter('actionName');
			$realActionName      = $request->getParameter('realActionName');
			$toolbarDisabledList = $request->getParameter('toolbarDisabledList');
			
			echo DhtmlxToolbar::getXml( $moduleId, $actionName, $realActionName, $toolbarDisabledList );
			break;
		}
        
    exit;
  }
}
