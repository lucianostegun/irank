<?php
	echo form_remote_tag(array(
		'url'=>'blogCategory/save',
		'success'=>'handleSuccessBlogCategory(response)',
		'failure'=>'handleFailureBlogCategory(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'blogCategoryForm'));

//	echo form_tag('blogCategory/save', array('class'=>'form', 'id'=>'blogCategoryForm'));
	
	$blogCategoryId = $blogCategoryObj->getId();
	
	echo input_hidden_tag('virtualTableId', $blogCategoryId);
	echo input_hidden_tag('virtualTableName', 'blogCategory');
	echo input_hidden_tag('blogCategoryId', $blogCategoryId);
?>
	<div class="formRow">
		<label>Nome da categoria</label>
		<div class="formRight">
			<?php echo input_tag('description', $blogCategoryObj->getDescription(), array('size'=>35, 'maxlength'=>60, 'id'=>'blogCategoryDescription')) ?>
			<div class="formNote error" id="blogCategoryFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>

</form>