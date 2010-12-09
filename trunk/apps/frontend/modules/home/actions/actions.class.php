<?php

class homeActions extends sfActions
{

  public function executeIndex($request){

  }
  
  public function executeJavascript($request){
  	
    header('Content-type: text/x-javascript');
		
  	$nl = chr(10);
  	
  	$peopleId   = $this->getUser()->getAttribute('peopleId');
  	
	echo 'var _imageRoot = "http://'.$request->getHost() .'/images";'.$nl;
	echo 'var _CurrentPeopleId = "'.$peopleId.'";'.$nl;
	exit;
  }
}
