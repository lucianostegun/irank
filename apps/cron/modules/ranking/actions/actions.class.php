<?php

class rankingActions extends sfActions
{

  public function preExecute(){

	$this->getUser()->setAttribute('cron', true);
  }
  
  public function executeAdjustPlayers($request){
	
	Ranking::adjustPlayers();
	exit;
  }
  
  public function executeAdjustEvents($request){
	
	Ranking::adjustEvents();
	exit;
  }
}
