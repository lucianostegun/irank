<h2 id="partners"><?php echo __('leftBar.partners') ?>...</h2>
<?php foreach(Partner::getList() as $partnerObj): ?>
	<div class="partner"><?php echo link_to(image_tag('partners/'.$partnerObj->getFileName(), array('title'=>$partnerObj->getPartnerName())), $partnerObj->getExternalUrl(), array('target'=>'_blank')) ?></div>
<?php endforeach; ?>
<div class="clear mt30"></div>