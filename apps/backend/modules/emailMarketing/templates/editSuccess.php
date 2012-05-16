<?php
	$isNew = $emailMarketingObj->getIsNew();
?>
<div class="wrapper">
	
	<!-- Fullscreen tabs -->
    <div class="widget form">    
	    <ul class="tabs">
			<li><a href="#tab1">Principal</a></li>
			<li class="<?php echo ($isNew?'hidden':'') ?>" id="mainPreviewTab"><a href="#tab2">Visualização</a></li>
			<li class="hidden" id="mainEditTab"><a href="#tab3">Edição</a></li>
			<li class="<?php echo ($isNew?'hidden':'') ?>" id="mainPeopleTab"><a href="#tab4">Envio</a></li>
			<?php echo submit_tag('salvar', array('class'=>'button redB', 'style'=>'margin: 3px 10px', 'onclick'=>'$("#emailMarketingForm").submit()')); ?>
		</ul>
		<div class="tab_container">
			<?php
				echo form_remote_tag(array(
					'url'=>'emailMarketing/save',
					'success'=>'handleSuccessEmailMarketing(response)',
					'failure'=>'handleFailureEmailMarketing(response.responseText)',
					'loading'=>'showIndicator()',
					),
					array('class'=>'form', 'id'=>'emailMarketingForm'));
//				echo form_tag('emailMarketing/save', array('class'=>'form', 'id'=>'emailMarketingForm'));
				
				echo input_hidden_tag('emailMarketingId', $emailMarketingObj->getId());
			?>
			<div id="tab1" class="tab_content"><?php include_partial('emailMarketing/tab/main', array('emailMarketingObj'=>$emailMarketingObj)) ?></div>
			<div id="tab2" class="tab_content"><?php include_partial('emailMarketing/tab/preview', array('emailMarketingObj'=>$emailMarketingObj)) ?></div>
			<div id="tab3" class="tab_content"><?php include_partial('home/include/tabLoading') ?></div>
			</form>
			<div id="tab4" class="tab_content"><?php include_partial('emailMarketing/tab/people', array('emailMarketingId'=>$emailMarketingObj->getId())) ?></div>
		</div>
	</div>
</div>