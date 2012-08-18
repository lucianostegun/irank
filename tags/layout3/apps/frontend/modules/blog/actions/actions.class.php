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
    $this->facebookMetaList = array();
	$this->facebookMetaList['image'] = 'http://[host]/images/blog/logo.png';
  }
  
  public function executeIndex($request){
  	
	return $this->forward('blog', 'article');
  }
  
  public function executeArticle($request){
    
    $permalink = $request->getParameter('permalink');

	if( $permalink ){
    	
    	$this->blogObj = BlogPeer::retrieveByPermalink($permalink);
		$this->facebookMetaList['description'] = $this->blogObj->getCaption();
	}else{
    	
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
