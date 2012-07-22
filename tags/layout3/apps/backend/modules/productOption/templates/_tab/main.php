<?php
	echo form_remote_tag(array(
		'url'=>'productOption/save',
		'success'=>'handleSuccessProductOption(response)',
		'failure'=>'handleFailureProductOption(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'productOptionForm'));

//	echo form_tag('productOption/save', array('class'=>'form', 'id'=>'productOptionForm'));
	
	$productOptionId = $productOptionObj->getId();
	echo input_hidden_tag('productOptionId', $productOptionId);
?>

	<div class="formRow">
		<label>Categoria</label>
		<div class="formRight">
			<?php echo select_tag('productCategoryId', ProductCategory::getOptionsForSelect($productOptionObj->getProductCategoryId()), array('id'=>'productOptionProductCategoryId')) ?>
			<div class="formNote error" id="productOptionFormErrorProductCategoryId"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Nome da opção</label>
		<div class="formRight">
			<?php echo input_tag('optionName', $productOptionObj->getOptionName(), array('size'=>15, 'maxlength'=>20, 'id'=>'productOptionOptionName')) ?>
			<div class="formNote error" id="productOptionFormErrorOptionName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Descrição</label>
		<div class="formRight">
			<?php echo input_tag('description', $productOptionObj->getDescription(), array('size'=>25, 'maxlength'=>30, 'id'=>'productOptionDescription')) ?>
			<div class="formNote error" id="productOptionFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Tipo</label>
		<div class="formRight">
			<?php echo select_tag('optionType', options_for_select($productOptionObj->getOptionTypeList(), $productOptionObj->getOptionType()), array('id'=>'productOptionOptionType')) ?>
			<div class="formNote error" id="productOptionFormErrorOptionType"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Opção padrão</label>
		<div class="formRight">
			<?php echo checkbox_tag('isDefault', true, $productOptionObj->getIsDefault(), array('onclick'=>'handleIsDefaultProductOption(this.checked)', 'id'=>'productIsDefault')) ?>
			<label class="mt-1 formNote hidden" hidden id="productFormIsNewWarning"><b>Atenção!</b> Ao salvar o registro a atual opção padrão será desmarcada</label>
			<div class="formNote error" id="productFormErrorIsNew"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Tag name</label>
		<div class="formRight">
			<?php echo input_tag('tagName', $productOptionObj->getTagName(), array('size'=>25, 'maxlength'=>30, 'id'=>'productOptionTagName')) ?>
			<div class="formNote error" id="productOptionFormErrorTagName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Ordem de exibição</label>
		<div class="formRight">
			<?php echo input_tag('orderSeq', $productOptionObj->getOrderSeq(), array('size'=>2, 'maxlength'=>2, 'id'=>'productOptionOrderSeq')) ?>
			<div class="formNote error" id="productOptionFormErrorOrderSeq"></div>
		</div>
		<div class="clear"></div>
	</div>

</form>