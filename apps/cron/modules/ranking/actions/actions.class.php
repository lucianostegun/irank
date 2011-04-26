<?php

class rankingActions extends sfActions
{

  public function preExecute(){

	$this->getUser()->setAttribute('cron', true);
  }
  
  public function executeAdjustPlayers($request){
	
	Ranking::adjustPlayers();
	
	echo date('Y-m-d H:i:s').' - Ajuste dos jogadores dos rankings realizados com sucesso!'.chr(10);
	
	exit;
  }
  
  public function executeAdjustEvents($request){
	
	Ranking::adjustEvents();
	
	echo date('Y-m-d H:i:s').' - Ajuste dos eventos dos rankings realizados com sucesso!'.chr(10);
	
	exit;
  }
}
