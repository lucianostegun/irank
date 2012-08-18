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
    
    $blogId       = $this->getRequestParameter('id');
    $this->blogId = $this->getRequestParameter('blogId', $blogId);
    
    $this->showStoreBar = true;
    $this->facebookMetaList = array();
	$this->facebookMetaList['image'] = 'http://[host]/images/blog/logo.png';
  }
  
  public function executeIndex($request){
  	
	$permalink = $request->getParameter('permalink');
	
	if( $permalink )
		return $this->forward('blog', 'article');
	
	$blogObj   = Blog::getLastArticle();
	$host      = $request->getHost();
	$permalink = $blogObj->getPermalink();
	
	return $this->redirect("blog/article/$permalink.html");
  }
  
  public function executeArticle($request){
    
    $permalink = $request->getParameter('permalink');

	if( $permalink )
    	$this->blogObj = BlogPeer::retrieveByPermalink($permalink);
    
	$this->facebookMetaList['description'] = $this->blogObj->getCaption();
	$this->facebookMetaList['title']       = 'iRank Blog :: '.$this->blogObj->toString();
	$this->facebookMetaList['url']         = "http://www.irank.com.br/blog/article/$permalink";
  }
  
  public function executeTag($request){
    
    return $this->forward('blog', 'index');
  }
}