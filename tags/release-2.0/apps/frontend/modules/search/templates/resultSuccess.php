<div class="commonBar"><span><?php echo __('search.title') ?></span></div>
<div class="innerContent">
	<?php echo image_tag('layout/search', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	<?php echo __('search.intro', array('%link%'=>link_to(__('Click here'), 'search/advanced'))) ?>  
</div>
<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTable">
	<tr class="header">
		<th colspan="3"><?php echo __('search.result') ?></td>
	</tr>
	<?php if( count($userSiteObjList) ): ?>
	<tr class="header">
		<th><?php echo __('search.username') ?></th>
		<th>E-mail</th>
		<th><?php echo __('search.memberSince') ?></th>
	</tr>
	<?php endif; ?>
	<?php include_partial('search/include/search', array('userSiteObjList'=>$userSiteObjList)); ?>
</table>
<div class="tabbarFooterInfo"><?php echo __('search.footer') ?></div>