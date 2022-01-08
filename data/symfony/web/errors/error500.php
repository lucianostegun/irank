<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php $path = sfConfig::get('sf_relative_url_root', preg_replace('#/[^/]+\.php5?$#', '', isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : (isset($_SERVER['ORIG_SCRIPT_NAME']) ? $_SERVER['ORIG_SCRIPT_NAME'] : ''))) ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="symfony project" />
<meta name="robots" content="index, follow" />
<meta name="language" content="en" />
<title>iRank - Poker Ranking</title>

<style>
a {
	
	color: 				#E82314;
	text-decoration: 	none;
}

img {
	
	border: 	0px;
}
</style>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/screen.css" />
<!--[if lt IE 7.]>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $path ?>/sf/sf_default/css/ie.css" />
<![endif]-->

</head>
<body>
<div class="sfTContainer">
  <a title="symfony website" href="http://www.symfony-project.org/"><img alt="symfony PHP Framework" class="sfTLogo" src="<?php echo $path ?>/sf/sf_default/images/sfTLogo.png" /></a>
  <div class="sfTMessageContainer sfTAlert">
    <img alt="page not found" class="sfTMessageIcon" src="<?php echo $path ?>/sf/sf_default/images/icons/tools48.png" height="48" width="48" />
    <div class="sfTMessageWrap">
      <h1>Ops! Ocorreu um erro</h1>
      <h4>O servidor se comportou de forma inesperada.</h4>
    </div>
  </div>

  <dl class="sfTMessageInfo">
    <dt>Alguma coisa está com problema</dt>
    <dd>Por favor, envie-nos um e-mail pelo <a href="/index.php/contact">formulário de contato</a> e conte-nos exatamente o que aconteceu para que esse erro ocorresse.<br/>
    Iremos corrigi-lo o mais rápido possível.<br/>
    Desculpe-nos pelo inconveniente.</dd>

	<br/>
  <dt>O que fazer agora?</dt>
  <dd>
    <ul class="sfTIconList">
      <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Voltar para a página anterior</a></li>
    </ul>
  </dd>
  </dl>
</div>
</body>
</html>
