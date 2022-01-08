<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">       
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li><a href="#tab2">Histórico</a></li>
			<li><a href="#tab3">Transações</a></li>
			<li><a href="#tab4">E-mails</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#purchaseForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('purchase/tab/main', array('purchaseObj'=>$purchaseObj)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('purchase/tab/statusLog', array('purchaseId'=>$purchaseObj->getId())) ?></div>
			<div id="tab3" class="tab_content"><?php include_partial('purchase/tab/transactionLog', array('purchaseId'=>$purchaseObj->getId())) ?></div>
			<div id="tab4" class="tab_content"><?php include_partial('purchase/tab/emailLog', array('purchaseId'=>$purchaseObj->getId())) ?></div>
		</div>
	</div>
</div>
