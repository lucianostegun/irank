<?php
	echo form_remote_tag(array(
		'url'=>'purchase/save',
		'success'=>'handleSuccessPurchase(response)',
		'failure'=>'handleFailurePurchase(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'purchaseForm'));

//	echo form_tag('purchase/save', array('class'=>'form', 'id'=>'purchaseForm'));
	
	$purchaseId = $purchaseObj->getId();
	echo input_hidden_tag('purchaseId', $purchaseId);
	
	$fileObj = $purchaseObj->getFile();
	
	$discountCouponObj  = $purchaseObj->getDiscountCoupon();
	$discountCouponLink = null;
	
	if( is_object($discountCouponObj) ){
		
		$discountCouponId   = $discountCouponObj->getId();
		$discountCouponCode = $discountCouponObj->getCouponCode();
		$discountCouponLink = link_to($discountCouponCode, 'discountCoupon/view?discountCouponId='.$discountCouponId, array('target'=>'_blank')).' - ';
	}
?>
	<div class="formRow">
		<label>Nº pedido</label>
		<div class="formRight" style="width: 15%">
			<label>#<?php echo $purchaseObj->getOrderNumber() ?></label>
		</div>
	
		<label>Status</label>
		<div class="formRight">
			<span class="multiple"><?php echo select_tag('orderStatus', options_for_select(Purchase::getOrderStatusList(), $purchaseObj->getOrderStatus()), array('id'=>'purchaseOrderStatus')); ?></span>
			<span class="multiple"><?php echo link_to(image_tag('backend/icons/light/mail', array('class'=>'icon')).'<span>Enviar e-mail</span>', '#sendPurchaseNotify()', array('class'=>'button greyishB', 'id'=>'cancelAddProductItemLink')) ?></span>
			<div class="clear"></div>
			<div class="formNote error" id="purchaseFormErrorOrderStatus"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Data de envio</label>
		<div class="formRight" style="width: 15%">
			<?php echo input_tag('shippingDate', $purchaseObj->getShippingDate('d/m/Y'), array('maxlength'=>10, 'class'=>'maskDate', 'id'=>'purchaseShippingDate')) ?>
			<div class="formNote error" id="purchaseFormErrorShippingDate"></div>
		</div>
	
		<label>Cód. rastreamento</label>
		<div class="formRight">
			<?php echo input_tag('tracingCode', $purchaseObj->getTracingCode(), array('id'=>'purchaseTracingCode')); ?>
			<div class="formNote error" id="purchaseFormErrorTracingCode"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Usuário</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo $purchaseObj->getUserSite()->getPeople()->getName() ?></label>
		</div>

		<label>Endereço IP</label>
		<div class="formRight">
			<label><?php echo $purchaseObj->getIpAddress() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Data do pedido</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo $purchaseObj->getCreatedAt('d/m/Y H:i:s') ?></label>
		</div>

		<label>Duração da sessão</label>
		<div class="formRight">
			<label><?php echo $purchaseObj->getDuration() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Forma pagamento</label>
		<div class="formRight" style="width: 15%">
			<label><?php echo $purchaseObj->getPaymethod(true) ?></label>
		</div>

		<label>Comprovante</label>
		<div class="formRight">
			<?php if( is_object($fileObj) ): ?>
			<label style="color: #59983B"><?php echo link_to($fileObj->getFileName(), 'file/download?fileId='.$fileObj->getId()) ?></label>
			<?php else: ?>
			<label style="color: #98593B">Não enviado</label>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Endereço de entrega</label>
		<div class="formRight">
			<label>
				<b><?php echo $purchaseObj->getCustomerName() ?></b><br/>
				<?php echo $purchaseObj->getAddressName().', '.$purchaseObj->getAddressNumber().' '.$purchaseObj->getAddressComplement() ?><br/>
				<?php echo $purchaseObj->getAddressQuarter() ?><br/>
				<?php echo $purchaseObj->getAddressCity().', '.$purchaseObj->getAddressState().' - '.$purchaseObj->getAddressZipcode() ?><br/>
			</label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="widget">
		<table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
		    <thead>
				<tr>
					<td colspan="2">Item</td>
					<td>Qtd</td> 
					<td>Valor un.</td> 
					<td>Valor total</td> 
				</tr> 
			</thead> 
			<tbody id="productItemTbody"> 
				<?php
					foreach($purchaseObj->getPurchaseProductItemList() as $purchaseProductItemObj):
					
					$productItemObj = $purchaseProductItemObj->getProductItem();
			  		$productObj     = $productItemObj->getProduct();
			  		$productCode    = $productObj->getProductCode();
			  		
			  		$productCategoryObj = $productObj->getProductCategory();
					$categoryShortName  = $productCategoryObj->getShortName();
					$productName        = $productObj->getProductName();
					$shortName          = $productObj->getShortName();
					
			  		$color    = $productItemObj->getProductOptionColor()->getOptionName();
			  		$size     = $productItemObj->getProductOptionSize()->getDescription();
			  		$price    = $purchaseProductItemObj->getPrice();
			  		$quantity = $purchaseProductItemObj->getQuantity();
				?>
				<tr class="gradeA higher" id="productIdRow-<?php echo $productId ?>">
					<td class="textC" width="40"><?php echo image_tag($productItemObj->getImageCover('thumb')) ?></td> 
					<td class="textL">
						<?php echo link_to("$categoryShortName: $productName", 'product/edit?id='.$productObj->getId()) ?><br/>
						<?php echo $color ?> | <?php echo $size ?>
					</td> 
					<td class="textR"><?php echo $quantity ?></td> 
					<td class="textR" width="70">R$ <?php echo Util::formatFloat($price, true) ?></td> 
					<td class="textR" width="70">R$ <?php echo Util::formatFloat($price*$quantity, true) ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody>
		</table>
	
        <div class="orderRow">
            <ul class="leftList">
                <li>Data do pedido:</li>
                <li>Subtotal:</li>
                <li>Frete:</li>
                <li>Desconto:</li>
            </ul>
            <ul class="rightList">
                <li><strong><?php echo $purchaseObj->getCreatedAt('d/m/Y') ?></strong> |  <?php echo $purchaseObj->getCreatedAt('H:i:s') ?></li>
                <li><strong class="blue">R$ <?php echo Util::formatFloat($purchaseObj->getOrderValue(), true) ?></strong></li>
                <li><strong class="green">R$ <?php echo Util::formatFloat($purchaseObj->getShippingValue(), true) ?></strong></li>
                <li><?php echo $discountCouponLink ?><strong class="red">R$ <?php echo Util::formatFloat($purchaseObj->getDiscountValue()*-1, true) ?></strong></li>
            </ul>
            <div class="clear"></div>
        </div>
        
        <div class="cLine"></div>
        <div class="totalAmount"><h6 class="floatL blue">Total:</h6><h6 class="floatR blue">R$ <?php echo Util::formatFloat($purchaseObj->getTotalValue(), true) ?></h6><div class="clear"></div></div>
	</div> 






	
</form>