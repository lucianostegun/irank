<?php
	$culture = MyTools::getCulture();
?>
<div id="commentsDiv" align="center" style="display: none">
	
	<div class="text">
		<?php echo __('event.comments.intro') ?>
	</div>
	<br/>
	
	<?php include_partial('event/include/commentForm') ?>
	
		<div id="commentListDiv" style="padding-top: 25px">
	
				<?php
					$commentCount        = $eventObj->getCommentCount();
					$eventCommentObjList = $eventObj->getCommentList(($commentCount>5?5:null));
					$eventCommentObjList = array_reverse($eventCommentObjList);
					
					if( $commentCount > 5 ):
				?>
				<div style="margin-bottom: 25px;">
					<?php echo link_to(image_tag('mobile/event/'.$culture.'/showAllComments'), '#showAllComments()') ?>
				</div>
				<?php
					endif;
					
					foreach($eventCommentObjList as $eventCommentObj)
						include_partial('event/include/comment', array('eventCommentObj'=>$eventCommentObj))
				?>
		</div>

</div>