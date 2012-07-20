<?php

/**
 * Subclasse de representação de objetos da tabela 'product_item'.
 *
 * 
 *
 * @package lib.model
 */ 
class ProductItem extends BaseProductItem
{
	
	public function getImageCover($path=null){
		
		$fileName = $this->getImage1();
		
		if( !is_null($path) ){
			
			$path     = ($path===true?'':'/'.$path);
			$fileName = "store/product$path/$fileName";
		}
		
		return $fileName;
	}
	
	public static function getWeightById($productItemId){
		
		return Util::executeOne("SELECT getProductItemWeight($productItemId)", 'float');
	}
	
	public function getProductOptionColor(){
		
		return $this->getProductOptionRelatedByProductOptionIdColor();
	}
	
	public function getProductOptionSize(){
		
		return $this->getProductOptionRelatedByProductOptionIdSize();
	}
}
