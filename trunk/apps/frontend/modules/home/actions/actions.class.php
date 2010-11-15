<?php

class homeActions extends sfActions
{

  public function executeIndex($request){

  }
  
  public function executeJavascript($request){
  	
    header('Content-type: text/x-javascript');
		
  	$nl = chr(10);
  	
	echo 'var _imageRoot = "http://'.$request->getHost() .'/images";'.$nl;
	exit;
  }
}
