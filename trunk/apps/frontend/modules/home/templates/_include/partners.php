<div id="partners"><?php echo __('leftBar.partners') ?>...</div>
<?php foreach(Partner::getList() as $partnerObj): ?>
	<div class="partner"><?php echo link_to(image_tag('frontend/partners/'.$partnerObj->getFileName(), array('title'=>$partnerObj->getPartnerName())), $partnerObj->getExternalUrl(), array('target'=>'_blank')) ?></div>
<?php endforeach; ?>