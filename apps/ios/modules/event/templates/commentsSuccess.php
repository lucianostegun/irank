<div class="commentList">
<?php
	$eventObj = EventPeer::retrieveByPK( $eventId );

	$commentCount        = $eventObj->getCommentCount();
	$eventCommentObjList = $eventObj->getCommentList(($commentCount > 15?15:null));
	$eventCommentObjList = array_reverse($eventCommentObjList);
	
	foreach($eventCommentObjList as $key=>$eventCommentObj):

		$eventCommentId = $eventCommentObj->getId();
		$isMyComment    = $eventCommentObj->isMyComment();
?>
<div class="commentArea">
	<div class="comment">
		<div class="message"><b><?php echo $eventCommentObj->getPeople()->getName() ?>:</b> <?php echo $eventCommentObj->getComment(true) ?></div>
		<div class="senderInfo"><?php echo $eventCommentObj->getCreatedAt('d/m/Y H:s') ?></div>
	</div>
</div>
<?php
	endforeach;
	
	if( count($eventCommentObjList)==0 ):
?>
<div class="commentArea">
	<div class="comment">
		<div class="message"><?php echo __('event.noComments') ?></div>
	</div>
</div>
<?php endif; ?>
</div>
<a id="footer"/>