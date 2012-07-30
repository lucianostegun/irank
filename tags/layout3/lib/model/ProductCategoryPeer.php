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
}
