<?php
	$isNew  = $cashTableObj->getIsNew();
	$isOpen = $cashTableObj->isOpen();
?>
<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">       
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li class="<?php echo ($isNew?'hidden':'') ?>" id="cashTableTableTab"><a href="#tab2">Mesa</a></li>
			<li><a href="#tab3">Movimentações</a></li>
			<li><a href="#tab4">Transações</a></li>
			<?php
				echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#cashTableForm").submit()'));
				
				echo submit_tag('abrir mesa', array('class'=>'button basic', 'style'=>'margin: 3px 10px; float: right; display: '.(!$isOpen && !$isNew?'block':'none'), 'onclick'=>'openCashTable()', 'id'=>'cashTableOpenButton'));
				echo submit_tag('fechar mesa', array('class'=>'button greyishB', 'style'=>'margin: 3px 10px; float: right; display: '.($isOpen && !$isNew?'block':'none'), 'onclick'=>'closeCashTable()', 'id'=>'cashTableCloseButton'));
			?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('cashTable/tab/main', array('cashTableObj'=>$cashTableObj)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('cashTable/tab/table', array('cashTableObj'=>$cashTableObj)) ?></div>
			<div id="tab3" class="tab_content"><?php include_partial('cashTable/tab/transactionsBuyin', array('cashTableObj'=>$cashTableObj)) ?></div>
			<div id="tab4" class="tab_content"><?php include_partial('cashTable/tab/transactions', array('cashTableObj'=>$cashTableObj)) ?></div>
		</div>
	</div>
</div>
<?php include_partial('cashTable/dialog/peopleSelect', array('cashTableId'=>$cashTableObj->getId())) ?>