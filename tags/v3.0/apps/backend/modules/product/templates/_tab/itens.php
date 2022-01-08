<div style="position: relative">
	<?php echo link_to('<span>Cancelar</span>', '#hideProductItemForm()', array('class'=>'button greyishB hidden', 'id'=>'cancelAddProductItemLink')) ?>
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
		<div class="formRow" id="productItemProductOptionIdColorDiv">
			<label>Cor</label>
			<div class="formRight">
				<?php
					$optionListColor = ProductOption::getOptionsForSelect('color', null, false, true, 'optionName');
					$optionListColor[''] = 'Selecione';
					ksort($optionListColor);
					echo select_tag('productOptionIdColor', options_for_select($optionListColor), array('id'=>'productItemProductOptionIdColor'));
				?>
				<div class="clear"></div>
				<div class="formNote error" id="productItemFormErrorProductOptionIdColor"></div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow" id="productItemProductOptionIdSizeDiv">
			<label>Tamanho</label>
			<div class="formRight">
				<?php
					$optionListSize = ProductOption::getOptionsForSelect('size', null, false, true, 'description', $productObj->getProductCategoryId());
					$optionListSize[''] = 'Selecione';
					ksort($optionListSize);
					echo select_tag('productOptionIdSize', options_for_select($optionListSize), array('id'=>'productItemProductOptionIdSize'));
				?>
				<div class="clear"></div>
				<div class="formNote error" id="productItemFormErrorProductOptionIdSize"></div>
			</div>
			<div class="clear"></div>
		</div>

		<div class="formRow" id="productItemProductOptionIdDiv">
			<label>Cores/Tamanhos</label>
			<div class="formRight">
				<table width="0%" cellspacing="0" cellpadding="0">
					<tr>
						<th></th>
						<?php
							$optionListSize = ProductOption::getOptionsForSelect('size', null, false, true, 'optionName', $productObj->getProductCategoryId());
							
							foreach($optionListSize as $key=>$optionSize):
								if( !$key )
									continue;
						?>
						<th class="textC pb5"><?php echo $optionSize ?></th>
						<?php endforeach; ?>
					</tr>
					
					<?php
						foreach($optionListColor as $productOptionIdColor=>$optionColor):
							if( !$productOptionIdColor )
								continue;
					?>
					<tr>
						<td class="pr10"><?php echo $optionColor ?></td>
						<?php
							foreach($optionListSize as $productOptionIdSize=>$optionSize):
						?>
							<th class="textL pl10 pr10 pb3" style="vertical-align: middle"><?php echo checkbox_tag("productOptionIdList[]", "$productOptionIdColor-$productOptionIdSize", false, array('onclick'=>'handleFirstProductOption(this.value)')) ?></th>
						<?php endforeach; ?>
					</tr>
					<?php endforeach; ?>
				</table>
				<div class="formNote error" id="productItemFormErrorPrice"></div>
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
	
		<div class="formRow" id="productItemStockDiv">
			<label>Estoque atual</label>
			<div class="formRight">
				<?php
					echo input_tag('stock', null, array('size'=>5, 'maxlength'=>5, 'class'=>'textR', 'id'=>'productItemStock'));
					echo input_hidden_tag('lockedStock', null, array('id'=>'productItemLockedStock'));
				?>
				<label id="productItemLockedStockLabel"></label>
				<span class="ml10"><?php echo link_to('Bloquear estoque', '#lockProductItemStock()', array('id'=>'productItemLockStockLink')) ?></span>
				<span class="text mt4"><?php echo link_to('Desbloquear estoque', '#unlockProductItemStock()', array('id'=>'productItemUnlockStockLink')) ?></span>
				<span class="text mt4 ml10"><?php echo link_to('Atualizar estoque', '#addStockLog()', array('id'=>'productItemAddStockLogLink')) ?></span>
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
	<div class="formRow" id="productItemImageListDiv">
		<div class="formRight">
			<?php
				for($i=1; $i <= 5; $i++):
					$fileName = $productObj->getImage($i, 'preview');
			?>
			<span class="multiple">
				<div class="productImageArea <?php echo (!$fileName?'empty':'') ?>" id="productItemImageArea-<?php echo $i ?>">
					<div class="cabinet productImage">
						<span>Imagem <?php echo $i ?></span>
						<?php
							echo image_tag(($fileName?$fileName:'blank'), array('id'=>'productItemImage-'.$i));
							
							echo input_file_tag('filePath-'.$i, array('onchange'=>'submitProductImage('.$i.', true)', 'class'=>'fileUpload', 'id'=>'productItemFilePathImage-'.$i));
						?>
					</div>
					<?php echo link_to('remover', '#deleteProductImage('.$i.', true)', array('class'=>'deleteImageLink')) ?>
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

<?php include_partial('product/dialog/stockLog') ?>