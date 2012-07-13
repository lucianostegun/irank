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
  	
  	$productCode = $request->getParameter('productCode');
  	$quantity    = $request->getParameter('quantity', 1);
  	$color       = $request->getParameter('color', 'white');
  	$size        = $request->getParameter('size', 'M');
  	
	$this->addItemToCart($productCode, $quantity, $color, $size);
  	
  	return $this->redirect('store/cart');
  }

  public function executeRemoveItem($request){
  	
  	$productItemId = $request->getParameter('productItemId');
  	list($productCode, $size, $color) = explode(':', $productItemId);
  	$this->removeItemFromCart($productCode, $color, $size);
  	
  	$cartSessionObj = base64_decode($this->cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	
  	echo Util::parseInfo($cartSessionObj);
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
  	$cartSessionObj->id            = $sessionId;
  	$cartSessionObj->products      = 0;
  	$cartSessionObj->itens         = 0;
  	$cartSessionObj->totalValue    = 0;
  	$cartSessionObj->zipcode       = null;
  	$cartSessionObj->shippingValue = 0;
  	$cartSessionObj->productList   = array();
  	$cartSessionObj->createdAt     = time();
  	
  	return $this->getUpdateSession($cartSessionObj);
  }

  private function getUpdateSession($cartSessionObj){
  	
  	$cartSessionObj = serialize($cartSessionObj);
  	$cartSessionObj = base64_encode($cartSessionObj);
  	
  	$this->getUser()->setAttribute('iRankStoreCartSession', $cartSessionObj);
  	
  	$this->cartSession = $cartSessionObj;
  	return $this->cartSession;
  }
  
  private function addItemToCart($productCode, $quantity, $color, $size){

	$cartSessionObj = base64_decode($this->cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	
  	$productObj   = ProductPeer::retrieveByCode($productCode);
  	
  	if( !is_object($productObj) || !$quantity )
  		return;
  	
	$defaultPrice = $productObj->getDefaultPrice();
  	
  	if( !isset($cartSessionObj->productList[$productCode]) )
	 	$product = new stdClass();
  	else
  		$product = $cartSessionObj->productList[$productCode];

	if( !isset($product->size[$size]['color'][$color]) ){
		
		$idTemp = "$productCode:$size:$color";
		$product->size[$size]['color'][$color] = array('id'=>$idTemp, 'quantity'=>0, 'price'=>$defaultPrice);
		
	 	$cartSessionObj->products   += 1; // Produtos únicos
	 	$cartSessionObj->itens      += $quantity;
	 	$cartSessionObj->totalValue += ($defaultPrice*$quantity);
	}
	
	$product->size[$size]['color'][$color]['quantity'] = $quantity;
  	
  	$cartSessionObj->productList[$productCode] = $product;
  	$this->getUpdateSession($cartSessionObj);
  	
//  	echo '<pre>';
//  	print_r($cartSessionObj);
//  	exit;
  }

  private function removeItemFromCart($productCode, $color, $size){

	$cartSessionObj = base64_decode($this->cartSession);
  	$cartSessionObj = unserialize($cartSessionObj);
  	
  	$productList = $cartSessionObj->productList;
  	
  	if( isset($productList[$productCode]->size[$size]['color'][$color]) ){
		
		$productItem = $productList[$productCode]->size[$size]['color'][$color];
		
		$price       = $productItem['price'];
		$quantity    = $productItem['quantity'];
		
		$cartSessionObj->products   -= 1; // Produtos únicos
		$cartSessionObj->itens      -= $quantity;
	 	$cartSessionObj->totalValue -= ($price*$quantity);
	 	
	 	unset($productList[$productCode]->size[$size]['color'][$color]);
	}
  	
  	$cartSessionObj->productList = $productList;
  	$this->getUpdateSession($cartSessionObj);
  }
}
