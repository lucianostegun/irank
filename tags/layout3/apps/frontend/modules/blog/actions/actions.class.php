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
    else{
    	
    	$blogObj   = Blog::getLastArticle();
    	$permalink = $blogObj->getPermalink();
    	$host    = $request->getHost();
    	return $this->redirect("http://$host/blog/$permalink.html");
    }
  }
  
  public function executeTag($request){
    
    return $this->forward('blog', 'index');
  }
}
