<?php

/**
 * Subclasse de representação de objetos da tabela 'product'.
 *
 * 
 *
 * @package lib.model
 */ 
class Product extends BaseProduct
{
	
	public function getImageCover($path=null){
		
		$fileName = $this->getImage1();
		
		if( !is_null($path) ){
			
			$path     = ($path===true?'':'/'.$path);
			$fileName = "store/product$path/$fileName";
		}
		
		return $fileName;
	}
	
	public static function getIdByCode($productCode){
		
		return Util::executeOne("SELECT id FROM product WHERE product_code = '$productCode'");
	}
}
