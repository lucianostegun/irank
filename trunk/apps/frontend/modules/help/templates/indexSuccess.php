<div class="commonBar"><span><?php echo __('help.title') ?></span></div>
<div class="innerContent">
	<?php echo image_tag('help', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 20px')) ?>
	<?php echo __('help.intro') ?><br/><br/><br/><br/>
</div>
<div class="innerContent" style="margin-left: 40px">
		<b><?php echo link_to('FAQ', '/faq'); ?></b><br/>
		<?php echo __('help.faq.description') ?>
		<br/><br/><br/>
		
		<b><?php echo link_to('Contato', '/contact'); ?></b><br/>
		<?php echo __('help.contact.description') ?>
</div>
