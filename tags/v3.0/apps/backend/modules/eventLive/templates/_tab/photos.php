<div align="center" id="eventLivePhotoListDiv">
	<?php include_partial('eventLive/include/photos', array('eventLiveId'=>$eventLiveId)) ?>
</div>

<!-- Multiple files uploader -->
<div class="widget">
    <div class="title"><?php echo image_tag('backend/icons/dark/upload', array('class'=>'titleIcon')) ?><h6>Upload de imagens do evento</h6></div>
    <div id="eventLivePhotosUploader"></div>
</div>
