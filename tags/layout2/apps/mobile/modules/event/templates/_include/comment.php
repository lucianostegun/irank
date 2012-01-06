<?php
	$eventCommentId = $eventCommentObj->getId();
	$isMyComment    = $eventCommentObj->isMyComment();
?>
<div id="eventComment<?php echo $eventCommentId ?>Div">

	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
			
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<td class="lastLine" style="border-left: 1px solid #C0C0C0; font-size: 10pt; padding-top: 0px">
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
	<br/>
</div>