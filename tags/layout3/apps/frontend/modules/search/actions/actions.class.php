<?php

class searchActions extends sfActions
{

  public function executeIndex($request){
  	
  	$this->keyWord = $request->getParameter('mainSearch');
  }
}
