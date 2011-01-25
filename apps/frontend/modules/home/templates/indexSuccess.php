<div id="homeTopContentDiv">
<?php
	$isLogged = true;
	$culture  = MyTools::getCulture();
	
	if( MyTools::isAuthenticated() )
		include_partial('home/component/resume');
	else
		include_partial('home/component/welcome', (array('culture'=>$culture)));
?>
</div>


<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr>
		<td valign="top" width="490">
			<table width="100%" border="0" cellspacing="0" cellpadding="2" class="homeDistinct">
				<tr>
					<th valign="top"><?php echo image_tag('layout/stats.png', array('align'=>'left')) ?></th>
					<td>
						<span><?php echo __('home.statistics') ?></span><br/>
						<?php echo __('home.statistics.description') ?>
					</td>
					
					<td rowspan="3" class="separator"></td>

					<th valign="top"><?php echo image_tag('layout/event.png', array('align'=>'left')) ?></th>
					<td>
						<span><?php echo __('home.eventNotify') ?></span><br/>
						<?php echo __('home.eventNotify.description') ?>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="separator"></td>
				</tr>
				<tr>
					<th valign="top"><?php echo image_tag('layout/photo.png', array('align'=>'left')) ?></th>
					<td>
						<span><?php echo link_to(__('home.photoWall'), 'photoWall') ?></span><br/>
						<?php echo __('home.photoWall.description') ?>
					</td>

					<th valign="top"><?php echo image_tag('layout/rankingHistory.png', array('align'=>'left')) ?></th>
					<td>
						<span><?php echo __('home.history') ?></span><br/>
						<?php echo __('home.history.description') ?>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top">
		<div style="width: 275px; margin-left: 15px">
		<?php echo image_tag('iphone', array('align'=>'right', 'style'=>'margin-left: 10px')) ?>
		<p align="right"><span style="font-size: 11pt; font-weight: bold; color: #b61515">iRank Mobile</span><br/><br/>
		<?php echo __('home.mobile'); ?>
		</p>
		</div>
		</td>
	</tr>
</table>

<?php include_partial('home/include/homeWall'); ?>
