<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'blog'.
 *
 * 
 *
 * @package lib.model
 */ 
class BlogPeer extends BaseBlogPeer
{
	
	public static function retrieveByPermalink($permalink){
		
		$criteria = new Criteria();
		$criteria->add( BlogPeer::PERMALINK, $permalink, Criteria::ILIKE );
		$criteria->add( BlogPeer::ENABLED, true );
		$criteria->add( BlogPeer::VISIBLE, true );
		$criteria->add( BlogPeer::DELETED, false );
		return BlogPeer::doSelectOne($criteria);
	}

	public static function uniquePermalink($permalink){
		
		$blogId = MyTools::getRequestParameter('blogId');
		
		$criteria = new Criteria();
		$criteria->add( BlogPeer::PERMALINK, $permalink, Criteria::ILIKE );
		$criteria->add( BlogPeer::ID, $blogId, Criteria::NOT_EQUAL );
		$criteria->add( BlogPeer::ENABLED, true );
		$criteria->add( BlogPeer::VISIBLE, true );
		$criteria->add( BlogPeer::DELETED, false );
		
		return !is_object(BlogPeer::doSelectOne($criteria));
	}
}
