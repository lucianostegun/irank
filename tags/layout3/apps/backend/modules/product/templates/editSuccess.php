<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">       
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li><a href="#tab2">Itens</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#productForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('product/tab/main', array('productObj'=>$productObj)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('product/tab/itens', array('productObj'=>$productObj)) ?></div>
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript">
	SI.Files.stylizeAll();
</script>