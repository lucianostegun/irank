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
	
	public static function validateProductItem($productItemId){
		
		$productId            = MyTools::getRequestParameter('productId');
		$productOptionIdColor = MyTools::getRequestParameter('productOptionIdColor');
		$productOptionIdSize  = MyTools::getRequestParameter('productOptionIdSize');
		
		$criteria = new Criteria();
		$criteria->add( ProductItemPeer::PRODUCT_ID, $productId );
		$criteria->add( ProductItemPeer::PRODUCT_OPTION_ID_COLOR, $productOptionIdColor );
		$criteria->add( ProductItemPeer::PRODUCT_OPTION_ID_SIZE, $productOptionIdSize );
		$criteria->add( ProductItemPeer::ID, $productItemId, Criteria::NOT_EQUAL );
		$criteria->add( ProductItemPeer::ENABLED, true );
		$criteria->add( ProductItemPeer::VISIBLE, true );
		$criteria->add( ProductItemPeer::DELETED, false );
		$productObj = ProductItemPeer::doSelectOne($criteria);
		
		if( !is_object($productObj) )
			return true;
		
		MyTools::setError('productOptionIdColor', 'Já existe um item utilizando esta cor e tamanho para este produto');
		MyTools::setError('productOptionIdSize', 'Já existe um item utilizando esta cor e tamanho para este produto');
		
		return false;
	}
}
