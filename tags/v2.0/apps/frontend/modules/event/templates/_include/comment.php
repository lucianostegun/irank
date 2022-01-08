<?php
	$eventCommentId = $eventCommentObj->getId();
	$isMyComment    = $eventCommentObj->isMyComment();
?>
<div class="commentArea" id="event<?php echo ($isPhoto?'Photo':'') ?>Comment<?php echo $eventCommentId ?>Div">
	<div class="comment">
		<div class="header">
			<div class="senderInfo"><b><?php echo $eventCommentObj->getPeople()->getName() ?></b> - <?php echo $eventCommentObj->getTimeAgo() ?> <?php echo __('ago') ?></div>
			<div class="delete">
				<?php
					if( $isMyComment )
						echo link_to(image_tag('icon/delete10light', array('onmouseover'=>'changeIcon(this, true)', 'onmouseout'=>'changeIcon(this, false)')), '#deleteComment('.$eventCommentId.')', array('title'=>__('event.commentsTab.deleteComment')));
				?>
			</div>
			<div class="reply">
				<?php
					if( !$isMyComment )
						echo link_to(__('Reply'), '#replyComment('.$eventCommentId.', '.($isPhoto?'true':'false').')');
				?>
			</div>
		</div>
		<div class="message"><?php echo $eventCommentObj->getComment(true) ?></div>
	</div>
</div>