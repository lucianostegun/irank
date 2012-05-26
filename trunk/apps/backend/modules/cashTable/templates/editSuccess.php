<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">       
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#cashTableForm").submit()')); ?>
			<?php
				$isOpen = $cashTableObj->isOpen();
				echo submit_tag('abrir mesa', array('class'=>'button basic', 'style'=>'margin: 3px 10px; float: right; display: '.(!$isOpen?'block':'none'), 'onclick'=>'openCashTable()', 'id'=>'cashTableOpenButton'));
				echo submit_tag('fechar mesa', array('class'=>'button greyishB', 'style'=>'margin: 3px 10px; float: right; display: '.($isOpen?'block':'none'), 'onclick'=>'closeCashTable()', 'id'=>'cashTableCloseButton'));
			?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('cashTable/tab/main', array('cashTableObj'=>$cashTableObj)) ?></div>
		</div>
	</div>
</div>
<?php include_partial('cashTable/dialog/playerSelect', array('cashTableId'=>$cashTableObj->getId())) ?>