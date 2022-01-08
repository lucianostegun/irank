<div class="actionBar" id="actionBarDiv">	
<?php echo button_tag('confirmPresence', 'Confirmar presença', array('onclick'=>'chooseMyPresence("yes")', 'image'=>'../icon/ok.png', 'visible'=>$visibleButtons, 'disabled'=>($inviteStatus=='yes'))); ?>
<?php echo button_tag('declinePresence', 'Não vou', array('onclick'=>'chooseMyPresence("no")', 'image'=>'../icon/nok.png', 'visible'=>$visibleButtons, 'disabled'=>($inviteStatus=='no'))); ?>
<?php echo button_tag('maybePresence', 'Talvez', array('onclick'=>'chooseMyPresence("maybe")', 'image'=>'../icon/help.png', 'visible'=>$visibleButtons, 'disabled'=>($inviteStatus=='maybe'))); ?>
</div>

