<?php

/**
 * blog actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class blogActions extends sfActions
{

  public function preExecute(){
    
  }
  
  public function executeIndex($request){
    
  }
  
  public function executeTag($request){
    
    return $this->forward('blog', 'index');
  }
}
