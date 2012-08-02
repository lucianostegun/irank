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
	
	private $reloadTable = false;
	
	public function getIsNew(){
		
		return ($this->isNew() || (!$this->getVisible() && !$this->getEnabled() && !$this->getDeleted()));
	}
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			parent::save();
			
       		Log::quickLog('product_item', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('product_item', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setVisible(false);
		$this->setDeleted(true);
		$this->save();
		
		$this->getProduct()->updateStock();
		
		Log::quickLogDelete('product_item', $this->getPrimaryKey());
	}
	
	public function quickSave($request){
		
		$productId            = $request->getParameter('productId');
		$productOptionIdColor = $request->getParameter('productOptionIdColor');
		$productOptionIdSize  = $request->getParameter('productOptionIdSize');
		$productOptionIdList  = $request->getParameter('productOptionIdList');
		$price                = $request->getParameter('price');
		$weight               = $request->getParameter('weight');
		$stock                = $request->getParameter('stock');
		$lockedStock          = $request->getParameter('lockedStock');

		$this->reloadTable = $this->getIsNew();
		
		$addStockLog = !$this->getLockedStock() && $lockedStock;
		
		$con = Propel::getConnection();
		$con->begin();
		
		$this->setProductId( $productId );
		$this->setProductOptionIdColor( $productOptionIdColor );
		$this->setProductOptionIdSize( $productOptionIdSize );
		$this->setPrice( Util::formatFloat($price) );
		$this->setWeight( Util::formatFloat($weight) );
		$this->setStock( $stock );
		$this->setLockedStock( ($lockedStock?true:false) );
		$this->setVisible( true );
		$this->setEnabled( true );
		$this->save($con);
		
		if( !empty($productOptionIdList) ){
			
			foreach($productOptionIdList as $productOptionId){
				
				list($productOptionIdColorTmp, $productOptionIdSizeTmp) = explode('-', $productOptionId);
				if( $productOptionIdColorTmp==$productOptionIdColor && $productOptionIdSizeTmp==$productOptionIdSize )
					continue;
				
				$productItemObj = ProductItemPeer::retrieveByOptions($productId, $productOptionIdColorTmp, $productOptionIdSizeTmp);
				
				if( is_object($productItemObj) && $productItemObj->getVisible() && !$productItemObj->getDeleted() )
					continue;
				
				$productItemObj = new ProductItem();
				$productItemObj->setProductId( $productId );
				$productItemObj->setProductOptionIdColor( $productOptionIdColorTmp );
				$productItemObj->setProductOptionIdSize( $productOptionIdSizeTmp );
				$productItemObj->setPrice( Util::formatFloat($price) );
				$productItemObj->setWeight( Util::formatFloat($weight) );
				$productItemObj->setStock( $stock );
				$productItemObj->setVisible( true );
				$productItemObj->setEnabled( false );
				
				if( $productOptionIdColorTmp==$productOptionIdColor ){
					
					$productItemObj->setImage1( $this->getImage1() );
					$productItemObj->setImage2( $this->getImage2() );
					$productItemObj->setImage3( $this->getImage3() );
					$productItemObj->setImage4( $this->getImage4() );
					$productItemObj->setImage5( $this->getImage5() );
					$productItemObj->setEnabled( true );
				}
				
				$productItemObj->save($con);
			}
		}
		
		if( $addStockLog )
			$this->addStockLog($this->getStock(), 'Estoque inicial', true);
		else
			$this->getProduct()->updateStock($con);
		
		$con->commit();
	}
	
	public static function getList(Criteria $criteria=null){
		
		if( is_null($criteria) )
			$criteria = new Criteria();
			
		$criteria->add( ProductItemPeer::VISIBLE, true );
		$criteria->add( ProductItemPeer::DELETED, false );
		$criteria->addAscendingOrderByColumn( ProductItemPeer::CREATED_AT );
		
		return ProductItemPeer::doSelect( $criteria );
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
	
	public function getImages(){
		
		$images = 0;
		
		if( $this->getImage1() ) $images++;
		if( $this->getImage2() ) $images++;
		if( $this->getImage3() ) $images++;
		if( $this->getImage4() ) $images++;
		if( $this->getImage5() ) $images++;
		
		return $images;
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
	
	public function decraseStock($decraseAmount, $con){
		
		$this->setStock($this->getStock()-$decraseAmount);
		$this->save($con);
		
		$this->getProduct()->updateStock($con);
	}
	
	public function incraseStock($incraseAmount, $con){
		
		$this->setStock($this->getStock()+$incraseAmount);
		$this->save($con);
		
		$this->getProduct()->updateStock($con);
	}
	
	public function addStockLog($stock, $comments=null, $first=false){
		
		$productItemStockLogObj = new ProductItemStockLog();
		$productItemStockLogObj->setProductItemId($this->getId());
		$productItemStockLogObj->setStock($stock);
		$productItemStockLogObj->setComments($comments);
		$productItemStockLogObj->save();
		
		$currentStock = ($first?0:$this->getStock());
		
		$this->setStock($currentStock+$stock);
		$this->save();
		
		$this->getProduct()->updateStock();
	}
	
	public function getInfo(){
		
		$infoList = array();
		
		$infoList['id']                   = $this->getId();
		$infoList['productId']            = $this->getProductId();
		$infoList['productOptionIdColor'] = $this->getProductOptionIdColor();
		$infoList['productOptionIdSize']  = $this->getProductOptionIdSize();
		$infoList['price']                = $this->getPrice();
		$infoList['weight']               = $this->getWeight();
		$infoList['image1']               = $this->getImage1();
		$infoList['image2']               = $this->getImage2();
		$infoList['image3']               = $this->getImage3();
		$infoList['image4']               = $this->getImage4();
		$infoList['image5']               = $this->getImage5();
		$infoList['stock']                = $this->getStock();
		$infoList['lockedStock']          = $this->getLockedStock();
		$infoList['productStock']         = $this->getProduct()->getStock();
		$infoList['reloadTable']          = $this->reloadTable;
		
		return $infoList;
	}
}
