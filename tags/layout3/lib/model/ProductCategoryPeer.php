<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'product_category'.
 *
 * 
 *
 * @package lib.model
 */ 
class ProductCategoryPeer extends BaseProductCategoryPeer
{
	
	public static function retrieveByTagName($tagName){
		
		$criteria = new Criteria();
		$criteria->add( ProductCategoryPeer::TAG_NAME, $tagName );
		return ProductCategoryPeer::doSelectOne( $criteria );
	}

	public static function uniqueTagName($tagName){
		
		$productCategoryId = MyTools::getRequestParameter('productCategoryId');
		
		$criteria = new Criteria();
		$criteria->add( ProductCategoryPeer::ID, $productCategoryId, Criteria::NOT_EQUAL );
		$criteria->add( ProductCategoryPeer::TAG_NAME, $tagName, Criteria::ILIKE );
		$criteria->add( ProductCategoryPeer::ENABLED, true );
		$criteria->add( ProductCategoryPeer::VISIBLE, true );
		$criteria->add( ProductCategoryPeer::DELETED, false );
		$productCategoryObj = ProductCategoryPeer::doSelectOne($criteria);
		
		return !is_object($productCategoryObj);
	}
}
