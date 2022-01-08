<div class="commonBar"><span><?php echo __('accessDenied.title') ?></span></div>
<table width="500" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="top" style="padding:35px 23px 16px 20px; color: #333333">
		<?php echo image_tag('frontend/block', array('align'=>'left', 'style'=>'margin: 0px 15px 15px 15px')) ?>
		<?php echo __('accessDenied.message', array('%link%'=>link_to(__('clickHere'), 'sign', array('style'=>'font-weight: bold')))) ?>	
		</td>
	</tr>
</table>