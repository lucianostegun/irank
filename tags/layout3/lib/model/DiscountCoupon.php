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
	
	public function getDiscount($cartSessionObj){
		
		$discountRuleObj = unserialize($this->getDiscountRule());
		$discountValue   = 0;
		
		if( property_exists($discountRuleObj, 'shippingPercent') ){
	  		
	  		$shippingPercent = $discountRuleObj->shippingPercent;
	  		$discountValue  += $cartSessionObj->shippingValue*$shippingPercent/100;
	  	}
	
	  	if( property_exists($discountRuleObj, 'shippingValue') ){
	  		
	  		$shippingValue  = $discountRuleObj->shippingValue;
	  		$discountValue += $shippingValue;
	  	}
	
	  	if( property_exists($discountRuleObj, 'orderPercent') ){
	  		
	  		$orderPercent   = $discountRuleObj->orderPercent;
	  		$discountValue += $cartSessionObj->orderValue*$orderPercent/100;
	  	}
	
	  	if( property_exists($discountRuleObj, 'orderValue') ){
	  		
	  		$orderValue     = $discountRuleObj->orderValue;
	  		$discountValue += $orderValue;
	  	}
		
	  	if( property_exists($discountRuleObj, 'totalPercent') ){
	  		
	  		$totalPercent   = $discountRuleObj->totalPercent;
	  		$discountValue += $cartSessionObj->totalValue*$totalPercent/100;
	  	}
	
	  	if( property_exists($discountRuleObj, 'totalValue') ){
	  		
	  		$totalValue     = $discountRuleObj->totalValue;
	  		$discountValue += $totalValue;
	  	}
	  	
	  	
	  	
		
	  	if( property_exists($discountRuleObj, 'cheaperItemPercent') || property_exists($discountRuleObj, 'cheaperItemValue') ){
	  		
		  	$cheaperItemValue = null;
		  	foreach($cartSessionObj->productItemList as $productItem)
		  		if( is_null($cheaperItemValue) || $productItem->price < $cheaperItemValue )
		  			$cheaperItemValue = $productItem->price;
		  	
		  	if( property_exists($discountRuleObj, 'cheaperItemPercent') ){
		  		
		  		$cheaperItemPercent = $discountRuleObj->cheaperItemPercent;
		  		$discountValue      += $cheaperItemValue*$cheaperItemPercent/100;
		  	}
		
		  	if( property_exists($discountRuleObj, 'cheaperItemValue') ){
		  		
		  		$cheaperItemValue = $discountRuleObj->cheaperItemValue;
		  		$discountValue    += $cheaperItemValue;
		  	}
	  	}
	  	
	  	return $discountValue;
	}
}
