<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'product_option'.
 *
 * 
 *
 * @package lib.model
 */ 
class ProductOptionPeer extends BaseProductOptionPeer
{

	public static function uniqueOptionName($optionName){
		
		$productOptionId   = MyTools::getRequestParameter('productOptionId');
		$optionType        = MyTools::getRequestParameter('optionType');
		$productCategoryId = MyTools::getRequestParameter('productCategoryId');
		
		$criteria = new Criteria();
		$criteria->add( ProductOptionPeer::PRODUCT_CATEGORY_ID, $productCategoryId );
		$criteria->add( ProductOptionPeer::OPTION_TYPE, $optionType );
		$criteria->add( ProductOptionPeer::OPTION_NAME, $optionName, Criteria::ILIKE );
		$criteria->add( ProductOptionPeer::ID, $productOptionId, Criteria::NOT_EQUAL );
		$criteria->add( ProductOptionPeer::ENABLED, true );
		$criteria->add( ProductOptionPeer::VISIBLE, true );
		$criteria->add( ProductOptionPeer::DELETED, false );
		$productOptionObj = ProductOptionPeer::doSelectOne($criteria);
		
		return !is_object($productOptionObj);
	}

	public static function uniqueDescription($description){
		
		$productOptionId   = MyTools::getRequestParameter('productOptionId');
		$optionType        = MyTools::getRequestParameter('optionType');
		$productCategoryId = MyTools::getRequestParameter('productCategoryId');
		
		$criteria = new Criteria();
		$criteria->add( ProductOptionPeer::PRODUCT_CATEGORY_ID, $productCategoryId );
		$criteria->add( ProductOptionPeer::OPTION_TYPE, $optionType );
		$criteria->add( ProductOptionPeer::DESCRIPTION, $description, Criteria::ILIKE );
		$criteria->add( ProductOptionPeer::ID, $productOptionId, Criteria::NOT_EQUAL );
		$criteria->add( ProductOptionPeer::ENABLED, true );
		$criteria->add( ProductOptionPeer::VISIBLE, true );
		$criteria->add( ProductOptionPeer::DELETED, false );
		$productOptionObj = ProductOptionPeer::doSelectOne($criteria);
		
		return !is_object($productOptionObj);
	}

	public static function uniqueTagName($tagName){
		
		$productOptionId   = MyTools::getRequestParameter('productOptionId');
		$optionType        = MyTools::getRequestParameter('optionType');
		$productCategoryId = MyTools::getRequestParameter('productCategoryId');
		
		$criteria = new Criteria();
		$criteria->add( ProductOptionPeer::PRODUCT_CATEGORY_ID, $productCategoryId );
		$criteria->add( ProductOptionPeer::OPTION_TYPE, $optionType );
		$criteria->add( ProductOptionPeer::TAG_NAME, $tagName, Criteria::ILIKE );
		$criteria->add( ProductOptionPeer::ID, $productOptionId, Criteria::NOT_EQUAL );
		$criteria->add( ProductOptionPeer::ENABLED, true );
		$criteria->add( ProductOptionPeer::VISIBLE, true );
		$criteria->add( ProductOptionPeer::DELETED, false );
		$productOptionObj = ProductOptionPeer::doSelectOne($criteria);
		
		return !is_object($productOptionObj);
	}
}
