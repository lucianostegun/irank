<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<head>
<link rel="icon" href="http://www.irank.com.br/favicon.ico" type="image/x-icon"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="<?php echo $metaTitle ?>" />
<meta name="description" content="<?php echo $metaDescription ?>" />
<meta name="language" content="pt" />
<meta property="og:image" content="<?php echo $metaImage ?>" />
<meta property="og:url" content="http://www.irank.com.br" />
<meta property="og:site_name" content="iRank - Poker Ranking" />
<meta property="og:image" content="http://<?php echo $sf_request->getHost() ?>/images/layout/mediaShare.png" />

<body>
<script type="text/javascript">
function init() { window.location = 'http://<?php echo $sf_request->getHost() ?>/<?php echo $shareLink ?>'; }
//window.onload = init;
</script>

</head>
<body>


</body>
</html>
<?php exit; ?>