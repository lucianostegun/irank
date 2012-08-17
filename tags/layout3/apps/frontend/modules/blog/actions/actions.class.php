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
    
    $this->showStoreBar = true;
  }
  
  public function executeIndex($request){
    
    $permalink = $request->getParameter('permalink');

	if( $permalink )
    	$this->blogObj = BlogPeer::retrieveByPermalink($permalink);
    else
    	$this->blogObj = Blog::getLastArticle();
  }
  
  public function executeTag($request){
    
    return $this->forward('blog', 'index');
  }
}
