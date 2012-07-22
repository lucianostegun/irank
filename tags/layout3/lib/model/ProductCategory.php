<?php

/**
 * Subclasse de representação de objetos da tabela 'product_category'.
 *
 * 
 *
 * @package lib.model
 */ 
class ProductCategory extends BaseProductCategory
{
	
	public function toString(){
		
		return $this->getCategoryName();
	}
	
	public function quickSave($request){
		
		$categoryName = $request->getParameter('categoryName');
		$shortName    = $request->getParameter('shortName');
		
		$this->setCategoryName( $categoryName );
		$this->setShortName( $shortName );
		$this->setVisible( true );
		$this->setEnabled( true );
		$this->save();
	}
	
	public static function getList(Criteria $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( ProductCategoryPeer::ENABLED, true );
		$criteria->add( ProductCategoryPeer::VISIBLE, true );
		$criteria->add( ProductCategoryPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( ProductCategoryPeer::CREATED_AT );
		
		return ProductCategoryPeer::doSelect( $criteria );
	}

	public static function getOptionsForSelect($defaultValue=false, $returnArray=false){
		
		$productObjList = self::getList();

		$optionList = array();
		$optionList[''] = 'Selecione';
		foreach( $productObjList as $productObj )			
			$optionList[$productObj->getId()] = $productObj->getCategoryName();
		
		if( $returnArray )
			return $optionList;

		return options_for_select($optionList, $defaultValue);
	}
	
	public function getProducts(){
		
		return Util::executeOne('SELECT COUNT(1) FROM product WHERE visible AND enabled AND NOT deleted AND product_category_id = '.$this->getId());
	}
}
