<div class="wrapper">
    <div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Cupons de desconto</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th>Código</th>
					<th width="100">Ativo</th>
					<th width="100">Utilizado</th>
					<th width="100">Compra</th>
					<th width="130">Data uso</th> 
					<th width="80">Desconto</th>
				</tr> 
			</thead> 
			<tbody id="discountCouponTbody"> 
				<?php
					$criteria = new Criteria();
					foreach(DiscountCoupon::getList($criteria) as $discountCouponObj):
						
						$discountCouponId  = $discountCouponObj->getId();
						$onclick = 'goToPage(\'discountCoupon\', \'edit\', \'discountCouponId\', '.$discountCouponId.')"';
				?>
				<tr class="gradeA" id="discountCouponIdRow-<?php echo $discountCouponId ?>">
					<td onclick="<?php echo $onclick ?>"><?php echo $discountCouponObj->getCouponCode() ?></td>
					<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $discountCouponObj->getIsActive()?'Sim':'Não' ?></td>
					<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $discountCouponObj->getHasUsed()?'Sim':'Não' ?></td>
					<td onclick="<?php echo $onclick ?>" class="textR"><?php echo $discountCouponObj->getPurchase()->getCode() ?></td>
					<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $discountCouponObj->getPurchase()->getCreatedAt('d/m/Y H:i:s') ?></td>
					<td onclick="<?php echo $onclick ?>" class="textR"><?php echo Util::formatFloat($discountCouponObj->getPurchase()->getDiscountValue(), true) ?></td>
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>