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
    
    $this->showStoreBar = (time() >= strtotime('2012-10-02 20:30') || Util::isDebug());
    $this->facebookMetaList = array();
	$this->facebookMetaList['image'] = array('http://[host]/images/blog/logo.png');
  }
  
  public function executeIndex($request){
  	
	$permalink = $request->getParameter('permalink');
	
	if( $permalink )
		return $this->redirect("blog/article?$permalink=");
  }
  
  public function executeArticle($request){
    
    $permalink = $request->getParameter('permalink');

	if( $permalink )
    	$this->blogObj = BlogPeer::retrieveByPermalink($permalink);
    
	$this->facebookMetaList['description'] = $this->blogObj->getCaption();
	$this->facebookMetaList['title']       = 'iRank Blog :: '.$this->blogObj->toString();
	$this->facebookMetaList['url']         = "http://www.irank.com.br/blog/article/$permalink";
	
	$imageShare = $this->blogObj->getImageShare();
	
	if( $imageShare )
		$this->facebookMetaList['image'] = array('http://[host]/images/blog/'.$imageShare, $this->facebookMetaList['image'][0]);
  }
  
  public function executeTag($request){
    
    return $this->forward('blog', 'index');
  }
  
  public function executeGetDictionary($request){
    
    $term = $request->getParameter('term');
    $term = html_entity_decode($term);
    $glossaryObj = GlossaryPeer::retrieveByTerm($term);
    
    if( !is_object($glossaryObj) )
    	die('Termo não encontrado!');
    
    echo $glossaryObj->getDescription(true);
    exit;
  }
  
  public function executeFeed($request){
    
  	$metas = sfContext::getInstance()->getResponse()->getMetas();
  	$headerDescription = $metas['description'];
  	
    // Intanciamos/chamamos a classe
	$rss = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss></rss>');
	$rss->addAttribute('version', '2.0');
	 
	// Cria o elemento <channel> dentro de <rss>
	$canal = $rss->addChild('channel');
	// Adiciona sub-elementos ao elemento <channel>
	$canal->addChild('title', 'Blog iRank');
	$canal->addChild('link', 'http://www.irank.com.br/');
	$canal->addChild('description', $headerDescription);
	
	$criteria = new Criteria();
	$criteria->add( BlogPeer::IS_DRAFT, false );

	$criterion = $criteria->getNewCriterion( BlogPeer::PUBLISH_DATE, date('Y-m-d'), Criteria::LESS_EQUAL );
	$criterion->addOr( $criteria->getNewCriterion( BlogPeer::PUBLISH_DATE, null ) );
	$criteria->add($criterion);
	$criteria->setLimit(10);
	
	foreach( Blog::getList($criteria) as $blogObj){
	
		// Criar elemento <item> dentro de <channel>
		$item = $canal->addChild('item');
		// Adiciona sub-elementos ao elemento <item>
		$item->addChild('title', $blogObj->getTitle());
		$item->addChild('link', 'http://www.irank.com.br/blog/'.$blogObj->getPermalink());
		$item->addChild('description', $blogObj->getCaption());
		$item->addChild('pubDate', $blogObj->getPublishDate('r'));
	}
	
	// Define o tipo de conteúdo e o charset
	//header("content-type: application/rss+xml; charset=utf-8");

	// Entrega o conteúdo do RSS completo:
	echo $rss->asXML();
	
	exit;
  }
}