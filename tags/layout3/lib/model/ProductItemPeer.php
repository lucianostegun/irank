<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'product_item'.
 *
 * 
 *
 * @package lib.model
 */ 
class ProductItemPeer extends BaseProductItemPeer
{
	
	public static function retrieveByOptions($productId, $productOptionIdColor, $productOptionIdSize){
		
		$criteria = new Criteria();
		$criteria->add( ProductItemPeer::PRODUCT_ID, $productId );
		$criteria->add( ProductItemPeer::PRODUCT_OPTION_ID_COLOR, $productOptionIdColor );
		$criteria->add( ProductItemPeer::PRODUCT_OPTION_ID_SIZE, $productOptionIdSize );
		return ProductItemPeer::doSelectOne($criteria);
	}
}
