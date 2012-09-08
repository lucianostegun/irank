<?php

/**
 * Subclasse de representação de objetos da tabela 'blog'.
 *
 * 
 *
 * @package lib.model
 */ 
class Blog extends BaseBlog
{
	
	public function toString(){
		
		return $this->getTitle();
	}
	
	public function quickSave($request){
		
		$title          = $request->getParameter('title');
		$caption        = $request->getParameter('caption');
		$shortTitle     = $request->getParameter('shortTitle');
		$blogCategoryId = $request->getParameter('blogCategoryId');
		$tags           = $request->getParameter('tags');
		$permalink      = $request->getParameter('permalink');
		$isDraft        = $request->getParameter('isDraft');
		$content        = $request->getParameter('content');
		$glossary       = $request->getParameter('glossary');
		$publishDate    = $request->getParameter('publishDate');
		$publishTime    = $request->getParameter('publishTime');
		$peopleId       = MyTools::getAttribute('peopleId');
		
		$publishDate .= ' '.$publishTime;
		
		$this->setTitle( $title );
		$this->setCaption( $caption );
		$this->setShortTitle( $shortTitle );
		$this->setBlogCategoryId( $blogCategoryId );
		$this->setTags( $tags );
		$this->setPermalink( $permalink );
		$this->setContent( $content );
		$this->setGlossary( nvl($glossary) );
		$this->setIsDraft( ($isDraft?true:false) );
		$this->setPublishDate( Util::formatDateTime($publishDate) );
		$this->setVisible( true );
		$this->setEnabled( true );
		
		if( !$this->getPeopleId() )
			$this->setPeopleId($peopleId);
			
		$this->save();
	}
	
	public static function getList(Criteria $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( BlogPeer::ENABLED, true );
		$criteria->add( BlogPeer::VISIBLE, true );
		$criteria->add( BlogPeer::DELETED, false );
		
		$criteria->addDescendingOrderByColumn( BlogPeer::PUBLISH_DATE );
		
		return BlogPeer::doSelect( $criteria );
	}

	public static function getLastArticle(){
		
		$criteria = new Criteria();
		$criteria->add( BlogPeer::ENABLED, true );
		$criteria->add( BlogPeer::VISIBLE, true );
		$criteria->add( BlogPeer::DELETED, false );
		$criteria->add( BlogPeer::IS_DRAFT, false );
		
		$criterion = $criteria->getNewCriterion( BlogPeer::PUBLISH_DATE, date('Y-m-d'), Criteria::LESS_EQUAL );
		$criterion->addOr( $criteria->getNewCriterion( BlogPeer::PUBLISH_DATE, null ) );
		$criteria->add($criterion);
		
		$criteria->addDescendingOrderByColumn( BlogPeer::PUBLISH_DATE );
		
		return BlogPeer::doSelectOne( $criteria );
	}
	
	public function getBlogCategory(){
		
		return $this->getVirtualTable();
	}
	
	public function getPeople($con=null){
		
		$peopleObj = parent::getPeople($con);
		
		if( !is_object($peopleObj) )
			$peopleObj = People::getCurrentPeople();
		
		return $peopleObj;
	}
	
	public function getResume(){
		
		$content = $this->getContent();
		preg_match('/(.*)<hr class="intro"\/?>/ims', $content, $matches);
		$content = $matches[1];
		$content = preg_replace('/<h1 class="imageFooter">.*<\/h1>/i', '', $content);
		$content = strip_tags($content, '<p><b><span><br><br/>');
		$content = trim($content);
		$content = preg_replace('/^<br\/?>/', '', $content);
		$content = str_replace('<p><br></p>', '', $content);
		$content = preg_replace('/<br\/?> *?\n?$/', '', $content);
		$content = trim($content);
		
		return $content;
	}
}
