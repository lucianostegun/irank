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
		$peopleId       = MyTools::getAttribute('peopleId');
		
		$this->setTitle( $title );
		$this->setCaption( $caption );
		$this->setShortTitle( $shortTitle );
		$this->setBlogCategoryId( $blogCategoryId );
		$this->setTags( $tags );
		$this->setPermalink( $permalink );
		$this->setContent( $content );
		$this->setGlossary( nvl($glossary) );
		$this->setIsDraft( ($isDraft?true:false) );
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
		$criteria->addDescendingOrderByColumn( BlogPeer::CREATED_AT );
		
		return BlogPeer::doSelect( $criteria );
	}

	public static function getLastArticle(){
		
		$criteria = new Criteria();
		$criteria->add( BlogPeer::ENABLED, true );
		$criteria->add( BlogPeer::VISIBLE, true );
		$criteria->add( BlogPeer::DELETED, false );
		$criteria->add( BlogPeer::IS_DRAFT, false );
		$criteria->addDescendingOrderByColumn( BlogPeer::CREATED_AT );
		
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
}
