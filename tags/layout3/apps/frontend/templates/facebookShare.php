<html>
<head>
<?php
	$host = $sf_request->getHost();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="og:title" content="<?php echo $metaTitle ?>" />
<meta property="og:type" content="website" />
<meta property="og:description" content="<?php echo $metaDescription ?>" />
<meta property="og:site_name" content="iRank - Poker Ranking" />
<meta property="og:url" content="http://<?php echo $host .'/'. $url ?>" />
<meta property="og:image" content="http://<?php echo $host .'/'. $metaImage ?>" />
<meta property="og:image" content="http://<?php echo $host ?>/images/layout/mediaLogo.png" />
<meta property="fb:admins" content="1424201846" />
<meta property="fb:app_id" content="173327886080667" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34289493-1']);
  _gaq.push(['_setDomainName', 'irank.com.br']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

  function init() { window.location = 'http://<?php echo $sf_request->getHost() ?>/<?php echo $shareLink ?>'; }
  window.onload = init;
</script>
</head>
</html>
<?php exit; ?>
