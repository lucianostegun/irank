<div class="actionBar" id="actionBarDiv">
<?php echo button_tag('confirmPresence', __('event.button.confirmPresence'), array('onclick'=>'chooseMyPresence("yes")', 'image'=>'ok.png', 'visible'=>$visibleButtons, 'disabled'=>($inviteStatus=='yes'))); ?>
<?php echo button_tag('declinePresence', __('event.button.notGoing'), array('onclick'=>'chooseMyPresence("no")', 'image'=>'nok.png', 'visible'=>$visibleButtons, 'disabled'=>($inviteStatus=='no'))); ?>
<?php echo button_tag('maybePresence', __('event.button.maybe'), array('onclick'=>'chooseMyPresence("maybe")', 'image'=>'help.png', 'visible'=>$visibleButtons, 'disabled'=>($inviteStatus=='maybe'))); ?>
</div>
<div class="clear"></div>