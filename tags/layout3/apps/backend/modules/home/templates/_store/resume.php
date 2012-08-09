<div class="widget">
	<div class="title">
		<?php echo image_tag('backend/icons/dark/money', array('class'=>'titleIcon')); ?>
		<h6>Loja virtual</h6>
		<div class="topIcons">
			<a href="#" class="tipS" title="Download do pedido"><img src="/images/backend/icons/downloadTop.png" alt="" /></a>
			<a href="#" class="tipS" title="Imprimir pedido"><img src="/images/backend/icons/printTop.png" alt="" /></a>
			<a href="#" class="tipS" title="Editar"><img src="/images/backend/icons/editTop.png" alt="" /></a>
		</div>
	</div>
	<div class="newOrder">
		<?php
			$criteria = new Criteria();
			
			$criterion = $criteria->getNewCriterion( PurchasePeer::ORDER_STATUS, 'new' );
			$criterion->addOr( $criteria->getNewCriterion( PurchasePeer::UPDATED_AT, Util::getDate('-7d'), Criteria::GREATER_EQUAL ) );
			
			$criteria->add( $criterion );
			$purchaseObjList = PurchasePeer::search($criteria);
			
			foreach($purchaseObjList as $purchaseObj):
				
				$peopleObj  = $purchaseObj->getUserSite()->getPeople();
				$purchaseId = $purchaseObj->getId();
		?>
		<div class="userRow">
			<a href="#" title=""><img src="images/user.png" alt="" class="floatL" /></a>
			<ul class="leftList">
				<li><?php echo link_to('<strong>'.$peopleObj->getName().'</strong>', 'purchase/edit?id='.$purchaseId) ?> - <?php echo link_to('Detalhes', '#showPurchaseDetails('.$purchaseId.')') ?></li>
				<li>Status do pedido:</li>
			</ul>
			<ul class="rightList">
				<li><?php echo link_to('<strong>#'.$purchaseObj->getOrderNumber().'</strong>', 'purchase/edit?id='.$purchaseId) ?></li>
				<li class="orderIcons">
					<?php
						$orderStatusList = array('complete'=>null,
												 'shipped'=>null,
												 'approved'=>null,
												 'new'=>null);
						
						foreach($purchaseObj->getPurchaseStatusLogList() as $purchaseStatusLogObj){
							
							$orderStatus = $purchaseStatusLogObj->getOrderStatus();
							if( !array_key_exists($orderStatus, $orderStatusList) )
								continue;
							
							$timestamp = $purchaseStatusLogObj->getCreatedAt(null);
							$title = sprintf('%s: %s, %02d de %s de %d', $purchaseStatusLogObj->getTransactionStatus(),
																			Util::getWeekDay(date('w', $timestamp)),
																			date('d', $timestamp),
																			Util::getMonthName(date('m', $timestamp)),
																			date('Y', $timestamp));
																			   
							$orderStatusList[$orderStatus] = $title;
						}
					?>
					<?php foreach($orderStatusList as $orderStatus=>$title): ?>
						<span class="o<?php echo ($title?ucfirst($orderStatus):'Un'.$orderStatus) ?> tipN" title="<?php echo $title ?>"></span>
					<?php endforeach; ?>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
	
			<div class="cLine"></div>
		<div class="orderDetails" id="purchaseDetails-<?php echo $purchaseId ?>">
			
			<div class="orderRow">
				<ul class="leftList">
					<li>Data/Hora:</li>
					<li>Total dos pedidos:</li>
					<li>Frete</li>
					<li>Desconto</li>
				</ul>
				<ul class="rightList">
					<li><strong><?php echo Util::getWeekDay($purchaseObj->getCreatedAt('w')).', '.$purchaseObj->getCreatedAt('d/m/Y') ?></strong> |  <?php echo $purchaseObj->getCreatedAt('H:i') ?></li>
					<li><strong class="green">R$ <?php echo Util::formatFloat($purchaseObj->getOrderValue(), true) ?></strong></li>
					<li><strong class="orange">R$ <?php echo Util::formatFloat($purchaseObj->getShippingValue(), true) ?></strong></li>
					<li><strong class="orange">R$ <?php echo Util::formatFloat($purchaseObj->getDiscountValue()*-1, true) ?></strong></li>
				</ul>
				<div class="clear"></div>
			</div>
			
			<div class="cLine"></div>
			<div class="totalAmount"><h6 class="floatL blue">Total:</h6><h6 class="floatR blue">R$ <?php echo Util::formatFloat($purchaseObj->getTotalValue(), true) ?></h6><div class="clear"></div></div>
		</div>
		<?php endforeach; ?>
	</div>
</div>