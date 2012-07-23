<div style="position: relative">
	<?php echo link_to(image_tag('backend/icons/light/cancelar', array('class'=>'icon')).'<span>Cancelar</span>', '#hideProductItemForm()', array('class'=>'button greyishB hidden', 'id'=>'cancelAddProductItemLink')) ?>
	<?php echo link_to(image_tag('backend/icons/light/add', array('class'=>'icon')).'<span>Adicionar item</span>', '#addProductItem()', array('class'=>'button greyishB', 'id'=>'addProductItemLink')) ?>
	<?php echo link_to(image_tag('backend/icons/light/archive', array('class'=>'icon')).'<span>Salvar item</span>', '#$("#productItemForm").submit()', array('class'=>'button blueB hidden', 'id'=>'saveProductItemLink')) ?>
	<?php echo link_to(image_tag('backend/icons/light/close', array('class'=>'icon')).'<span>Excluir item</span>', '#deleteProductItem()', array('class'=>'button redB hidden', 'style'=>'float: right', 'id'=>'deleteProductItemLink')) ?>
</div>
<div class="widget" id="productItemListDiv">
	<?php
		$productId = $productObj->getId();
		include_partial('product/include/itens', array('productObj'=>$productObj));
	?>
</div>

<div id="productItemFormDiv" class="form hidden mt30">

	<?php
		echo form_remote_tag(array(
			'url'=>'product/saveItem',
			'success'=>'handleSuccessProductItem(response)',
			'failure'=>'handleFailureProductItem(response.responseText)',
			'loading'=>'showIndicator()',
			),
			array('class'=>'form', 'id'=>'productItemForm'));
	
//		echo form_tag('product/saveItem', array('class'=>'form', 'id'=>'productItemForm'));
		
		echo input_hidden_tag('productItemId', null);
		echo input_hidden_tag('productId', $productId, array('id'=>'productItemProductId'));
		echo input_hidden_tag('image1', null, array('id'=>'productItemImage1'));
	?>
		<div class="formRow">
			<label>Cor</label>
			<div class="formRight">
				<?php
					$optionList = ProductOption::getOptionsForSelect('color', null, false, true, 'optionName');
					$optionList[''] = 'Selecione';
					ksort($optionList);
					echo select_tag('productOptionIdColor', options_for_select($optionList), array('id'=>'productItemProductOptionIdColor'));
				?>
				<div class="clear"></div>
				<div class="formNote error" id="productItemFormErrorProductOptionIdColor"></div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow">
			<label>Tamanho</label>
			<div class="formRight">
				<?php
					$optionList = ProductOption::getOptionsForSelect('size', null, false, true, 'description', $productObj->getProductCategoryId());
					$optionList[''] = 'Selecione';
					ksort($optionList);
					echo select_tag('productOptionIdSize', options_for_select($optionList), array('id'=>'productItemProductOptionIdSize'));
				?>
				<div class="clear"></div>
				<div class="formNote error" id="productItemFormErrorProductOptionIdSize"></div>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="formRow">
			<label>Preço</label>
			<div class="formRight">
				<?php echo input_tag('price', null, array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'productItemPrice')) ?>
				<div class="formNote error" id="productItemFormErrorPrice"></div>
			</div>
			<div class="clear"></div>
		</div>
	
		<div class="formRow">
			<label>Peso</label>
			<div class="formRight">
				<?php echo input_tag('weight', 0, array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'productItemWeight')) ?>
				<div class="formNote">gramas</div>
				<div class="formNote error" id="productItemFormErrorWeight"></div>
			</div>
			<div class="clear"></div>
		</div>
	
		<div class="formRow">
			<label>Estoque atual</label>
			<div class="formRight">
				<?php echo input_tag('stock', null, array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'productItemStock')) ?>
				<div class="formNote error" id="productItemFormErrorStock"></div>
			</div>
			<div class="clear"></div>
		</div>
	
	</form>
	
	<br/>
	<h5>Imagens</h5>
	<hr/>
	<br/>
	<?php
		echo form_tag('product/uploadImage', array('class'=>'form', 'id'=>'productItemImageForm', 'target'=>'uploadFileFrame', 'enctype'=>'multipart/form-data'));
		echo input_hidden_tag('productItemId', null, array('id'=>'productItemImageProductItemId'));
		echo input_hidden_tag('imageIndex', null, array('id'=>'productItemImageIndex'));
		echo input_hidden_tag('productCode', $productObj->getProductCode(), array('id'=>'productItemImageProductCode'));
	?>
	<div class="formRow">
		<div class="formRight">
			<?php
				for($i=1; $i <= 5; $i++):
			?>
			<span class="multiple">
				<div class="cabinet productImage">
					<span>Imagem <?php echo $i ?></span>
					<?php
						echo image_tag('blank', array('id'=>'productItemImage-'.$i));
						
						echo input_file_tag('filePath-'.$i, array('onchange'=>'submitProductImage('.$i.', true)', 'class'=>'fileUpload', 'id'=>'productItemFilePathImage-'.$i));
					?>
				</div>
			</span>
			<?php endfor; ?>
			<div class="clear mt10"></div>
			<div class="formNote error" id="productItemFormErrorImage1"></div>
			
		</div>
		<div class="clear"></div>
	</div>
	</form>

</div>