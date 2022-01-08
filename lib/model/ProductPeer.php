<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'product'.
 *
 * 
 *
 * @package lib.model
 */ 
class ProductPeer extends BaseProductPeer
{
	
	public static function search(Criteria $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
		
		$criteria->addJoin( ProductPeer::PRODUCT_CATEGORY_ID, ProductCategoryPeer::ID, Criteria::INNER_JOIN );
		
		$criteria->add( ProductPeer::ENABLED, true );
		$criteria->add( ProductPeer::DELETED, false );
		$criteria->add( ProductPeer::VISIBLE, true );
		
		$criteria->addAscendingOrderByColumn( 'RANDOM()' );
		
		return ProductPeer::doSelect($criteria);
	}
	
	public static function retrieveByCode($productCode){
		
		$criteria = new Criteria();
		$criteria->add( ProductPeer::PRODUCT_CODE, $productCode, Criteria::ILIKE );
		return ProductPeer::doSelectOne($criteria);
	}

	public static function uniqueProductCode($productCode){
		
		$productId = MyTools::getRequestParameter('productId');
		
		$criteria = new Criteria();
		$criteria->add( ProductPeer::PRODUCT_CODE, $productCode, Criteria::ILIKE );
		$criteria->add( ProductPeer::ID, $productId, Criteria::NOT_EQUAL );
		$criteria->add( ProductPeer::ENABLED, true );
		$criteria->add( ProductPeer::VISIBLE, true );
		$criteria->add( ProductPeer::DELETED, false );
		$productObj = ProductPeer::doSelectOne($criteria);
		
		return !is_object($productObj);
	}
}
