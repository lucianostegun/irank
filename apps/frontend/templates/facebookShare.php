<html>
<head>
<meta property="og:title" content="<?php echo $metaTitle ?>" />
<meta property="og:type" content="game" />
<meta property="og:description" content="<?php echo $metaDescription ?>" />
<meta property="og:url" content="http://<?php echo $sf_request->getHost() ?>/<?php echo $shareLink ?>" />
<meta property="og:image" content="<?php echo $metaImage ?>" />
<meta property="og:site_name" content="iRank - Poker Ranking" />
<meta property="fb:admins" content="1424201846" />
</head>
<body>
<script type="text/javascript">
function init() { window.location = 'http://<?php echo $sf_request->getHost() ?>/<?php echo $shareLink ?>'; }
window.onload = init;
</script>
</body>
</html>
<?php exit; ?>