<?php
	echo form_remote_tag(array(
		'url'=>'discountCoupon/save',
		'success'=>'handleSuccessDiscountCoupon(response)',
		'failure'=>'handleFailureDiscountCoupon(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'discountCouponForm'));

//	echo form_tag('discountCoupon/save', array('class'=>'form', 'id'=>'discountCouponForm'));
	
	$discountCouponId = $discountCouponObj->getId();
	
	echo input_hidden_tag('discountCouponId', $discountCouponId);
	
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
			<span class="multiple"><?php echo input_tag('couponCode', $discountCouponObj->getCouponCode(), array('size'=>24, 'maxlength'=>16, 'id'=>'discountCouponCouponCode')) ?></span>
			<span class="multiple"><?php echo link_to(image_tag('backend/icons/light/cog', array('class'=>'icon')).'<span>Gerar código</span>', '#buildRandomCouponCode()', array('class'=>'button greyishB')) ?></span>
			<div class="formNote">Código entre 10 e 16 posições, começando e terminando com uma letra</div>
			<div class="formNote error" id="discountCouponFormErrorCouponCode"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Frete (%)</label>
		<div class="formRight" style="width: 15%">
			<div class="<?php echo ($shippingPercent?'':'hidden') ?>" id="shippingPercentFieldDiv"><?php echo input_tag('shippingPercent', Util::formatFloat($shippingPercent, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponShippingPercent')) ?></div>
			<label class="<?php echo ($shippingPercent?'hidden':'') ?>" id="shippingPercentLabel"><?php echo link_to('Editar', '#openDiscountField("shippingPercent")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorShippingPercent"></div>
		</div>

		<label>Frete (R$)</label>
		<div class="formRight">
			<div class="<?php echo ($shippingValue?'':'hidden') ?>" id="shippingValueFieldDiv"><?php echo input_tag('shippingValue', Util::formatFloat($shippingValue, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponShippingValue')) ?></div>
			<label class="<?php echo ($shippingValue?'hidden':'') ?>" id="shippingValueLabel"><?php echo link_to('Editar', '#openDiscountField("shippingValue")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorShippingValue"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Subtotal (%)</label>
		<div class="formRight" style="width: 15%">
			<div class="<?php echo ($orderPercent?'':'hidden') ?>" id="orderPercentFieldDiv"><?php echo input_tag('orderPercent', Util::formatFloat($orderPercent, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponOrderPercent')) ?></div>
			<label class="<?php echo ($orderPercent?'hidden':'') ?>" id="orderPercentLabel"><?php echo link_to('Editar', '#openDiscountField("orderPercent")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorOrderPercent"></div>
		</div>

		<label>Subtotal (R$)</label>
		<div class="formRight">
			<div class="<?php echo ($orderValue?'':'hidden') ?>" id="orderValueFieldDiv"><?php echo input_tag('orderValue', Util::formatFloat($orderValue, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponOrderValue')) ?></div>
			<label class="<?php echo ($orderValue?'hidden':'') ?>" id="orderValueLabel"><?php echo link_to('Editar', '#openDiscountField("orderValue")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorOrderValue"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Total (%)</label>
		<div class="formRight" style="width: 15%">
			<div class="<?php echo ($totalPercent?'':'hidden') ?>" id="totalPercentFieldDiv"><?php echo input_tag('totalPercent', Util::formatFloat($totalPercent, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponTotalPercent')) ?></div>
			<label class="<?php echo ($totalPercent?'hidden':'') ?>" id="totalPercentLabel"><?php echo link_to('Editar', '#openDiscountField("totalPercent")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorTotalPercent"></div>
		</div>

		<label>Total (R$)</label>
		<div class="formRight">
			<div class="<?php echo ($totalValue?'':'hidden') ?>" id="totalValueFieldDiv"><?php echo input_tag('totalValue', Util::formatFloat($totalValue, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponTotalValue')) ?></div>
			<label class="<?php echo ($totalValue?'hidden':'') ?>" id="totalValueLabel"><?php echo link_to('Editar', '#openDiscountField("totalValue")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorTotalValue"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Item mais barato (%)</label>
		<div class="formRight" style="width: 15%">
			<div class="<?php echo ($cheaperItemPercent?'':'hidden') ?>" id="cheaperItemPercentFieldDiv"><?php echo input_tag('cheaperItemPercent', Util::formatFloat($cheaperItemPercent, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponCheaperItemPercent')) ?></div>
			<label class="<?php echo ($cheaperItemPercent?'hidden':'') ?>" id="cheaperItemPercentLabel"><?php echo link_to('Editar', '#openDiscountField("cheaperItemPercent")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorCheaperItemPercent"></div>
		</div>

		<label>Item mais barato (R$)</label>
		<div class="formRight">
			<div class="<?php echo ($cheaperItemValue?'':'hidden') ?>" id="cheaperItemValueFieldDiv"><?php echo input_tag('cheaperItemValue', Util::formatFloat($cheaperItemValue, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponCheaperItemValue')) ?></div>
			<label class="<?php echo ($cheaperItemValue?'hidden':'') ?>" id="cheaperItemValueLabel"><?php echo link_to('Editar', '#openDiscountField("cheaperItemValue")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorCheaperItemValue"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Produto mais barato (%)</label>
		<div class="formRight" style="width: 15%">
			<div class="<?php echo ($cheaperProductPercent?'':'hidden') ?>" id="cheaperProductPercentFieldDiv"><?php echo input_tag('cheaperProductPercent', Util::formatFloat($cheaperProductPercent, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponCheaperProductPercent')) ?></div>
			<label class="<?php echo ($cheaperProductPercent?'hidden':'') ?>" id="cheaperProductPercentLabel"><?php echo link_to('Editar', '#openDiscountField("cheaperProductPercent")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorCheaperProductPercent"></div>
		</div>

		<label>Produto mais barato (R$)</label>
		<div class="formRight">
			<div class="<?php echo ($cheaperProductValue?'':'hidden') ?>" id="cheaperProductValueFieldDiv"><?php echo input_tag('cheaperProductValue', Util::formatFloat($cheaperProductValue, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponCheaperProductValue')) ?></div>
			<label class="<?php echo ($cheaperProductValue?'hidden':'') ?>" id="cheaperProductValueLabel"><?php echo link_to('Editar', '#openDiscountField("cheaperProductValue")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorCheaperProductValue"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Item mais caro (%)</label>
		<div class="formRight" style="width: 15%">
			<div class="<?php echo ($mostExpensiveItemPercent?'':'hidden') ?>" id="mostExpensiveItemPercentFieldDiv"><?php echo input_tag('mostExpensiveItemPercent', Util::formatFloat($mostExpensiveItemPercent, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponMostExpensiveItemPercent')) ?></div>
			<label class="<?php echo ($mostExpensiveItemPercent?'hidden':'') ?>" id="mostExpensiveItemPercentLabel"><?php echo link_to('Editar', '#openDiscountField("mostExpensiveItemPercent")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorMostExpensiveItemPercent"></div>
		</div>

		<label>Item mais caro (R$)</label>
		<div class="formRight">
			<div class="<?php echo ($mostExpensiveItemValue?'':'hidden') ?>" id="mostExpensiveItemValueFieldDiv"><?php echo input_tag('mostExpensiveItemValue', Util::formatFloat($mostExpensiveItemValue, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponMostExpensiveItemValue')) ?></div>
			<label class="<?php echo ($mostExpensiveItemValue?'hidden':'') ?>" id="mostExpensiveItemValueLabel"><?php echo link_to('Editar', '#openDiscountField("mostExpensiveItemValue")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorMostExpensiveItemValue"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Produto mais caro (%)</label>
		<div class="formRight" style="width: 15%">
			<div class="<?php echo ($mostExpensiveProductPercent?'':'hidden') ?>" id="mostExpensiveProductPercentFieldDiv"><?php echo input_tag('mostExpensiveProductPercent', Util::formatFloat($mostExpensiveProductPercent, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponMostExpensiveProductPercent')) ?></div>
			<label class="<?php echo ($mostExpensiveProductPercent?'hidden':'') ?>" id="mostExpensiveProductPercentLabel"><?php echo link_to('Editar', '#openDiscountField("mostExpensiveProductPercent")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorMostExpensiveProductPercent"></div>
		</div>

		<label>Produto mais caro (R$)</label>
		<div class="formRight">
			<div class="<?php echo ($mostExpensiveProductValue?'':'hidden') ?>" id="mostExpensiveProductValueFieldDiv"><?php echo input_tag('mostExpensiveProductValue', Util::formatFloat($mostExpensiveProductValue, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'discountCouponMostExpensiveProductValue')) ?></div>
			<label class="<?php echo ($mostExpensiveProductValue?'hidden':'') ?>" id="mostExpensiveProductValueLabel"><?php echo link_to('Editar', '#openDiscountField("mostExpensiveProductValue")') ?></label>
			<div class="formNote error" id="discountCouponFormErrorMostExpensiveProductValue"></div>
		</div>
		<div class="clear"></div>
	</div>



	<div class="formRow">
		<label>Cupom ativo</label>
		<div class="formRight">
			<?php echo checkbox_tag('isActive', true, $discountCouponObj->getIsActive(), array('id'=>'discountCouponIsActive')) ?>
			<div class="formNote error" id="discountCouponFormErrorIsActive"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Status</label>
		<div class="formRight">
			<label>Cupom <?php echo ($hasUsed?'já':'ainda NÃO') ?> utilizado</label>
		</div>
		<div class="clear"></div>
	</div>

</form>