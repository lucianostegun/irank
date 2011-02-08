<?php
	$eventCommentId = $eventCommentObj->getId();
	$isMyComment    = $eventCommentObj->isMyComment();
?>
<div id="eventComment<?php echo $eventCommentId ?>Div">
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td width="0" class="topLeft"><?php echo image_tag('mobile/form/topLeft') ?></td>
			<td width="100%" class="topMiddle"></td>
			<td width="0" class="topRight"><?php echo image_tag('mobile/form/topRight') ?></td>
		</tr>
	</table>

	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
			
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<td class="lastLine" style="border-left: 2px solid #C0C0C0; font-size: 10pt; padding-top: 0px">
						<p><b><?php echo $eventCommentObj->getPeople()->getFirstName() ?></b> - <?php echo $eventCommentObj->getTimeAgo() ?> <?php echo __('timeAgo') ?></p>
						<?php echo $eventCommentObj->getComment(true) ?>
						</td>
						<?php if($isMyComment): ?>
						<td class="lastLine deleteEvent">
							<?php echo image_tag('mobile/icon/delete', array('onclick'=>'confirmDelete('.$eventCommentId.')', 'id'=>'deleteIcon'.$eventCommentId)) ?>
						</td>
						<?php endif; ?>
					</tr>
				</table>
							
			</td>
		</tr>
	</table>
	
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td class="baseLeft" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseLeft') ?></td>
			<td width="100%" class="baseMiddle"></td>
			<td class="baseRight" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseRight') ?></td>
		</tr>
	</table>
	<br/>
</div>