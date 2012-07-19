<?php

/**
 * util actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class utilActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeIndex($request){
    
  }

  public function executeGetAddressByZipcode($request){
  	
  	$zipcode = $request->getParameter('zipcode');
  	
	echo Util::getAddressByZipcode($zipcode, false);
	exit;
  }
}
