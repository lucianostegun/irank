<?php

class myAccountActions extends sfActions
{

  public function preExecute(){

  }

  public function executeIndex($request){
	
	return $this->forward('sign', 'edit');
  }
}
