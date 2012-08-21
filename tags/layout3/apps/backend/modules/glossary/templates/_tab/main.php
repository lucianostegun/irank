<?php
	echo form_remote_tag(array(
		'url'=>'glossary/save',
		'success'=>'handleSuccessGlossary(response)',
		'failure'=>'handleFailureGlossary(response.responseText)',
		'loading'=>'showIndicator()',
		),
		array('class'=>'form', 'id'=>'glossaryForm'));

//	echo form_tag('glossary/save', array('class'=>'form', 'id'=>'glossaryForm'));
	
	$glossaryId = $glossaryObj->getId();
	
	echo input_hidden_tag('glossaryId', $glossaryId);
?>
	<div class="formRow">
		<label>Termo</label>
		<div class="formRight">
			<?php echo input_tag('term', $glossaryObj->getTerm(), array('size'=>35, 'maxlength'=>60, 'id'=>'glossaryTerm')) ?>
			<div class="formNote error" id="glossaryFormErrorTerm"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Tags</label>
		<div class="formRight">
			<?php echo input_tag('tags', $glossaryObj->getTags(), array('size'=>40, 'maxlength'=>40, 'class'=>'tags', 'id'=>'glossaryTags')) ?>
			<div class="formNote error" id="glossaryFormErrorTags"></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Descrição</label>
		<div class="formRight">
			<?php echo textarea_tag('description', $glossaryObj->getDescription(), array('style'=>'width: 700px; height: 150px', 'id'=>'glossaryDescription')) ?>
			<div class="formNote error" id="glossaryFormErrorDescription"></div>
		</div>
		<div class="clear"></div>
	</div>

</form>