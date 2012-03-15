<?php
	echo input_hidden_tag('eventPhotoId', null, array('id'=>'eventCommentEventPhotoId'));
?>
<div class="tabbarIntro">
	<?php echo __('event.commentsTab.intro') ?>
</div>
<table cellspacing="0" cellpadding="0" style="margin-top: 5px;">
	<tr>
		<td valign="top" height="50" class="defaultForm" style="padding: 10px">

			<?php include_partial('event/include/commentForm', array('eventCommentId'=>'')) ?>
			
			<div style="display: none" id="extraCommentFormDiv">
				<?php include_partial('event/include/commentForm', array('eventCommentId'=>'%eventCommentId%')) ?>
			</div>
			
		</td>
		<?php if( $eventObj->isPastDate() ): ?>
		<td valign="top" rowspan="3" align="left" class="defaultForm" style="width: 300px; padding-bottom: 10px 10px 30px 10px">
			<?php include_partial('event/include/photo', array('eventObj'=>$eventObj)) ?>			
		</td>
		<?php endif; ?>
	</tr>
	<tr>
		<td valign="top" width="437" class="defaultForm" style="padding: 10px 10px 30px 10px">
			<div id="commentListDiv" class="commentList">
			<?php include_partial('event/include/commentList', array('eventObj'=>$eventObj)); ?>
			</div>
			<div id="commentPhotoListDiv" class="commentList"></div>
		</td>
	</tr>
</table>
