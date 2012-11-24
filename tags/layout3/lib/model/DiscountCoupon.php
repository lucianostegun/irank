<?php

/**
 * Subclasse de representação de objetos da tabela 'discount_coupon'.
 *
 * 
 *
 * @package lib.model
 */ 
class DiscountCoupon extends BaseDiscountCoupon
{
	
	public function quickSave($request){
		
		$couponCode                  = $request->getParameter('couponCode');
		$isActive                    = $request->getParameter('isActive');
		$shippingPercent             = $request->getParameter('shippingPercent');
		$shippingValue               = $request->getParameter('shippingValue');
		$orderPercent                = $request->getParameter('orderPercent');
		$orderValue                  = $request->getParameter('orderValue');
		$totalPercent                = $request->getParameter('totalPercent');
		$totalValue                  = $request->getParameter('totalValue');
		$cheaperItemPercent          = $request->getParameter('cheaperItemPercent');
		$cheaperItemValue            = $request->getParameter('cheaperItemValue');
		$cheaperProductPercent       = $request->getParameter('cheaperProductPercent');
		$cheaperProductValue         = $request->getParameter('cheaperProductValue');
		$mostExpensiveItemPercent    = $request->getParameter('mostExpensiveItemPercent');
		$mostExpensiveItemValue      = $request->getParameter('mostExpensiveItemValue');
		$mostExpensiveProductPercent = $request->getParameter('mostExpensiveProductPercent');
		$mostExpensiveProductValue   = $request->getParameter('mostExpensiveProductValue');
		
		$discountRuleObj = new stdClass();
		
		if( $shippingPercent > 0 )
			$discountRuleObj->shippingPercent = Util::formatFloat($shippingPercent);

		if( $shippingValue > 0 )
			$discountRuleObj->shippingValue = Util::formatFloat($shippingValue);

		if( $orderPercent > 0 )
			$discountRuleObj->orderPercent = Util::formatFloat($orderPercent);

		if( $orderValue > 0 )
			$discountRuleObj->orderValue = Util::formatFloat($orderValue);

		if( $totalPercent > 0 )
			$discountRuleObj->totalPercent = Util::formatFloat($totalPercent);

		if( $totalValue > 0 )
			$discountRuleObj->totalValue = Util::formatFloat($totalValue);

		if( $cheaperItemPercent > 0 )
			$discountRuleObj->cheaperItemPercent = Util::formatFloat($cheaperItemPercent);

		if( $cheaperItemValue > 0 )
			$discountRuleObj->cheaperItemValue = Util::formatFloat($cheaperItemValue);

		if( $cheaperProductPercent > 0 )
			$discountRuleObj->cheaperProductPercent = Util::formatFloat($cheaperProductPercent);

		if( $cheaperProductValue > 0 )
			$discountRuleObj->cheaperProductValue = Util::formatFloat($cheaperProductValue);

		if( $mostExpensiveItemPercent > 0 )
			$discountRuleObj->mostExpensiveItemPercent = Util::formatFloat($mostExpensiveItemPercent);

		if( $mostExpensiveItemValue > 0 )
			$discountRuleObj->mostExpensiveItemValue = Util::formatFloat($mostExpensiveItemValue);

		if( $mostExpensiveProductPercent > 0 )
			$discountRuleObj->mostExpensiveProductPercent = Util::formatFloat($mostExpensiveProductPercent);

		if( $mostExpensiveProductValue > 0 )
			$discountRuleObj->mostExpensiveProductValue = Util::formatFloat($mostExpensiveProductValue);

		$this->setCouponCode( $couponCode );
		$this->setDiscountRule( serialize($discountRuleObj) );
		$this->setIsActive( ($isActive?true:false) );
		$this->setVisible( true );
		$this->setEnabled( true );
		$this->save();
	}
	
	public static function getList(Criteria $criteria=null){
		
		if( !$criteria )
			$criteria = new Criteria();
			
		$criteria->add( DiscountCouponPeer::ENABLED, true );
		$criteria->add( DiscountCouponPeer::VISIBLE, true );
		$criteria->add( DiscountCouponPeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( DiscountCouponPeer::ID );
		
		return DiscountCouponPeer::doSelect($criteria);
	}
	
	public function getDiscount($cartSessionObj){
		
		$discountRuleObj = unserialize($this->getDiscountRule());
		
		$discountValueShipping             = 0;
		$discountValueOrder                = 0;
		$discountValueTotal                = 0;
		$discountValueCheaperItem          = 0;
	  	$discountValueCheaperProduct       = 0;
		$discountValueMostExpensiveItem    = 0;
	  	$discountValueMostExpensiveProduct = 0;
		
		// DESCONTO DE ENVIO
		if( property_exists($discountRuleObj, 'shippingPercent') )
	  		$discountValueShipping += $cartSessionObj->shippingValue*$discountRuleObj->shippingPercent/100;
	
	  	if( property_exists($discountRuleObj, 'shippingValue') )
	  		$discountValueShipping += $discountRuleObj->shippingValue;
	  	/**
	  	 * Se o valor do desconto do envio for maior que o valor do envio
	  	 * o valor do desconto passa a ser o valor do envio
	  	 */
	  	if( $discountValueShipping > $cartSessionObj->shippingValue )
	  		$discountValueShipping = $cartSessionObj->shippingValue;
	  	

		// DESCONTO NO VALOR DO PEDIDO (SEM O ENVIO)
	  	if( property_exists($discountRuleObj, 'orderPercent') )
	  		$discountValueOrder += $cartSessionObj->orderValue*$discountRuleObj->orderPercent/100;
	
	  	if( property_exists($discountRuleObj, 'orderValue') )
	  		$discountValueOrder += $discountRuleObj->orderValue;
		
		if( $discountValueOrder > $cartSessionObj->orderValue )
	  		$discountValueOrder = $cartSessionObj->orderValue;
	  		
	  		
	  		
	  	// DESCONTO NO VALOR TOTAL DO PEDIDO
	  	if( property_exists($discountRuleObj, 'totalPercent') ){
	  		
	  		// ATENÇÃO! Essa variável não pode mudar para $cartSessionObj->totalValue senão bagunça o desconto por valor total
	  		$totalValue = $cartSessionObj->orderValue + $cartSessionObj->shippingValue;
	  		
	  		$discountValueTotal += $totalValue*$discountRuleObj->totalPercent/100;
	  	}
	
	  	if( property_exists($discountRuleObj, 'totalValue') )
	  		$discountValueTotal += $discountRuleObj->totalValue;
		
		if( $discountValueTotal > $cartSessionObj->totalValue )
	  		$discountValueTotal = $cartSessionObj->totalValue;
	  		
	  		
	  		
	  	// DESCONTO NO ITEM MAIS BARATO
	  	if( property_exists($discountRuleObj, 'cheaperItemPercent') || property_exists($discountRuleObj, 'cheaperItemValue') ){
	  		
		  	$cheaperItemValue = null;
		  	foreach($cartSessionObj->productItemList as $productItem)
		  		if( is_null($cheaperItemValue) || $productItem->price < $cheaperItemValue )
		  			$cheaperItemValue = $productItem->price;
		  	
		  	if( property_exists($discountRuleObj, 'cheaperItemPercent') )
		  		$discountValueCheaperItem += $cheaperItemValue*$discountRuleObj->cheaperItemPercent/100;
		
		  	if( property_exists($discountRuleObj, 'cheaperItemValue') )
		  		$discountValueCheaperItem += $discountRuleObj->cheaperItemValue;
		  		
			if( $discountValueCheaperItem > $cheaperItemValue )
	  			$discountValueCheaperItem = $cheaperItemValue;
	  	}


	  	
	  	// DESCONTO NO PRODUTO MAIS BARATO
	  	if( property_exists($discountRuleObj, 'cheaperProductPercent') || property_exists($discountRuleObj, 'cheaperProductValue') ){
	  		
		  	$cheaperItemValue    = null;
		  	$cheaperItemQuantity = 0;
		  	foreach($cartSessionObj->productItemList as $productItem){
		  		
		  		if( is_null($cheaperItemValue) || $productItem->price < $cheaperItemValue ){
		  			
		  			$cheaperItemValue    = $productItem->price;
		  			$cheaperItemQuantity = $productItem->quantity;
		  		}
		  	}
		  	
		  	if( property_exists($discountRuleObj, 'cheaperProductPercent') )
		  		$discountValueCheaperProduct += ($cheaperItemValue*$cheaperItemQuantity)*$discountRuleObj->cheaperProductPercent/100;
		
		  	if( property_exists($discountRuleObj, 'cheaperProductValue') )
		  		$discountValueCheaperProduct += $discountRuleObj->cheaperProductValue;
		  		
			if( $discountValueCheaperProduct > ($cheaperItemValue*$cheaperItemQuantity) )
	  			$discountValueCheaperProduct = ($cheaperItemValue*$cheaperItemQuantity);
	  	}
	  		
	  		
	  		
	  	// DESCONTO NO ITEM MAIS CARO
	  	if( property_exists($discountRuleObj, 'mostExpensiveItemPercent') || property_exists($discountRuleObj, 'mostExpensiveItemValue') ){
	  		
		  	$mostExpensiveItemValue = null;
		  	foreach($cartSessionObj->productItemList as $productItem)
		  		if( is_null($mostExpensiveItemValue) || $productItem->price > $mostExpensiveItemValue )
		  			$mostExpensiveItemValue = $productItem->price;
		  	
		  	if( property_exists($discountRuleObj, 'mostExpensiveItemPercent') )
		  		$discountValueMostExpensiveItem += $mostExpensiveItemValue*$discountRuleObj->mostExpensiveItemPercent/100;
		
		  	if( property_exists($discountRuleObj, 'mostExpensiveItemValue') )
		  		$discountValueMostExpensiveItem += $discountRuleObj->mostExpensiveItemValue;
		  		
			if( $discountValueMostExpensiveItem > $mostExpensiveItemValue )
	  			$discountValueMostExpensiveItem = $mostExpensiveItemValue;
	  	}


	  	
	  	// DESCONTO NO PRODUTO MAIS BARATO
	  	if( property_exists($discountRuleObj, 'mostExpensiveProductPercent') || property_exists($discountRuleObj, 'mostExpensiveProductValue') ){
	  		
		  	$mostExpensiveItemValue    = null;
		  	$mostExpensiveItemQuantity = 0;
		  	foreach($cartSessionObj->productItemList as $productItem){
		  		
		  		if( is_null($mostExpensiveItemValue) || $productItem->price > $mostExpensiveItemValue ){
		  			
		  			$mostExpensiveItemValue    = $productItem->price;
		  			$mostExpensiveItemQuantity = $productItem->quantity;
		  		}
		  	}
		  	
		  	if( property_exists($discountRuleObj, 'mostExpensiveProductPercent') )
		  		$discountValueMostExpensiveProduct += ($mostExpensiveItemValue*$mostExpensiveItemQuantity)*$discountRuleObj->mostExpensiveProductPercent/100;
		
		  	if( property_exists($discountRuleObj, 'mostExpensiveProductValue') )
		  		$discountValueMostExpensiveProduct += $discountRuleObj->mostExpensiveProductValue;
		  		
			if( $discountValueMostExpensiveProduct > ($mostExpensiveItemValue*$mostExpensiveItemQuantity) )
	  			$discountValueMostExpensiveProduct = ($mostExpensiveItemValue*$mostExpensiveItemQuantity);
	  	}
	  	
	  	$discountValue = $discountValueShipping+$discountValueOrder+$discountValueTotal+$discountValueCheaperItem+$discountValueCheaperProduct+$discountValueMostExpensiveItem+$discountValueMostExpensiveProduct;
	  	$totalValue    = $cartSessionObj->orderValue + $cartSessionObj->shippingValue;
	  	
	  	if( $discountValue > $totalValue )
	  		$discountValue = $totalValue;
	  	
	  	return $discountValue;
	}
	
	public function validateCoupon(){
		
		return ($this->isNew() || ($this->getIsActive() && !$this->getHasUsed() && $this->getEnabled() && $this->getVisible()));
	}
	
	public function maskAsUsed($purchaseObj, $con){
		
		$this->setPurchase($purchaseObj);
		$this->setHasUsed(true);
		$this->setIsActive(false);
		$this->save($con);
	}
	
	public function getPurchase($con=null){
	
		$purchaseObj = parent::getPurchase($con);

		if( !is_object($purchaseObj) )
			$purchaseObj = new Purchase();
		
		return $purchaseObj;
	}
}
