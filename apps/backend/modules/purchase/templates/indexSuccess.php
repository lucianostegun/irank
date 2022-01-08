<div class="wrapper">
    <div class="widget">
		<div class="title"><h6>Pedidos</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable">
		    <thead>
				<tr>
					<th colspan="2">Nº pedido</th> 
					<th>Data</th> 
					<th>Status</th> 
					<th>Usuário</th> 
					<th>Pagamento</th> 
					<th>Produtos</th> 
					<th>Valor</th> 
				</tr> 
			</thead> 
			<tbody id="purchaseTbody"> 
				<?php
					$criteria = new Criteria();
					foreach(Purchase::getList($criteria) as $purchaseObj):
						
						$purchaseId  = $purchaseObj->getId();
						$onclick = 'goToPage(\'purchase\', \'edit\', \'purchaseId\', '.$purchaseId.')"';
						
						$orderStatus = $purchaseObj->getOrderStatus();
						switch($orderStatus){
							case 'new':
							case 'pending':
							case 'checking':
								$icon = 'iconYellow';
								break;
							case 'approved':
							case 'shipped':
								$icon = 'iconGreen';
								break;
							case 'refused':
							case 'canceled':
								$icon = 'iconRed';
								break;
							case 'complete':
								$icon = 'iconWhite';
								break;
						}
				?>
				<tr class="gradeA" id="purchaseIdRow-<?php echo $purchaseId ?>">
					<td onclick="<?php echo $onclick ?>" width="16" class="textC icon"><?php echo image_tag('backend/icons/'.$icon) ?></td> 
					<td onclick="<?php echo $onclick ?>" width="90">#<?php echo $purchaseObj->getOrderNumber() ?></td> 
					<td onclick="<?php echo $onclick ?>" width="120" class="textC"><?php echo $purchaseObj->getCreatedAt('d/m/Y H:i') ?></td> 
					<td onclick="<?php echo $onclick ?>" width="120"><?php echo $purchaseObj->getOrderStatus(true) ?></td> 
					<td onclick="<?php echo $onclick ?>"><?php echo $purchaseObj->getUserSite()->getPeople()->getName() ?></td> 
					<td onclick="<?php echo $onclick ?>" width="120"><?php echo $purchaseObj->getPaymethod(true) ?></td> 
					<td onclick="<?php echo $onclick ?>" width="50" class="textR"><?php echo $purchaseObj->getProducts() ?></td> 
					<td onclick="<?php echo $onclick ?>" width="90" class="textR">R$ <?php echo Util::formatFloat($purchaseObj->getTotalValue(), true) ?></td> 
				</tr> 
				<?php
					endforeach;
				?>
			</tbody> 
		</table>
	</div>
</div>