<?php

/**
 * Subclasse de representação de objetos da tabela 'product_option'.
 *
 * 
 *
 * @package lib.model
 */ 
class ProductOption extends BaseProductOption
{
	
	public static function getList($optionType, $productId){
		
		$criteria = new Criteria();
		$criteria->add( ProductOptionPeer::OPTION_TYPE, $optionType );
		$criteria->add( ProductItemPeer::VISIBLE, true );
		$criteria->add( ProductItemPeer::ENABLED, true );
		$criteria->add( ProductItemPeer::DELETED, false);
		$criteria->add( ProductItemPeer::PRODUCT_ID, $productId );
		$criteria->addJoin( ProductOptionPeer::ID, "product_item.PRODUCT_OPTION_ID_$optionType", Criteria::INNER_JOIN );
		$criteria->addAscendingOrderByColumn( ProductOptionPeer::ORDER_SEQ );
		$criteria->addAscendingOrderByColumn( ProductOptionPeer::ID );
		$criteria->setDistinct( ProductOptionPeer::ID );
		return ProductOptionPeer::doSelect($criteria);
	}
	
	public static function getOptionsForSelect($optionType, $productId, $defaultValue=null, $returnArray=false){
		
		$productOptionObjList = self::getList($optionType, $productId);

		$optionList = array();
		foreach($productOptionObjList as $productOptionObj){
			
			if( is_null($defaultValue) && $productOptionObj->getIsDefault() )
				$defaultValue = $productOptionObj->getIsDefault();
			
			$optionList[$productOptionObj->getId()] = $productOptionObj->getDescription();
		}
			
		if( $returnArray )
			return $optionList;

		return options_for_select($optionList, $defaultValue);
	}
}
