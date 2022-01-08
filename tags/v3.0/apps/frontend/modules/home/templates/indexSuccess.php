<div id="userResume" class="<?php echo ($isAuthenticated?'logged':'') ?>" style="margin-bottom: 5px">
<?php
	if( $isAuthenticated ){
		
		include_partial('home/resume/events');
		include_partial('home/resume/quickResume');
	}

Util::lightbox();
?>
</div>
<div class="clear"></div>
<hr class="separator"/>
<div style="float: left">
<?php include_partial('home/include/highlight') ?>
<?php include_partial('blog/include/highlight'); ?>
</div>

<div class="rightBar">
	<?php
		include_partial('store/include/offerHome');
		if( $sf_user->getAttribute('userSiteId')==1 )
			include_partial('ranking/include/public');
		include_partial('home/include/channels');
	?>
</div>

<div class="clear"></div>

<?php #include_partial('home/include/photoContest'); ?>

<div class="clear"></div>

<div class="eventLiveResumeArea">
<?php #include_partial('home/resume/eventLive', array('includeTitle'=>true, 'offset'=>0, 'limit'=>5)); ?>
<?php #include_partial('home/resume/eventLive', array('includeTitle'=>true, 'limit'=>5)); ?>
</div>
<br/>