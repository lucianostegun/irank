<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-BR" lang="pt-BR">
<head>
<meta name="title" content="iRank Blog - Poker Ranking" />
<meta name="robots" content="index, follow" />
<meta name="description" content="Dicas, notícias e novidades sobre o mundo do poker. Saiba tudo o que você precisa para ter sucesso nesse esporte." />
<meta name="keywords" content="blog, poker, artigos, novidades, notícias, dicas, home game" />
<meta name="language" content="pt" />
<link rel="icon" href="/favicon.ico" type="image/x-icon"/>
<?php
	include_facebook_metas(isset($facebookMetaList)?$facebookMetaList:array());
?>
</head>
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
//  window.onload = init;
</script>
</head>
</html>
<?php exit; ?>
