<div id="photoWall">
<!-- I18N -->
<h1>Últimas fotos...</h1>

<?php
	$criteria = new Criteria();
	$criteria->add( EventPhotoPeer::IS_SHARED, true );
	$criteria->add( EventPhotoPeer::DELETED, false );
	$criteria->add( EventPhotoPeer::ORIENTATION, 'L' );
	$criteria->add( EventPhotoPeer::WIDTH, 450, Criteria::GREATER_EQUAL );
	$criteria->addDescendingOrderByColumn( EventPhotoPeer::CREATED_AT );
	$criteria->setLimit(20);
	$criteria->clearOrderByColumns();
	$criteria->addAscendingOrderByColumn('RANDOM()');
	$eventPhotoObjList = EventPhotoPeer::doSelect($criteria);
	
	$imageList = array();
	$eventList = array();
	
	foreach($eventPhotoObjList as $key=>$eventPhotoObj):
					
		$eventPhotoId = $eventPhotoObj->getId();
		$eventId      = $eventPhotoObj->getEventId();
		$fileName     = Util::getFileName($eventPhotoObj->getFile()->getFilePath());

		$filePath  = 'uploads/eventPhoto/event-'.$eventId.'/'.$fileName;
		$eventName = $eventPhotoObj->getEvent()->toString(true);
		$imageList[] = $filePath;
		$eventList[] = $eventName;
	endforeach;
?>

<div id="wrapper">
	<div id="slideshow">
		<div class="sliderbuttonLeft"><img src="/images/slideshow/left.png" alt="Anterior" onclick="slideshow.move(-1)" /></div>
		<div class="sliderbuttonRight"><img src="/images/slideshow/right.png" alt="Próxima" onclick="slideshow.move(1)" /></div>
		<div id="eventNameBgDiv"></div>
		<div id="eventNameDiv"></div>
		<ul id="slides">
			<?php foreach($imageList as $key=>$image): ?>
			<li title="<?php echo $eventList[$key] ?>"><?php echo image_tag('/'.$image, array('width'=>475)) ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<script type="text/javascript">
var slideshow=new TINY.fader.fade('slideshow',{
	id:'slides',
	auto:7,
	resume:true,
	activeclass:'current',
	visible:true,
	position:0
});
</script>


</div>