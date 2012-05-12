<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">       
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#cashTableForm").submit()')); ?>
			<?php echo submit_tag('abrir mesa', array('class'=>'button greenB', 'style'=>'margin: 3px 10px; float: right', 'onclick'=>'openCashTable()')); ?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('cashTable/tab/main', array('cashTableObj'=>$cashTableObj)) ?></div>
		</div>
	</div>
</div>
