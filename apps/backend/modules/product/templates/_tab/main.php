<?php
	echo form_remote_tag(array(
		'url'=>'product/save',
		'success'=>'handleSuccessProduct(response)',
		'failure'=>'handleFailureProduct(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'productForm'));

//	echo form_tag('product/save', array('class'=>'form', 'id'=>'productForm'));
	
	$productId = $productObj->getId();
	
	echo input_hidden_tag('productId', $productId);
	echo input_hidden_tag('image1', $productObj->getImage1(), array('id'=>'productImage1'));
?>
	<div class="formRow">
		<label>Código</label>
		<div class="formRight">
			<?php echo input_tag('productCode', $productObj->getProductCode(), array('size'=>10, 'maxlength'=>10, 'id'=>'productProductCode')) ?>
			<div class="formNote error" id="productFormErrorProductCode"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Nome do produto</label>
		<div class="formRight">
			<?php echo input_tag('productName', $productObj->getProductName(), array('size'=>35, 'maxlength'=>60, 'id'=>'productProductName')) ?>
			<div class="formNote error" id="productFormErrorProductName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Nome curto</label>
		<div class="formRight">
			<?php echo input_tag('shortName', $productObj->getShortName(), array('size'=>35, 'maxlength'=>60, 'id'=>'productShortName')) ?>
			<div class="formNote error" id="productFormErrorShortName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Categoria</label>
		<div class="formRight">
			<?php echo select_tag('productCategoryId', ProductCategory::getOptionsForSelect($productObj->getProductCategoryId()), array('id'=>'productProductCategoryId')) ?>
			<div class="formNote error" id="productFormErrorProductCategoryId"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Preço</label>
		<div class="formRight">
			<?php echo input_tag('defaultPrice', Util::formatFloat($productObj->getDefaultPrice(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'productDefaultPrice')) ?>
			<div class="formNote error" id="productFormErrorDefaultPrice"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Peso</label>
		<div class="formRight">
			<?php echo input_tag('defaultWeight', Util::formatFloat($productObj->getDefaultWeight(), true, 2, true), array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'productDefaultWeight')) ?>
			<div class="formNote">gramas</div>
			<div class="formNote error" id="productFormErrorDefaultWeight"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Estoque atual</label>
		<div class="formRight">
			<label id="productStock"><?php echo $productObj->getStock() ?></label>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Produto novo</label>
		<div class="formRight">
			<?php echo checkbox_tag('isNew', true, $productObj->getIsNew(), array('id'=>'productIsNew')) ?>
			<div class="formNote error" id="productFormErrorIsNew"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Produto ativo</label>
		<div class="formRight">
			<?php echo checkbox_tag('enabled', true, $productObj->getEnabled(), array('id'=>'productEnabled')) ?>
			<div class="formNote error" id="productFormErrorEnabled"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Produto visível</label>
		<div class="formRight">
			<?php echo checkbox_tag('isNew', true, $productObj->getVisible(), array('id'=>'productVisible')) ?>
			<div class="formNote error" id="productFormErrorVisible"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Descrição</label>
		<div class="formRight" style="width: 70%">
			<?php echo textarea_tag('description', $productObj->getDescription(), array('style'=>'height: 150px', 'id'=>'productDescription')) ?>
			<div class="formNote error" id="productFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>
</form>
	
	<br/>
	<h5>Imagens</h5>
	<hr/>
	<br/>
	<?php
		echo form_tag('product/uploadImage', array('class'=>'form', 'id'=>'productImageForm', 'target'=>'uploadFileFrame', 'enctype'=>'multipart/form-data'));
		echo input_hidden_tag('productId', $productObj->getId(), array('id'=>'productImageProductId'));
		echo input_hidden_tag('imageIndex', null, array('id'=>'productImageIndex'));
		echo input_hidden_tag('productCode', $productObj->getProductCode(), array('id'=>'productImageProductCode'));
	?>
	<div class="formRow">
		<div class="formRight">
			<?php
				for($i=1; $i <= 5; $i++):
					$fileName = $productObj->getImage($i, 'preview');
			?>
			<span class="multiple">
				<div class="productImageArea <?php echo (!$fileName?'empty':'') ?>" id="productImageArea-<?php echo $i ?>">
					<div class="cabinet productImage">
						<span>Imagem <?php echo $i ?></span>
						<?php
							echo image_tag(($fileName?$fileName:'blank'), array('id'=>'productImage-'.$i));
							
							echo input_file_tag('filePath-'.$i, array('onchange'=>'submitProductImage('.$i.', false)', 'class'=>'fileUpload', 'id'=>'productFilePathImage-'.$i));
						?>
					</div>
					<?php echo link_to('remover', '#deleteProductImage('.$i.', false)', array('class'=>'deleteImageLink')) ?>
				</div>
			</span>
			<?php endfor; ?>
			<div class="clear mt10"></div>
			<div class="formNote error" id="productFormErrorImage1"></div>
			
		</div>
		<div class="clear"></div>
	</div>
	<iframe border="0" id="uploadFileFrame" name="uploadFileFrame" class="hidden" src="" width="0" height="0" style="" scrolling="no" frameborder="0"></iframe>

</form>