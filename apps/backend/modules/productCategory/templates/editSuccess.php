<div class="wrapper">
    <!-- Fullscreen tabs -->
	<div class="widget">       
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li><a href="#tab2">Produtos</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#productCategoryForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<div id="tab1" class="tab_content"><?php include_partial('productCategory/tab/main', array('productCategoryObj'=>$productCategoryObj)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('productCategory/tab/products', array('productCategoryId'=>$productCategoryObj->getId())) ?></div>
		</div>
	</div>
</div>
