<?php
	$style = ($eventCommentId?'border-top: 0px solid #BBB; padding-top: 10px':'');
?>
<table width="412" cellspacing="1" cellpadding="3" style="background: #FFFFFF; border: 1px solid #BBB; <?php echo $style ?>" id="commentForm<?php echo $eventCommentId ?>Table">
	<tr>
		<td align="center" class="commentFormArea" valign="top" colspan="2"><?php echo textarea_tag('comment', __('event.commentTab.commentText'), array('onfocus'=>'handleCommentFocus(this)', 'onkeyup'=>'countChars(this)', 'class'=>'eventComment', 'id'=>'eventCommentComment'.$eventCommentId)) ?></td>
	<tr>
	</tr>
		<td valign="top" id="commentsCharCount<?php echo $eventCommentId ?>" style="display: none">
			140 <?php echo __('leftChars'); ?>
		</td>
		<td valign="top" id="commentsPostButton<?php echo $eventCommentId ?>" style="padding-top: 5px; display: none">
			<?php echo button_tag('postComment'.$eventCommentId, __('button.publish'), array('onclick'=>'sendComment("'.$eventCommentId.'")', 'style'=>'float: right')) ?>
		</td>
	</tr>
</table>