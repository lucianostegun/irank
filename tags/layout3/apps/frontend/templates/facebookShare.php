<html>
<head>
<?php
	$host = $sf_request->getHost();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:type" content="game" />
<meta property="og:title" content="<?php echo $metaTitle ?>" />
<meta property="og:type" content="game" />
<meta property="og:description" content="<?php echo $metaDescription ?>" />
<meta property="og:site_name" content="iRank - Poker Ranking" />
<meta property="og:image" content="http://<?php echo $host .'/'. $metaImage ?>?thumb=1" />
<meta property="og:image" content="http://<?php echo $host ?>/images/layout/mediaShare.png" />
<meta property="fb:admins" content="1424201846" />
<meta property="fb:app_id" content="173327886080667" />
<script type="text/javascript">
function init() { window.location = 'http://<?php echo $sf_request->getHost() ?>/<?php echo $shareLink ?>'; }
//window.onload = init;
</script>
</head>
</html>
<?php exit; ?>