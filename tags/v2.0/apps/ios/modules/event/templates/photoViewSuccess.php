<style>
body {
	
	background: #303030;
}
</style>
<div class="photoView">
	<?php
		$imageUrl = url_for('event/imageThumb?eventPhotoId='.$eventPhotoId);
		echo image_tag($imageUrl);
	?>	
</div>