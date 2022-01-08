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
	
	public function quickSave($request){
		
		$productCategoryId = $request->getParameter('productCategoryId');
		$optionName        = $request->getParameter('optionName');
		$description       = $request->getParameter('description');
		$optionType        = $request->getParameter('optionType');
		$isDefault         = $request->getParameter('isDefault');
		$tagName           = $request->getParameter('tagName');
		$orderSeq          = $request->getParameter('orderSeq');
		
		$this->setProductCategoryId( $productCategoryId );
		$this->setOptionName( $optionName );
		$this->setDescription( $description );
		$this->setOptionType( $optionType );
		$this->setIsDefault( ($isDefault?true:false) );
		$this->setTagName( $tagName );
		$this->setOrderSeq( $orderSeq );
		$this->setVisible( true );
		$this->setEnabled( true );
		$this->save();
		
		$productOptionId = $this->getId();
		
		if( $isDefault )
			Util::executeQuery("UPDATE product_option SET is_default = FALSE WHERE product_category_id = $productCategoryId AND option_type = '$optionType' AND id <> $productOptionId");
	}
	
	public static function getList(Criteria $criteria=null, $optionType=null, $productId=null, $productCategoryId=null){
		
		$criteria = new Criteria();
		if( $optionType )
			$criteria->add( ProductOptionPeer::OPTION_TYPE, $optionType );

		if( $productCategoryId )
			$criteria->add( ProductOptionPeer::PRODUCT_CATEGORY_ID, $productCategoryId );
		
		if( $productId ){
			
			$criteria->addJoin( ProductOptionPeer::ID, "product_item.PRODUCT_OPTION_ID_$optionType", Criteria::INNER_JOIN );
			$criteria->add( ProductItemPeer::VISIBLE, true );
			$criteria->add( ProductItemPeer::ENABLED, true );
			$criteria->add( ProductItemPeer::DELETED, false);
			$criteria->add( ProductItemPeer::PRODUCT_ID, $productId );
		}
			
		$criteria->addAscendingOrderByColumn( ProductOptionPeer::ORDER_SEQ );
		$criteria->addAscendingOrderByColumn( ProductOptionPeer::ID );
		$criteria->setDistinct( ProductOptionPeer::ID );
		return ProductOptionPeer::doSelect($criteria);
	}
	
	public static function getOptionsForSelect($optionType, $productId, $defaultValue=null, $returnArray=false, $column='description', $productCategoryId=null){
		
		$productOptionObjList = self::getList(null, $optionType, $productId, $productCategoryId);

		$function = 'get'.ucfirst($column);

		$optionList = array();
		foreach($productOptionObjList as $productOptionObj){
			
			if( is_null($defaultValue) && $productOptionObj->getIsDefault() )
				$defaultValue = $productOptionObj->getIsDefault();
			
			$optionList[$productOptionObj->getId()] = $productOptionObj->$function();
		}
			
		if( $returnArray )
			return $optionList;

		return options_for_select($optionList, $defaultValue);
	}
	
	public function getOptionTypeList(){
		
		return array('size'=>'Tamanho',
					 'color'=>'Cor');
	}
	
	
	public function getOptionType($description=false){
		
		$optionType = parent::getOptionType();
		
		if( $description ){
			
			$optionTypeList = $this->getOptionTypeList();
			$optionType     = $optionTypeList[$optionType];
		}
		
		return $optionType;
	}
}
