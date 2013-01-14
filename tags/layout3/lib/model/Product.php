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

	public function toString($useShortName=false){
		
		$productCategoryObj = $this->getProductCategory();
		$categoryName       = $productCategoryObj->getCategoryName();
		$categoryShortName  = $productCategoryObj->getShortName();
		$tagName            = $productCategoryObj->getTagName();
		$productName        = ($useShortName?$this->getShortName():$this->getProductName());
		
		$productName = str_replace($categoryShortName.' ', '', $productName);
		
		return "$categoryShortName $productName";
	}
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
	}
	
	public function quickSave($request){
		
		$productCode       = $request->getParameter('productCode');
		$productName       = $request->getParameter('productName');
		$shortName         = $request->getParameter('shortName');
		$productCategoryId = $request->getParameter('productCategoryId');
		$defaultPrice      = $request->getParameter('defaultPrice');
		$defaultWeight     = $request->getParameter('defaultWeight');
		$isNew             = $request->getParameter('isNew');
		$enabled           = $request->getParameter('enabled');
		$visible           = $request->getParameter('visible');
		$description       = $request->getParameter('description');
		
		$this->setProductCode( $productCode );
		$this->setProductName( $productName );
		$this->setShortName( $shortName );
		$this->setProductCategoryId( $productCategoryId );
		$this->setDefaultPrice( Util::formatFloat($defaultPrice) );
		$this->setDefaultWeight( Util::formatFloat($defaultWeight) );
		$this->setIsNew( ($isNew?true:false) );
		$this->setEnabled( ($enabled?true:false) );
		$this->setVisible( ($visible?true:false) );
		$this->setDescription( $description );
		$this->save();
	}
	
	public static function getList(Criteria $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( ProductPeer::ENABLED, true );
		$criteria->add( ProductPeer::VISIBLE, true );
		$criteria->add( ProductPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( ProductPeer::CREATED_AT );
		
		return ProductPeer::doSelect( $criteria );
	}
	
	public function getImage($imageIndex, $path=null){
		
		$function = "getImage$imageIndex";
		$fileName = $this->$function();
		
		if( !$fileName )
			return null;
		
		if( !is_null($path) ){
			
			$path     = ($path===true?'':'/'.$path);
			$fileName = "store/product$path/$fileName";
		}
		
		return $fileName;
	}
	
	public function getImageCover($path=null, $imageNumber=1){
		
		return $this->getImage($imageNumber, $path);
	}
	
	public static function getIdByCode($productCode){
		
		return Util::executeOne("SELECT id FROM product WHERE product_code = '$productCode'");
	}
	
	public function getImages(){
		
		$images = 0;
		
		if( $this->getImage1() ) $images++;
		if( $this->getImage2() ) $images++;
		if( $this->getImage3() ) $images++;
		if( $this->getImage4() ) $images++;
		if( $this->getImage5() ) $images++;
		
		return $images;
	}
	
	public function updateStock($con=null){
		
		$stock = Util::executeOne('SELECT SUM(stock) FROM product_item WHERE enabled AND visible AND NOT deleted AND product_id = '.$this->getId());
		$this->setStock($stock);
		$this->save($con);
	}
	
	public function getSizeList(){
		
		$sizeList = Util::executeOne('SELECT get_product_sizes('.$this->getId().')', 'string');
		return str_replace(',', ' / ', $sizeList);
		return null;
	}
	
	public static function getPageTitle(){
		
		$productCode = MyTools::getRequestParameter('productCode');
		
		$sql = "SELECT
					product_category.SHORT_NAME||' '||product.PRODUCT_NAME
				FROM
					product
					INNER JOIN product_category ON product.PRODUCT_CATEGORY_ID=product_category.ID
				WHERE
					product_code = '$productCode'";
		
		return Util::executeOne($sql, 'string');
	}
	
	public function getDescription($convertTags=false){
		
		$description = parent::getDescription();
		
		if( $convertTags )
			$description = str_replace(chr(10), '<br/>', $description);
		
		return $description;
	}
	
	public function deleteImage($imageIndex){
		
		$imagePath        = $this->getImage($imageIndex, '');
		$imagePathPreview = $this->getImage($imageIndex, 'preview');
		$imagePathFull    = $this->getImage($imageIndex, 'full');
		$imagePathThumb   = $this->getImage($imageIndex, 'thumb');
		
		unlink(Util::getFilePath('images/'.$imagePath));
		unlink(Util::getFilePath('images/'.$imagePathPreview));
		unlink(Util::getFilePath('images/'.$imagePathFull));
		unlink(Util::getFilePath('images/'.$imagePathThumb));
	}
}
