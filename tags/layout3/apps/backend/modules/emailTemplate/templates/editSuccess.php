<?php
	$isNew = $emailTemplateObj->getIsNew();
?>
<div class="wrapper">
	
	<!-- Fullscreen tabs -->
    <div class="widget form">    
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li class="<?php echo ($isNew?'hidden':'') ?>" id="mainPreviewTab"><a href="#tab2">Visualização</a></li>
			<li class="hidden" id="mainEditTab"><a href="#tab3">Edição</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button blueB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#emailTemplateForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<?php
				echo form_remote_tag(array(
					'url'=>'emailTemplate/save',
					'success'=>'handleSuccessEmailTemplate(response)',
					'failure'=>'handleFailureEmailTemplate(response.responseText)',
					'loading'=>'showIndicator()',
					),
					array('class'=>'form', 'id'=>'emailTemplateForm'));
//				echo form_tag('emailTemplate/save', array('class'=>'form', 'id'=>'emailTemplateForm'));
				
				echo input_hidden_tag('emailTemplateId', $emailTemplateObj->getId());
			?>
			<div id="tab1" class="tab_content"><?php include_partial('emailTemplate/tab/main', array('emailTemplateObj'=>$emailTemplateObj)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('emailTemplate/tab/preview', array('emailTemplateObj'=>$emailTemplateObj)) ?></div>
			<div id="tab3" class="tab_content"><?php include_partial('home/include/tabLoading') ?></div>
			</form>
		</div>
	</div>
</div>