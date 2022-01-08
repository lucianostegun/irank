<?php
	echo form_remote_tag(array(
		'url'=>'productCategory/save',
		'success'=>'handleSuccessProductCategory(response)',
		'failure'=>'handleFailureProductCategory(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'productCategoryForm'));

//	echo form_tag('productCategory/save', array('class'=>'form', 'id'=>'productCategoryForm'));
	
	$productCategoryId = $productCategoryObj->getId();
	
	echo input_hidden_tag('productCategoryId', $productCategoryId);
	
	$iRankAdmin = $sf_user->hasCredential('iRankAdmin');

	$userAdminId = $sf_user->getAttribute('userAdminId');
?>
	<div class="formRow">
		<label>Nome da categoria</label>
		<div class="formRight">
			<?php echo input_tag('categoryName', $productCategoryObj->getCategoryName(), array('size'=>35, 'maxlength'=>60, 'id'=>'productCategoryCategoryName')) ?>
			<div class="formNote error" id="productCategoryFormErrorCategoryName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Nome curto</label>
		<div class="formRight">
			<?php echo input_tag('shortName', $productCategoryObj->getShortName(), array('size'=>35, 'maxlength'=>60, 'id'=>'productCategoryShortName')) ?>
			<div class="formNote error" id="productCategoryFormErrorShortName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Tag name</label>
		<div class="formRight">
			<?php echo input_tag('tagName', $productCategoryObj->getTagName(), array('size'=>20, 'maxlength'=>20, 'id'=>'productCategoryTagName')) ?>
			<div class="formNote error" id="productCategoryFormErrorTagName"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Produtos cadastrados</label>
		<div class="formRight">
			<label><?php echo $productCategoryObj->getProducts() ?></label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Descrição</label>
		<div class="formRight" style="width: 70%">
			<?php echo textarea_tag('description', $productCategoryObj->getDescription(), array('style'=>'height: 150px', 'id'=>'productCategoryDescription')) ?>
			<div class="formNote error" id="productCategoryFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>
</form>