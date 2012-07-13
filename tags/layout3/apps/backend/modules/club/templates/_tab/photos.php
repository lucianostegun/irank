<div align="center" id="clubPhotoListDiv">
	<?php include_partial('club/include/photos', array('clubId'=>$clubId)) ?>
</div>

<!-- Multiple files uploader -->
<div class="widget" id="teste">
    <div class="title"><?php echo image_tag('backend/icons/dark/upload', array('class'=>'titleIcon')) ?><h6>Upload de imagens do clube</h6></div>
    <div id="clubPhotosUploader"></div>
</div>