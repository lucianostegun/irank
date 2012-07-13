<?php

/**
 * sms actions.
 *
 * @package    iRank
 * @subpackage backend
 * @author     Luciano Stegun
 */
class smsActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeGetToken($request){
    
    try{
    	
    	$textMessage = $request->getParameter('textMessage');
    	$className   = $request->getParameter('className');
    	$objectId    = $request->getParameter('objectId');
    	
	    $smsObj = Sms::getNewSms($textMessage, $className, $objectId);
	    echo Util::parseInfo($smsObj->getInfo());
    }catch(Exception $e){
    	
    	Util::forceError($e->getMessage());
    }
    
    exit;
  }
  
  public function executeGetCredit($request){
    
    echo Sms::getCurrentCredit();
    
    exit;
  }
}
