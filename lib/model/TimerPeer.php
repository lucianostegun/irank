<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'timer'.
 *
 * 
 *
 * @package lib.model
 */ 
class TimerPeer extends BaseTimerPeer
{
	
	public static function validateLevels($step){

		$request = MyTools::getRequest();
		
	  	$smallBlindList = $request->getParameter('smallBlind');
	  	$bigBlindList   = $request->getParameter('bigBlind');
	  	$anteList       = $request->getParameter('ante');
	  	$durationList   = $request->getParameter('duration');
	  	
	  	$levelList = array();
	  	$levels    = 0;
	  	
	  	foreach($durationList as $key=>$duration){
	  		
	  		$smallBlind = $smallBlindList[$key];
	  		$bigBlind   = $bigBlindList[$key];
	  		$ante       = $anteList[$key];
	  		$duration   = $duration;
	  		
	  		if( !is_numeric($smallBlind) || !is_numeric($bigBlind) || !is_numeric($ante) || !is_numeric($duration) ||
	  			$smallBlind < 0 || $bigBlind < 0 || $ante < 0 || $duration < 0 )
	  			return false;
	  	}
	  	
	  	return true;
	}
}
