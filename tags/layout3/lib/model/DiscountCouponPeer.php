<?php

/**
 * Subclasse de persistência de dados para registros da tabela 'discount_coupon'.
 *
 * 
 *
 * @package lib.model
 */ 
class DiscountCouponPeer extends BaseDiscountCouponPeer
{
	
	public static function retrieveByCode($couponCode){
		
		$couponCode = preg_replace('/[^0-9A-Za-z]/', '', $couponCode);
		
		$criteria = new Criteria();
		$criteria->add( DiscountCouponPeer::COUPON_CODE, $couponCode, Criteria::ILIKE );
		$criteria->add( DiscountCouponPeer::IS_ACTIVE, true );
		$criteria->add( DiscountCouponPeer::HAS_USED, false );
		$criteria->add( DiscountCouponPeer::ENABLED, true );
		$criteria->add( DiscountCouponPeer::VISIBLE, true );
		$criteria->add( DiscountCouponPeer::DELETED, false );
		
		return DiscountCouponPeer::doSelectOne($criteria);
	}
	
	public static function uniqueCode($couponCode){
		
		$discountCouponId = MyTools::getRequestParameter('discountCouponId');
		
		$criteria = new Criteria();
		$criteria->add( DiscountCouponPeer::COUPON_CODE, $couponCode, Criteria::ILIKE );
		$criteria->add( DiscountCouponPeer::ID, $discountCouponId, Criteria::NOT_EQUAL );
		$criteria->add( DiscountCouponPeer::ENABLED, true );
		$criteria->add( DiscountCouponPeer::VISIBLE, true );
		$criteria->add( DiscountCouponPeer::DELETED, false );
		$discountCouponObj = DiscountCouponPeer::doSelectOne($criteria);
		
		return !is_object($discountCouponObj);		
	}
}
