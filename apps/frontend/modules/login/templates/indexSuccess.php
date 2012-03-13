<?php include_partial('home/component/commonBar', array('pathList'=>array(__('accessDenied.title')=>null))); ?>
<table width="500" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left" valign="top" style="padding:35px 23px 16px 20px; color: #333333">
		<?php echo image_tag('block', array('align'=>'left', 'style'=>'margin: 0px 15px 15px 15px')) ?>
		<?php echo __('accessDenied.message', array('%link%'=>link_to(__('clickHere'), 'sign', array('style'=>'font-weight: bold')))) ?>	
		</td>
	</tr>
</table>