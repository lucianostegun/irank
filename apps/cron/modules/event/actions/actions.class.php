<?php

class eventActions extends sfActions
{

  public function preExecute(){

	$this->getUser()->setAttribute('cron', true);
  }
  
  public function executeReminder($request){
	
	$days = $request->getParameter('days', 7);
	$createdAt = date('Y-m-d', mktime(0,0,0,date('m'), date('d')-2, date('Y')));
	$eventDate = date('Y-m-d', mktime(0,0,0,date('m'), date('d')+$days, date('Y')));

	$criteria = new Criteria();
	$criteria->setNoFilter(true);
	$criteria->add( EventPeer::ENABLED, true );
	$criteria->add( EventPeer::VISIBLE, true );
	$criteria->add( EventPeer::DELETED, false );
	$criteria->add( EventPeer::EVENT_DATE, $eventDate );
	$criteria->add( EventPeer::CREATED_AT, $createdAt, Criteria::LESS_EQUAL );
	$eventObjList = EventPeer::doSelect($criteria);
	
	foreach($eventObjList as $eventObj)
		$eventObj->notifyReminder($days);
	
	$this->getUser()->getAttributeHolder()->remove('cron');
	
	echo 'Notificações enviadas com sucesso para '.count($eventObjList).' evento(s)';
	exit;
  }
  
  public function executeImportEmailComments($request){
	
		
		
		
		
		
		
		
		
	$bUseSockets = FALSE;
	$bUseTLS = TRUE;
	$bIPv6 = FALSE;
	$arrConnectionTimeout = array( "sec" => 10,
	                               "usec" => 500 );
	// POP3 Options
	$strProtocol= "ssl";
	$strHost = "pop.irank.com.br";
	$intPort = 995;
	$strUser = "event_comment@irank.com.br";
	$strPass = "K33p0utme";
	$bAPopAutoDetect = TRUE;
	$bHideUsernameAtLog = FALSE;
	
	echo '<pre>';
	
	try
	{
	    $objPOP3 = new POP3Import( null, $bAPopAutoDetect, $bHideUsernameAtLog, $strProtocol, $bUseSockets );
	    $objPOP3->connect($strHost,$intPort,$arrConnectionTimeout,$bIPv6);
	    $objPOP3->login($strUser, $strPass);
	    $arrOfficeStatus = $objPOP3->getOfficeStatus();
		    
	    for($intMsgNum = 1; $intMsgNum <= $arrOfficeStatus["count"]; $intMsgNum++ ){
	    	
			$message = $objPOP3->getMsg($intMsgNum);
//			$message = explode(chr(10), $message);
			print_r($message);
			echo '<hr>';
	//        $objPOP3->deleteMsg($intMsgNum);
	    }
	
	    $objPOP3->quit();
	    $objPOP3->disconnect();
	}
	catch( POP3_Exception $e )
	{
	    die($e);
	}
		
		
		
		exit;
		
  }
}
