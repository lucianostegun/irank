<?php
	$discountCouponId = $discountCouponObj->getId();
	
	$discountRuleObj = $discountCouponObj->getDiscountRule();
	$discountRuleObj = unserialize($discountRuleObj);
	
	$shippingPercent             = (property_exists($discountRuleObj, 'shippingPercent')?$discountRuleObj->shippingPercent:0);
	$shippingValue               = (property_exists($discountRuleObj, 'shippingValue')?$discountRuleObj->shippingValue:0);
	$orderPercent                = (property_exists($discountRuleObj, 'orderPercent')?$discountRuleObj->orderPercent:0);
	$orderValue                  = (property_exists($discountRuleObj, 'orderValue')?$discountRuleObj->orderValue:0);
	$totalPercent                = (property_exists($discountRuleObj, 'totalPercent')?$discountRuleObj->totalPercent:0);
	$totalValue                  = (property_exists($discountRuleObj, 'totalValue')?$discountRuleObj->totalValue:0);
	$cheaperItemPercent          = (property_exists($discountRuleObj, 'cheaperItemPercent')?$discountRuleObj->cheaperItemPercent:0);
	$cheaperItemValue            = (property_exists($discountRuleObj, 'cheaperItemValue')?$discountRuleObj->cheaperItemValue:0);
	$cheaperProductValue         = (property_exists($discountRuleObj, 'cheaperProductValue')?$discountRuleObj->cheaperProductValue:0);
	$cheaperProductPercent       = (property_exists($discountRuleObj, 'cheaperProductPercent')?$discountRuleObj->cheaperProductPercent:0);
	$mostExpensiveItemPercent    = (property_exists($discountRuleObj, 'mostExpensiveItemPercent')?$discountRuleObj->mostExpensiveItemPercent:0);
	$mostExpensiveItemValue      = (property_exists($discountRuleObj, 'mostExpensiveItemValue')?$discountRuleObj->mostExpensiveItemValue:0);
	$mostExpensiveProductValue   = (property_exists($discountRuleObj, 'mostExpensiveProductValue')?$discountRuleObj->mostExpensiveProductValue:0);
	$mostExpensiveProductPercent = (property_exists($discountRuleObj, 'mostExpensiveProductPercent')?$discountRuleObj->mostExpensiveProductPercent:0);
	
	$hasUsed = $discountCouponObj->getHasUsed();
?>
	<div class="formRow">
		<label>Código</label>
		<div class="formRight">
			<label><?php echo $discountCouponObj->getCouponCode() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Frete (%)</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo Util::formatFloat($shippingPercent, true) ?></label>
		</div>

		<label>Frete (R$)</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($shippingValue, true) ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Subtotal (%)</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo Util::formatFloat($orderPercent, true) ?></label>
		</div>

		<label>Subtotal (R$)</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($orderValue, true) ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Total (%)</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo Util::formatFloat($totalPercent, true) ?></label>
		</div>

		<label>Total (R$)</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($totalValue, true) ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Item mais barato (%)</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo Util::formatFloat($cheaperItemPercent, true) ?></label>
		</div>

		<label>Item mais barato (R$)</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($cheaperItemValue, true) ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Produto mais barato (%)</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo Util::formatFloat($cheaperProductPercent, true) ?></label>
		</div>

		<label>Produto mais barato (R$)</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($cheaperProductValue, true) ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Item mais caro (%)</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo Util::formatFloat($mostExpensiveItemPercent, true) ?></label>
		</div>

		<label>Item mais caro (R$)</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($mostExpensiveItemValue, true) ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Produto mais caro (%)</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo Util::formatFloat($mostExpensiveProductPercent, true) ?></label>
		</div>

		<label>Produto mais caro (R$)</label>
		<div class="formRight">
			<label><?php echo Util::formatFloat($mostExpensiveProductValue, true) ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<br/>
	<h5>Utilização</h5>
	<hr/>
	<br/>
	<div class="formRow">
		<label>Status</label>
		<div class="formRight" style="width: 15%">
			<label>Cupom <?php echo ($hasUsed?'já':'ainda NÃO') ?> utilizado</label>
		</div>
	
		<?php if( $hasUsed ): ?>
		<label>Pedido</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo link_to('#'.$discountCouponObj->getPurchase()->getOrderNumber(), 'store/purchase?edit='.$discountCouponObj->getPurchaseId()); ?></label>
		</div>
		<?php endif; ?>
		<div class="clear"></div>
	</div>

	<?php if( $hasUsed ): ?>
	<div class="formRow">
		<label>Data de uso</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo $discountCouponObj->getPurchase()->getCreatedAt('d/m/Y H:i') ?></label>
		</div>
	
		<label>Usuário</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo $discountCouponObj->getPurchase()->getUserSite()->getPeople()->getName() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Total do pedido</label>
		<div class="formRight" style="width: 15%">
			<label>R$ <?php echo Util::formatFloat($discountCouponObj->getPurchase()->getTotalValue(), true) ?></label>
		</div>
	
		<label>Valor do desconto</label>
		<div class="formRight" style="width: 15%">
			<label>R$ <?php echo Util::formatFloat($discountCouponObj->getPurchase()->getDiscountValue(), true) ?></label>
		</div>
		<div class="clear"></div>
	</div>
	<?php endif; ?>
	
</form>