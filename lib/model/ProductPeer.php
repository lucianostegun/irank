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
	
	public static function retrieveByCode($productCode){
		
		$criteria = new Criteria();
		$criteria->add( ProductPeer::PRODUCT_CODE, $productCode, Criteria::ILIKE );
		return ProductPeer::doSelectOne($criteria);
	}
}
