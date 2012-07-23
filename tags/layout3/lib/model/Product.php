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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('product', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('product', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('product', $this->getPrimaryKey());
	}
	
	public function quickSave($request){
		
		$productCode       = $request->getParameter('productCode');
		$productName       = $request->getParameter('productName');
		$shortName         = $request->getParameter('shortName');
		$productCategoryId = $request->getParameter('productCategoryId');
		$defaultPrice      = $request->getParameter('defaultPrice');
		$defaultWeight     = $request->getParameter('defaultWeight');
		$isNew             = $request->getParameter('isNew');
		$description       = $request->getParameter('description');
		
		$this->setProductCode( $productCode );
		$this->setProductName( $productName );
		$this->setShortName( $shortName );
		$this->setProductCategoryId( $productCategoryId );
		$this->setDefaultPrice( Util::formatFloat($defaultPrice) );
		$this->setDefaultWeight( Util::formatFloat($defaultWeight) );
		$this->setIsNew( ($isNew?true:false) );
		$this->setDescription( $description );
		$this->setVisible( true );
		$this->setEnabled( true );
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
		
		if( !is_null($path) ){
			
			$path     = ($path===true?'':'/'.$path);
			$fileName = "store/product$path/$fileName";
		}
		
		return $fileName;
	}
	
	public function getImageCover($path=null){
		
		return $this->getImage(1, $path);
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
	
	public function updateStock(){
		
		$stock = Util::executeOne('SELECT SUM(stock) FROM product_item WHERE enabled AND visible AND NOT deleted AND product_id = '.$this->getId());
		$this->setStock($stock);
		$this->save();
	}
}
