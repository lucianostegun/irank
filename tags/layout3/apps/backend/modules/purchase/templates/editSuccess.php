<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">       
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#purchaseForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('purchase/tab/main', array('purchaseObj'=>$purchaseObj)) ?></div>
		</div>
	</div>
</div>
