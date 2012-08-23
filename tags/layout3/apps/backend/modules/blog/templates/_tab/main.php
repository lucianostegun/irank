<?php
	echo form_remote_tag(array(
		'url'=>'blog/save',
		'success'=>'handleSuccessBlog(response)',
		'failure'=>'handleFailureBlog(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'blogForm'));

//	echo form_tag('blog/save', array('class'=>'form', 'id'=>'blogForm'));
	
	$blogId = $blogObj->getId();
	
	echo input_hidden_tag('blogId', $blogId);
?>
	<div class="formRow">
		<label>Título</label>
		<div class="formRight">
			<?php echo input_tag('title', $blogObj->getTitle(), array('size'=>60, 'maxlength'=>150, 'onkeyup'=>'buildPermalink(this.value)', 'id'=>'blogTitle')) ?>
			<div class="formNote error" id="blogFormErrorTitle"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Título curto</label>
		<div class="formRight">
			<?php echo input_tag('shortTitle', $blogObj->getShortTitle(), array('size'=>35, 'maxlength'=>50, 'id'=>'blogShortTitle')) ?>
			<div class="formNote error" id="blogFormErrorShortTitle"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Subtítulo</label>
		<div class="formRight">
			<?php echo textarea_tag('caption', $blogObj->getCaption(), array('cols'=>45, 'rows'=>3, 'maxlength'=>250, 'id'=>'blogCaption')) ?>
			<div class="formNote error" id="blogFormErrorCaption"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Categoria</label>
		<div class="formRight">
			<?php echo select_tag('blogCategoryId', VirtualTable::getOptionsForSelect('blogCategory', $blogObj->getBlogCategoryId()), array('id'=>'blogBlogCategoryId')) ?>
			<div class="formNote error" id="blogFormErrorBlogCategoryId"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Tags</label>
		<div class="formRight">
			<?php echo input_tag('tags', $blogObj->getTags(), array('size'=>40, 'maxlength'=>40, 'class'=>'tags', 'id'=>'blogTags')) ?>
			<div class="formNote error" id="blogFormErrorTags"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Permalink</label>
		<div class="formRight">
			<?php echo input_tag('permalink', $blogObj->getPermalink(), array('size'=>80, 'maxlength'=>250, 'id'=>'blogPermalink')) ?>
			<div class="formNote">Letras, números e traços</div>
			<div class="formNote error" id="blogFormErrorPermalink"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Autor</label>
		<div class="formRight">
			<label><?php echo $blogObj->getPeople()->getNickName() ?></label>
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="formRow">
		<label>Rascunho</label>
		<div class="formRight">
			<?php echo checkbox_tag('isDraft', true, $blogObj->getIsDraft(), array('id'=>'blogIsDraft')) ?>
			<div class="formNote error" id="blogFormErrorIsDraft"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Glossário</label>
		<div class="formRight">
			<?php echo input_tag('glossary', $blogObj->getGlossary(), array('size'=>40, 'maxlength'=>40, 'class'=>'tags', 'id'=>'blogGlossary')) ?>
			<div class="formNote error" id="blogFormErrorGlossary"></div>
		</div>
		<div class="clear"></div>
	</div>
	
	<!-- WYSIWYG editor -->
	<div class="widget blogEditor">
		<div class="title"><?php echo image_tag('backend/icons/dark/pencil', array('class'=>'titleIcon')) ?><h6>Conteúdo</h6></div>
		<div class="formNote error ml10 mt5 mb5" id="blogFormErrorContent"></div>
		<?php echo textarea_tag('content', $blogObj->getContent(), array('id'=>'blogContent')) ?>
	</div>

</form>