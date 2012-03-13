<h1>
<?php echo __('event.presenceConfirmSuccess') ?>
</h1>

<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 20px 15px 15px 15px')) ?><br/>
<div class="text"><?php echo __('event.confirmPresence.successMessage', array('%eventName%'=>$eventObj->getEventName())) ?><br/><br/>
<?php echo __('event.confirmPresence.link', array('%link%'=>link_to(__('ClickHere'), '#goModule(\'event\', \'show\', \'eventId\', '.$eventObj->getId().')'))) ?><br/></div>