<?php

/**
 * store actions.
 *
 * @package    iRank
 * @subpackage frontend
 * @author     Luciano Stegun
 */
class storeActions extends sfActions
{

  public function preExecute(){
    
    $this->cartSession = $this->getUser()->getAttribute('iRankStoreCartSession');
    
    if( !$this->cartSession )
    	$this->cartSession = $this->getNewSession();
  }
  
  public function executeIndex($request){
  	
  }
  
  public function executeDetails($request){
  	
  	$productCode      = $request->getParameter('productCode');
  	$this->productObj = ProductPeer::retrieveByCode($productCode);
  }

  public function executeCart($request){
  	
  	$cartSessionObj = base64_decode($this->cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	
  	$this->cartSessionObj = $cartSessionObj;
  }

  public function executeAddItem($request){
  	
  	$productCode          = $request->getParameter('productCode');
  	$quantity             = $request->getParameter('quantity', 1);
  	$productOptionIdColor = $request->getParameter('productOptionIdColor');
  	$productOptionIdSize  = $request->getParameter('productOptionIdSize');
  	
	$this->addItemToCart($productCode, $quantity, $productOptionIdColor, $productOptionIdSize);
  	
  	return $this->redirect('store/cart');
  }

  public function executeRemoveItem($request){
  	
  	$productItemId  = $request->getParameter('productItemId');
  	$cartSessionObj = $this->removeItemFromCart($productItemId);
  	
  	echo Util::parseInfo($cartSessionObj);
  	exit;
  }

  public function executeUpdateItemQuantity($request){
  	
  	$cartSessionObj = $this->getCartSession();
  	$productItemId  = $request->getParameter('productItemId');
  	$quantity       = (int)$request->getParameter('quantity');
  	
  	if( $quantity > 0 && $quantity <= 99 ){
  		
	  	$cartSessionObj->productItemList[$productItemId]->quantity = $quantity;
	  	$this->getUpdateSession($cartSessionObj);
  	}
  	
  	echo Util::parseInfo($cartSessionObj);
  	exit;
  }

  public function executeUpdateCartQuantity($request){
  	
  	$cartSessionObj = $this->getCartSession();
  	
  	foreach($cartSessionObj->productItemList as $productItemId=>$productItem){
  		
	  	$quantity = (int)$request->getParameter('quantity-'.$productItemId);
	  	
	  	if( $quantity <= 0 || $quantity > 99 )
	  		continue;
	  	
  		$productItem->quantity = $quantity;
  	}
  	
  	$this->getUpdateSession($cartSessionObj);
  	echo Util::parseInfo($cartSessionObj);
  	exit;
  }

  public function executeCalculateShipping($request){
  	
  	$cartSessionObj = $this->getCartSession();
  	$totalWeight    = 0;
  	
  	foreach($cartSessionObj->productItemList as $productItemId=>$productItem){
  		
  		$totalWeight += ProductItem::getWeightById($productItemId);
  	}
  	
  	echo $totalWeight;
//  	echo '<Pre>';
//  	print_r($cartSessionObj);
//  	$this->getUpdateSession($cartSessionObj);
//  	echo Util::parseInfo($cartSessionObj);
  	exit;
  }

  public function executePayment($request){
  	
  }

  public function executeOrder($request){
  	
  }
  
  private function getNewSession(){
  	
  	$ipAddress = $_SERVER['REMOTE_ADDR'];
  	$sessionId = $ipAddress.'-'.microtime();
  	
  	$cartSessionObj = new stdClass();
  	$cartSessionObj->id              = $sessionId;
  	$cartSessionObj->products        = 0;
  	$cartSessionObj->itens           = 0;
  	$cartSessionObj->totalValue      = 0;
  	$cartSessionObj->zipcode         = null;
  	$cartSessionObj->shippingValue   = 0;
  	$cartSessionObj->productItemList = array();
  	$cartSessionObj->createdAt       = time();
  	
  	return $this->getUpdateSession($cartSessionObj);
  }

  private function getCartSession(){
  	
	$cartSessionObj = $this->getUser()->getAttribute('iRankStoreCartSession');
	$cartSessionObj = base64_decode($cartSessionObj);
	$cartSessionObj = unserialize($cartSessionObj);
	
	return $cartSessionObj;
  }
  
  private function getUpdateSession($cartSessionObj){
  	
  	$products        = 0;
  	$productItens    = 0;
  	$totalOrderValue = 0;
  	
  	foreach($cartSessionObj->productItemList as $productItem){
		  	
  		$price    = $productItem->price;
  		$quantity = $productItem->quantity;
  		
  		$products     += 1;
  		$productItens += $quantity;
		
		$totalValue       = $price*$quantity;
		$totalOrderValue += $totalValue;
		
		$productItem->totalValue = $totalValue;
  	}
  	
  	$cartSessionObj->products   = $products; // Produtos únicos
 	$cartSessionObj->itens      = $productItens;
 	$cartSessionObj->totalValue = $totalOrderValue;
	 	
  	$cartSessionObj = serialize($cartSessionObj);
  	$cartSessionObj = base64_encode($cartSessionObj);
  	
  	$this->getUser()->setAttribute('iRankStoreCartSession', $cartSessionObj);
  	
  	$this->cartSession = $cartSessionObj;
  	return $this->cartSession;
  }
  
  private function addItemToCart($productCode, $quantity, $productOptionIdColor, $productOptionIdSize){

	$cartSessionObj = base64_decode($this->cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	$productId      = Product::getIdByCode($productCode);
  	
  	$productItemObj = ProductItemPeer::retrieveByOptions($productId, $productOptionIdColor, $productOptionIdSize);
  	
  	$quantity = (int)$quantity;
  	
  	if( !is_object($productItemObj) || $quantity <= 0 || $quantity > 99 )
  		return;
  	
  	$productItemId = $productItemObj->getId();
	$price         = $productItemObj->getPrice();
  	
  	if( !isset($cartSessionObj->productItemList[$productItemId]) ){
  		
	 	$productItem = new stdClass();
	 	$productItem->code       = $productCode;
	 	$productItem->price      = $price;
	 	$productItem->quantity   = 0;
	 	$productItem->totalValue = $totalValue = ($price*$quantity);
	 	$productItem->color      = ProductOptionPeer::retrieveByPK($productOptionIdColor)->getOptionName();
	 	$productItem->size       = ProductOptionPeer::retrieveByPK($productOptionIdSize)->getOptionName();
  	}else{
  		
  		$productItem = $cartSessionObj->productItemList[$productItemId];
  	}

 	$productItem->quantity += $quantity;
  	
  	$cartSessionObj->productItemList[$productItemId] = $productItem;
  	$this->getUpdateSession($cartSessionObj);
  }

  private function removeItemFromCart($productItemId){

	$cartSessionObj = base64_decode($this->cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	
  	$productItemList = $cartSessionObj->productItemList;
  	
  	if( isset($productItemList[$productItemId]) ){
		
		$productItem = $productItemList[$productItemId];
		
		$price       = $productItem->price;
		$quantity    = $productItem->quantity;
		
		$cartSessionObj->products   -= 1; // Produtos únicos
		$cartSessionObj->itens      -= $quantity;
	 	$cartSessionObj->totalValue -= ($price*$quantity);
	 	
	 	if( $cartSessionObj->products < 0 || $cartSessionObj->itens < 0 || $cartSessionObj->totalValue < 0 ){
	 		
			$cartSessionObj->products   = 0; // Produtos únicos
			$cartSessionObj->itens      = 0;
		 	$cartSessionObj->totalValue = 0;
	 	}
	 	
	 	unset($productItemList[$productItemId]);
	}
  	
  	$cartSessionObj->productItemList = $productItemList;
  	$this->getUpdateSession($cartSessionObj);
  	
  	return $cartSessionObj;
  }
}
